<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\File;

class UploadController extends Controller
{

  public function uploadToWasabi(Request $request)
{
    $request->validate([
        'file' => 'required|file|max:102400', // 100MB
        'folder_id' => 'nullable|exists:folders,id',
    ]);

    $file = $request->file('file');

    // Tên file đẹp: slug + random tail + extension
    $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
    $extension = $file->getClientOriginalExtension();
    $filename = Str::slug($originalName) . '-' . time() . '.' . $extension;

    // Upload file lên Wasabi dùng tên mới
    $path = $file->storeAs('uploads', $filename, 's3');

    if (!$path) {
        return response()->json([
            'status' => 'error',
            'message' => 'File upload failed.',
        ], 500);
    }

    // Lưu thông tin file vào database
    $fileModel = File::create([
        'user_id' => auth()->id(),
        'folder_id' => $request->input('folder_id'),
        'name' => $originalName,
        'file_name' => $filename,
        'mime_type' => $file->getMimeType(),
        'size' => $file->getSize(),
        'path' => $path,
        'is_public' => false,
        'download_count' => 0,
    ]);

    // Tạo link tải tạm (30 phút) và set header tên file
    $signedUrl = Storage::disk('s3')->url($path);

    return response()->json([
        'status' => 'success',
        'message' => 'File uploaded successfully.',
        'file_id' => $fileModel->id,
        'file_path' => $path,
        'url' => $signedUrl,
        'filename' => $filename,
    ]);
}


}
