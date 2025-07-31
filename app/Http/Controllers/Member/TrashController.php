<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TrashController extends Controller
{
    public function index()
    {
        return view('backend.member_2.trash');
    }

    public function update(Request $request, $alias)
    {
        $request->validate([
            'type' => 'required|in:folder,file',
        ]);

        $user = auth()->user();
        $type = $request->input('type');
        $model = $type === 'file' ? \App\Models\File::class : \App\Models\Folder::class;

        $target = $model::withTrashed()
            ->where('user_id', $user->id)
            ->where('alias', $alias)
            ->first();

        if (!$target) {
            return response()->json(['message' => 'Thư mục không tồn tại.'], 404);
        }

        if ($type === 'file') {
            $target->restore();
        } else {
            $originalName = $target->name;
            $newName = $originalName;
            $i = 1;

            while (
                $user->folders()
                ->where('parent_id', $target->parent_id)
                ->where('name', $newName)
                ->exists()
            ) {
                $newName = $originalName . ' (' . $i++ . ')';
            }

            $target->name = $newName;

            // Restore the folder
            $target->restore();

            return response()->json(['message' => 'Thư mục đã được khôi phục.']);
        }
    }

    public function destroy(Request $request, $alias)
    {
        $user = auth()->user();

        $folder = $user->folders()->withTrashed()->where('alias', $alias)->first();

        if (!$folder) {
            return response()->json(['message' => 'Thư mục không tồn tại.'], 404);
        }

        // Tính tổng size tất cả file trong folder (kể cả đã xoá mềm)
        $totalSize = $folder->files()->withTrashed()->sum('size');

        // Nếu folder có sub-folder thì mày cần đệ quy hoặc eager load trước tất cả folder con để lấy toàn bộ file
        foreach ($folder->allDescendants as $subFolder) {
            $totalSize += $subFolder->files()->withTrashed()->sum('size');
        }

        // Trừ vào dung lượng đã dùng
        $user->used_storage = max(0, $user->used_storage - $totalSize);
        $user->save();

        // Xoá vĩnh viễn
        $folder->forceDelete();

        return response()->json(['message' => 'Thư mục đã được xoá vĩnh viễn.']);
    }


    public function emptyTrash(Request $request)
    {
        $user = auth()->user();

        $folders = $user->folders()->onlyTrashed()->get();
        $files = $user->files()->onlyTrashed()->get();

        if ($folders->isEmpty() && $files->isEmpty()) {
            return response()->json(['message' => 'Thùng rác trống.'], 404);
        }

        $totalSize = 0;

        // Tính tổng dung lượng từ file riêng lẻ
        foreach ($files as $item) {
            $totalSize += $item->size;
            $item->forceDelete();
        }

        // Tính dung lượng từ file trong các folder
        foreach ($folders as $folder) {
            $totalSize += $folder->files()->withTrashed()->sum('size');

            foreach ($folder->allDescendants as $subFolder) {
                $totalSize += $subFolder->files()->withTrashed()->sum('size');
            }

            $folder->forceDelete();
        }

        $user->used_storage = max(0, $user->used_storage - $totalSize);
        $user->save();

        return response()->json(['message' => 'Thùng rác đã được xoá vĩnh viễn.']);
    }
}
