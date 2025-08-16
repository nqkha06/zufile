<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\File;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Aws\S3\S3Client;

class EmptyTrash extends Command
{
    protected $signature = 'trash:empty';
    protected $description = 'Automatically empty the trash after 7 days';

    public function handle()
    {
        $logger = Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/trash.log'),
        ]);
        $logger->info('Emptying trash...');

        try {
            $this->cleanUnfinishedMultipartUploads($logger);
            File::onlyTrashed()
                // ->where('deleted_at', '<=', Carbon::now()->subDays(30))
                ->each(function ($file) {
                    $this->s3()->deleteObject([
                        'Bucket' => env('AWS_BUCKET'),
                        'Key' => $file->path,
                    ]);
                    $file->forceDelete();
                });
            $logger->info('Old files in the trash have been deleted.');
            return 0;
        } catch (\Exception $e) {
            $logger->error('Error while counting trashed files: ' . $e->getMessage());
            return 1; // Indicate failure
        }
    }

    protected function cleanUnfinishedMultipartUploads($logger)
    {
        $s3     = $this->s3();
        $bucket = env('AWS_BUCKET');

        $result = $s3->listMultipartUploads([
            'Bucket' => $bucket,
        ]);

        if (empty($result['Uploads'])) {
            $logger->info('📂 Không có multipart upload bị bỏ dở.');
            return;
        }

        foreach ($result['Uploads'] as $upload) {
            $key        = $upload['Key'];
            $uploadId   = $upload['UploadId'];
            $initiated  = Carbon::parse($upload['Initiated']);

            if ($initiated->diffInHours(now()) < 3) {
                $logger->info("⏳ Bỏ qua multipart $key (tạo lúc $initiated)");
                continue;
            }

            $s3->abortMultipartUpload([
                'Bucket'    => $bucket,
                'Key'       => $key,
                'UploadId'  => $uploadId,
            ]);

            $logger->info("🚮 Đã huỷ multipart upload: $key (tạo lúc $initiated)");
        }
    }


     protected function s3(): S3Client
    {
        return new S3Client([
            'version' => 'latest',
            'region' => env('AWS_DEFAULT_REGION', 'auto'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => true,
            'credentials' => [
                'key' => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ],
            'http' => [
                'verify' => false, // Disable SSL verification
                'timeout' => 120,
                'connect_timeout' => 60,
            ],
        ]);
    }
}
