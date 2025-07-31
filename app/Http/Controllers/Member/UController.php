<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Folder;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UController extends Controller
{
    public function index(Request $request)
    {
        $dir = $request->input('dir');
        $offset = $request->input('offset', 0);
        $count_nest = $request->input('count_nest', false);
        $trash = $request->input('trash', false);
        $name = $request->input('name');
        $user = auth()->user();

        // Xử lý folder cha
        $parentFolder = null;
        if ($dir && $dir !== 'root') {
            $parentFolder = $user->folders()->withTrashed()->where('alias', $dir)->first();

            if (!$parentFolder) {
                return response()->json([
                    'message' => 'Thư mục cha không tồn tại.'
                ], 404);
            }

            if ($parentFolder->trashed() || $parentFolder->hasDeletedAncestor()) {
                return response()->json([
                    'message' => 'Một trong các thư mục cha đã bị xoá.'
                ], 410); // HTTP 410 Gone
            }
        }

        // Truy vấn folder hiện tại
        $foldersQuery = $user->folders();
        if ($dir) {
            $foldersQuery->where('parent_id', $dir == 'root' ? null : $parentFolder->id);
        }
        if ($name) {
            $foldersQuery->where('name', 'like', '%' . $name . '%');
        }
        $foldersQuery->orderBy('created_at', 'desc');

        if ($offset > 0) {
            $foldersQuery->offset($offset)->limit(50);
        }

        if ($trash) {
            $foldersQuery->onlyTrashed();
        } else {
            $foldersQuery->whereNull('deleted_at');
        }

        $folders = $foldersQuery->get();

        // Format dữ liệu trả về
        $folder_formatted = $folders->map(function ($folder) use ($count_nest) {
            $arr = [
                'drive' => 1,
                'key' => $folder->alias,
                'name' => $folder->name,
                'created_at' => $folder->created_at->format('Y-m-d H:i:s'),
                'updated_at' => $folder->updated_at->format('Y-m-d H:i:s'),
                'is_public' => $folder->is_public,
            ];

            if ($count_nest) {
                $arr['total_folder'] = $folder->children()->count();
            }

            return $arr;
        });

        return response()->json([
            'items' => $folder_formatted,
            'total' => $folders->count(),
            'message' => 'Folders retrieved successfully.'
        ]);
    }

    public function detail(Request $request, $alias)
    {
        $user = auth()->user();

        // Load current folder nếu có
        $currentFolder = Folder::where('user_id', $user->id)
                ->where('alias', $alias)
                ->firstOrFail(); // hoặc firstOrFail()

        if ($currentFolder->parent_id !== null && $currentFolder->hasDeletedAncestor()) {
            abort(404, 'Không tìm thấy thư mục.');
        }

        return view('backend.member_2.files.show', compact(
            'currentFolder'
        ));
    }

    public function files(Request $request)
    {
        $user = auth()->user();
        $dir = $request->input('dir');
        $parentFolder = $user->folders()->where('alias', $dir)->first();
        $trash = $request->input('trash', false);
        $name = $request->input('name');
        $files = $user->files();
        if ($dir) {
            $files = $files->where('folder_id', $dir === 'root' ? null : $parentFolder->id);
        }
        $files = $files->orderBy('created_at', 'desc');
        if ($name) {
            $files = $files->where('name', 'like', '%' . $name . '%');
        }
        if ($trash) {
            $files = $files->onlyTrashed();
        } else {
            $files = $files->whereNull('deleted_at');
        }
        $files = $files->get();

        $file_formatted = $files->map(function ($file) {
            return [
                'downloads' => $file->download_count,
                'ext' => $file->extension,
                'key' => $file->alias,
                'name' => $file->name,
                'size' => $file->size,
                'date' => $file->created_at->format('Y-m-d H:i:s'),
                'date_updated' => $file->updated_at->format('Y-m-d H:i:s'),
                'is_private' => !$file->is_public,
                'warning' => null
            ];
        });

        return response()->json([
            'items' => $file_formatted,
            'total' => $files->count(),
            'message' => 'Files retrieved successfully.'
        ]);
    }

    public function createFolder(Request $request)
    {
        $user = auth()->user();
        $name = $request->input('name');
        $parentAlias = $request->input('dir', 'root');

        $parentFolder = $user->folders()->where('alias', $parentAlias)->first();
        // dd($parentFolder ? $parentFolder->id : null);
        if (!$parentFolder && $parentAlias != 'root') {
            return response()->json(['message' => 'Parent folder not found.'], 404);
        }

        $folder = $user->folders()->create([
            'name' => $name,
            'alias' => Str::random(10),
            'parent_id' => $parentFolder ? $parentFolder->id : null,
        ]);

        return response()->json(['message' => 'Folder created successfully.', 'drive' => 1, 'key' => $folder->alias, 'name' => $folder->name]);
    }

    public function update(Request $request, $alias)
    {
        $request->validate([
            'is_private' => 'nullable|boolean',
            'name' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
        ]);

        $user = auth()->user();
        $file = $user->files()->where('alias', $alias)->first();

        if (!$file) {
            return response()->json(['message' => 'File not found.'], 404);
        }

        if ($request->has('is_private')) {
            $file->is_public = !$request->input('is_private');
            $file->save();
            return response()->json(['is_private' => $file->is_public]);
        }


        if ($request->has('name')) {
            $file->name = $request->input('name');
            $file->save();
            return response()->json(['name' => $file->name]);
        }

        if ($request->has('location')) {
            $file->folder_id = $request->input('location') === 'root' ? null : $user->folders()->where('alias', $request->input('location'))->first()->id;
            $file->save();
            return response()->json(['location' => $file->folder_id ? $file->folder->alias : 'root']);
        }
        return response()->json(['message' => 'no changes made.'], 400);
    }

    public function updateFolder(Request $request, $alias)
    {
        $request->validate([
            // 'is_private' => 'nullable|boolean',
            'name' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
        ]);

        $user = auth()->user();
        $folder = $user->folders()->where('alias', $alias)->first();

        if (!$folder) {
            return response()->json(['message' => 'Folder not found.'], 404);
        }

        if ($request->has('name')) {
            $folder->name = $request->input('name');
            $folder->save();
            return response()->json(['name' => $folder->name]);
        }

        if ($request->has('location')) {
            $folder->parent_id = $request->input('location') === 'root' ? null : $user->folders()->where('alias', $request->input('location'))->first()->id;
            $folder->save();
            return response()->json(['location' => $folder->parent_id ? $folder->parent->alias : 'root']);
        }

        return response()->json(['message' => 'no changes made.'], 400);
    }

    public function deleteFolder(Request $request, $alias)
    {
        $user = auth()->user();
        $folder = $user->folders()->where('alias', $alias)->first();

        if (!$folder) {
            return response()->json(['message' => 'Folder not found.'], 404);
        }

        $folder->delete();
        return response()->json(['message' => 'Folder deleted successfully.']);
    }

}
