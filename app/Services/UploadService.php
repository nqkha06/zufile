<?php

namespace App\Services;
use Illuminate\Support\Facades\Storage;

class UploadService
{
    /**
     * Upload một file lên thư mục được chỉ định.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $folder
     * @param string|null $fileName
     * @return string Đường dẫn file sau khi lưu
     * @throws \Exception
     */
    public function upload($file, $folder = 'uploads', $fileName = null)
    {
        // Xác thực file
        if (!$file->isValid()) {
            throw new \Exception('File không hợp lệ.');
        }

        // Tạo tên file nếu chưa có
        $fileName = $fileName ?? time() . '_' . $file->getClientOriginalName();

        // Lưu file vào thư mục public
        $filePath = $file->storeAs($folder, $fileName, 'public');

        // Trả về đường dẫn file
        return $filePath;
    }

    /**
     * Xóa file đã upload.
     *
     * @param string $filePath
     * @return bool
     */
    public function delete($filePath)
    {
        return Storage::disk('public')->delete($filePath);
    }
   
}
