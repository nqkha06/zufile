<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\File;
use App\Models\Folder;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function index(Request $request)
    {
        return view('backend.member_2.files.index');
    }

    public function search(Request $request)
    {
    return view('backend.member_2.files.search');
    }
    public function show($id)
    {
        $file = File::where('user_id', auth()->user()->id)
            ->findOrFail($id);

        return response()->json([
            'id' => $file->id,
            'name' => $file->name,
            'file_name' => $file->file_name,
            'mime_type' => $file->mime_type,
            'size' => $this->formatBytes($file->size),
            'download_count' => $file->download_count,
            'created_at' => $file->created_at->format('d/m/Y H:i'),
            'folder' => $file->folder ? $file->folder->name : 'Root',
        ]);
    }

    public function download($id)
    {
        $file = File::where('user_id', auth()->user()->id)
            ->findOrFail($id);

        // Tăng download count
        $file->increment('download_count');

        // Tạo temporary URL để download
        $url = Storage::disk('s3')->temporaryUrl(
            $file->path,
            now()->addMinutes(30),
            [
                'ResponseContentDisposition' => 'attachment; filename="' . $file->file_name . '"'
            ]
        );

        return redirect($url);
    }

    public function move(Request $request, $id)
    {
        $request->validate([
            'folder_id' => 'nullable|exists:folders,id',
        ]);

        $file = File::where('user_id', auth()->user()->id)
            ->findOrFail($id);

        // Kiểm tra folder có thuộc về user không
        if ($request->folder_id) {
            $folder = Folder::where('user_id', auth()->user()->id)
                ->findOrFail($request->folder_id);
        }

        $file->update([
            'folder_id' => $request->folder_id
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'File moved successfully.'
        ]);
    }

    public function rename(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $file = File::where('user_id', auth()->user()->id)
            ->findOrFail($id);

        $file->update([
            'name' => $request->name
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'File renamed successfully.'
        ]);
    }

    public function togglePublic($id)
    {
        $file = File::where('user_id', auth()->user()->id)
            ->findOrFail($id);

        $file->update([
            'is_public' => !$file->is_public
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'File visibility updated.',
            'is_public' => $file->is_public
        ]);
    }

    public function getFilesByFolder($folderId = null)
    {
        $user = auth()->user();

        $files = File::where('user_id', $user->id)
            ->where('folder_id', $folderId)
            ->with('folder')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($files);
    }

    public function getFoldersForMove(Request $request)
    {
        $user = auth()->user();
        $parentId = $request->input('parent_id'); // null = root

        $folders = Folder::where('user_id', $user->id)
            ->where('parent_id', $parentId)
            ->withCount(['files', 'children'])
            ->orderBy('name')
            ->get();

        $formattedFolders = $folders->map(function ($folder) {
            return [
                'id' => $folder->id,
                'name' => $folder->name,
                'parent_id' => $folder->parent_id,
                'files_count' => $folder->files_count,
                'folders_count' => $folder->children_count,
                'stats' => $folder->children_count . ' folder' . ($folder->children_count != 1 ? 's' : '') .
                    ', ' . $folder->files_count . ' file' . ($folder->files_count != 1 ? 's' : '')
            ];
        });

        return response()->json([
            'status' => 'success',
            'folders' => $formattedFolders
        ]);
    }

    private function formatBytes($size, $precision = 2)
    {
        $base = log($size, 1024);
        $suffixes = array('B', 'KB', 'MB', 'GB', 'TB');

        return round(pow(1024, $base - floor($base)), $precision) . ' ' . $suffixes[floor($base)];
    }

    public function destroy(Request $request, $alias)
    {
        $file = File::where('user_id', auth()->user()->id)
            ->where('alias', $alias)
            ->first();
        if (!$file) {
            return response()->json(['message' => 'File not found.'], 404);
        }
        $file->delete();
        return response()->json(['message' => 'File deleted successfully.']);
    }
}
