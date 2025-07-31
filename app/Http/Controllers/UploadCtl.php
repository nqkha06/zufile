<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Aws\S3\S3Client;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\File;
use App\Models\Folder;
use App\Facades\UserSetting;

class UploadCtl extends Controller
{
    public function init(Request $r)
    {
        $r->validate([
            'dir'       => 'nullable|max:255', // alias của folder
        ]);
        $fileName = $r->input('name');
        $size     = (int) $r->input('size');
        $mime     = $r->input('mime');
        $partSize = 50 * 1024 * 1024;                    // 50 MB/part ≤ Wasabi 5 GB limit

        $user = $r->user();

        // Check if user can upload file (handles expiration and plan limits)
        if (!$user->canUploadFile($size)) {
            // Get the appropriate plan (free plan if expired, current plan if active)
            $plan = $user->hasActivePlan() ? $user->getActivePlan() : \App\Models\Plan::find(1);

            if ($user->hasPlanExpired()) {
                return response()->json(['message' => 'Plan đã hết hạn. Vui lòng gia hạn để tiếp tục upload.'], 403);
            }

            if ($size > $plan->file_size_limit) {
                return response()->json(['message' => 'File vượt quá kích thước cho phép.'], 403);
            }

            if (($user->used_storage + $size) > $plan->storage_limit) {
                return response()->json(['message' => 'Không đủ dung lượng để upload.'], 403);
            }
        }

        // For active users, get their actual plan
        $plan = $user->getActivePlan();

        $parentFolder = Folder::where('user_id', $r->user()->id)
            ->where('alias', $r->input('dir') == 'root' ? null : $r->input('dir'))
            ->first();
        if ($r->input('dir') && $r->input('dir') != 'root' && !$parentFolder) {
            return response()->json(['message' => 'Thư mục không tồn tại.'], 404);
        }
        $s3 = $this->s3();

        $generateAlias = Str::random(10);
        $key = 'uploads/'.$generateAlias.'/'.$fileName;

        $create = $s3->createMultipartUpload([
            'Bucket' => env('AWS_BUCKET'),
            'Key'    => $key,
            'ACL'    => 'private',
            'ContentType' => $mime,
        ]);

        $uploadId = $create['UploadId'];
        $parts    = [];
        $partTotal= (int) ceil($size / $partSize);

        for ($i=1;$i<=$partTotal;$i++) {
            $parts[] = [
                'partNumber' => $i,
                'url'        => $s3->createPresignedRequest(
                    $s3->getCommand('UploadPart', [
                        'Bucket'     => env('AWS_BUCKET'),
                        'Key'        => $key,
                        'UploadId'   => $uploadId,
                        'PartNumber' => $i,
                        // 'ContentMD5' => false
                    ]),
                    '+2 hours'   // URL sống 2 h
                )->getUri()->__toString()
            ];
        }

        // Lấy “name” gốc client gửi lên
        $original  = $r->string('name');                     // ví dụ “Báo cáo quí 2.pdf”
        // Tách phần tên & đuôi
        $base      = pathinfo($original, PATHINFO_FILENAME); // “Báo cáo quí 2”
        $ext       = pathinfo($original, PATHINFO_EXTENSION);// “pdf”

        File::create([
            'user_id'       => $r->user()->id,
            'folder_id'     => $r->input('dir') == 'root' ? null : $parentFolder->id,
            'alias'         => $generateAlias,
            'name'          => pathinfo($original, PATHINFO_FILENAME),
            'extension'     => $ext,
            'name_original' => $original,
            'mime_type'     => $mime,
            'size'          => $size,
            'path'          => $key,      // dùng key làm path
            'is_public'     => UserSetting::get('private_upload', 0) == 0 ? 1 : 0,
            'download_count'=> 0,
            // 'status'        => 'UPLOADING',
        ]);


        return compact('parts','uploadId','key');
    }

    public function complete(Request $r)
    {
        $uploadId = $r->input('uploadId');
        $key      = $r->input('key');
        $etags    = $r->input('etags');   // [{PartNumber:1,ETag:"..."},...]

        $s3 = $this->s3();
        $s3->completeMultipartUpload([
            'Bucket'   => env('AWS_BUCKET'),
            'Key'      => $key,
            'UploadId' => $uploadId,
            'MultipartUpload' => ['Parts' => $etags]
        ]);

        /*-------------------------------------------
        * 1. Tính tên slug muốn trả về
        *------------------------------------------*/
        // Lấy “name” gốc client gửi lên
        $original  = $r->string('name');                     // ví dụ “Báo cáo quí 2.pdf”
        // Tách phần tên & đuôi
        $base      = pathinfo($original, PATHINFO_FILENAME); // “Báo cáo quí 2”
        $ext       = pathinfo($original, PATHINFO_EXTENSION);// “pdf”
        // Tạo slug + giữ nguyên extension
        $download  = Str::slug($base) . ($ext ? ".{$ext}" : '');

        /*-------------------------------------------
        * 2. Presign url kèm header Content‑Disposition
        *------------------------------------------*/
        $url = Storage::disk('s3')->temporaryUrl(
            $key,
            now()->addMinutes(30),
            [
                // ép browser “Save as” với tên slug
                'ResponseContentDisposition' => 'attachment; filename="' . $download . '"',
            ]
        );

        // FileUpload::where('upload_id',$uploadId)
        //     ->update(['status'=>'DONE']);
        $file = File::where('user_id', $r->user()->id)
                ->where('path', $key)
                ->first();

        if ($file) {
            $r->user()->increment('used_storage', $file->size);
        }

        return ['url' => $url];
    }

    public function cancel(Request $r)
    {
        $this->s3()->abortMultipartUpload([
            'Bucket'=>env('AWS_BUCKET'),
            'Key'   =>$r->input('key'),
            'UploadId'=>$r->input('uploadId')
        ]);
        return ['ok'=>true];
    }

    protected function s3(): S3Client
    {
        return Storage::disk('s3')->getClient();
    }
}
