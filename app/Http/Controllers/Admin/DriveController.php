<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\File;
use App\Models\Folder;
use App\Models\User;
class DriveController extends Controller
{
     public function index(Request $request)
    {

    $dir        = $request->input('dir');
    // $offset     = $request->input('offset', 0);
    $count_nest = $request->boolean('count_nest', false);
    $trash      = $request->boolean('trash', false);
    $name       = $request->input('name');
    $perPage    = (int) $request->input('per_page', 50);
    $userId     = $request->input('user');
    $type       = $request->input('type', 'all'); // all | folders | files

    // Prepare variables
    $folders = null;
    $files   = null;

    $loadFolders = in_array($type, ['all', 'folders'], true);
    $loadFiles   = in_array($type, ['all', 'files'], true);

    if ($loadFolders) {
        // Truy vấn folder với phân trang và filter
        $folderQuery = Folder::query()
            ->with([
                'user:id,name,email',
                'parent:id,alias,name'
            ]);

        if ($dir) {
            if ($dir === 'root') {
                $folderQuery->whereNull('parent_id');
            } else {
                $folderQuery->whereHas('parent', function ($q) use ($dir) {
                    $q->where('alias', $dir);
                });
            }
        }

        if ($name) {
            $folderQuery->where('name', 'like', "%{$name}%");
        }

        if (!empty($userId)) {
            $folderQuery->where('user_id', $userId);
        }

        if ($trash) {
            $folderQuery->onlyTrashed();
        }

        if ($count_nest) {
            $folderQuery->withCount('children');
        }

        $folderQuery->orderBy('created_at', 'desc');

        // Dùng page name riêng để tránh xung đột khi có 2 paginator trên một trang
        $folders = $folderQuery->paginate($perPage, ['*'], 'folders_page');
    }

    if ($loadFiles) {
        // Truy vấn file với phân trang và filter
        $fileQuery = File::query()
            ->with([
                'user:id,name,email',
                'folder:id,alias,name'
            ]);

        if ($dir) {
            if ($dir === 'root') {
                $fileQuery->whereNull('folder_id');
            } else {
                $fileQuery->whereHas('folder', function ($q) use ($dir) {
                    $q->where('alias', $dir);
                });
            }
        }

        if ($name) {
            $fileQuery->where(function ($q) use ($name) {
                $q->where('name', 'like', "%{$name}%")
                  ->orWhere('name_original', 'like', "%{$name}%");
            });
        }

        if (!empty($userId)) {
            $fileQuery->where('user_id', $userId);
        }

        if ($trash) {
            $fileQuery->onlyTrashed();
        }

        $fileQuery->orderBy('created_at', 'desc');

        // Page name riêng cho files
        $files = $fileQuery->paginate($perPage, ['*'], 'files_page');
    }

    $selectedUser = null;
    if (!empty($userId)) {
        $selectedUser = User::select('id','name','email')->find($userId);
    }

    return view('backend.admin.drive.index', [
        'type'         => $type,
        'folders'      => $folders,
        'files'        => $files,
        'dir'          => $dir,
        // 'offset'   => $offset, // không còn dùng offset khi phân trang
        'count_nest'   => $count_nest,
        'trash'        => $trash,
        'name'         => $name,
        'per_page'     => $perPage,
        'user'         => $userId,
        'selectedUser' => $selectedUser,
    ]);

    }
}
