<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use App\Models\DownloadAccesses;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Aws\S3\S3Client;

use App\Services\GeoIPService;

class DownloadController extends Controller
{
    protected $geoIPService;
    public function __construct(GeoIPService $geoIPService)
    {
        $this->geoIPService = $geoIPService;
    }
    public function index(Request $request, $alias)
    {
        $file = File::where('alias', $alias)->firstOrFail();
        if ($file->is_public == 0) {
            return abort(403, 'Access denied to this file.');
        }
        return view('frontend.download.index', ['file' => $file]);
    }

  public function download(Request $request, $uid, $alias)
{
    $file = File::where('alias', $alias)->firstOrFail();
    $this->stats($request, $file);

    // Tạo tên file
    $fileName = $file->name;
    if (!empty($file->extension)) {
        $fileName .= '.' . $file->extension;
    }

    $safeFileName = Str::slug($file->name) . ($file->extension ? '.' . $file->extension : '');

    try {
        // Tạo presigned URL từ R2
        $s3 = $this->s3();
        $cmd = $s3->getCommand('GetObject', [
            'Bucket' => env('AWS_BUCKET'),
            'Key' => $file->path,
            'ResponseContentDisposition' => 'attachment; filename="' . $safeFileName . '"',
            'ResponseContentType' => $file->mime_type ?: 'application/octet-stream',
        ]);
        $presignedUrl = (string) $s3->createPresignedRequest($cmd, '+1 hour')->getUri();

        // Encode URL để gửi cho Worker
        $encodedUrl = base64_encode($presignedUrl);
        $expire = time() + 3600;
        $secret = env('DOWNLOAD_SECRET', 'qk_dep_trai');
        $hash = hash_hmac('sha256', $encodedUrl . $expire, $secret);

        // Tạo link CDN proxy
        $cdnUrl = "https://cdn.zufile.com/proxy?url=" . urlencode($encodedUrl) . "&expire={$expire}&hash={$hash}";

        return redirect($cdnUrl);

    } catch (\Exception $e) {
        Log::error('R2 download error: ' . $e->getMessage());
        abort(500, 'File download failed');
    }


    $file = File::where('alias', $alias)->firstOrFail();
    $this->stats($request, $file);

    // Generate filename for download
    $fileName = $file->name;
    if (!empty($file->extension)) {
        $fileName .= '.' . $file->extension;
    }

    // Create slug for safe filename
    $safeFileName = Str::slug($file->name) . ($file->extension ? '.' . $file->extension : '');

    try {
        // Generate R2 presigned URL for download
        $s3 = $this->s3();
        $cmd = $s3->getCommand('GetObject', [
            'Bucket' => env('AWS_BUCKET'),
            'Key' => $file->path,
            'ResponseContentDisposition' => 'attachment; filename="' . $safeFileName . '"',
            'ResponseContentType' => $file->mime_type ?: 'application/octet-stream',
        ]);

        $presignedUrl = (string) $s3->createPresignedRequest($cmd, '+1 hour')->getUri();

        return redirect($presignedUrl);

    } catch (\Exception $e) {
        Log::error('R2 download error: ' . $e->getMessage());
        abort(500, 'File download failed');
    }
}


    public function verifyCaptcha(Request $request, $alias)
    {
         $response = Http::asForm()->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
            'secret' => config('services.turnstile.secret_key'),
            'response' => $request->input('cf-turnstile-response'),
            'remoteip' => $request->ip(),
        ]);

        $result = $response->json();

        if (!($result['success'] ?? false)) {
            return back()->withErrors(['captcha' => 'Captcha xác minh không thành công.']);
        }

        return back()->cookie('captcha_verified_' . $alias, true, 60) // Set a cookie to indicate captcha verification success
            ->with('success', 'Captcha xác minh thành công.');
    }

    public function event(Request $request, $alias)
    {
        // Handle any specific events related to the download
        // This could be logging, analytics, etc.
        return response()->json(['message' => 'Event handled successfully.']);
    }

    private function stats($r, $file) {
        $ip_address = $r->ip();
        $dataUserAgent = $this->getUserAgentData($r, $ip_address);

        $check = DownloadAccesses::where('user_id', $file->user_id)
            ->where('ip_address', $ip_address)
            ->whereDate('created_at', now()->toDateString())
            ->where('is_earn', '=', 1)
            ->first();
        if ($check) {
            $dataUserAgent['is_earn'] = 0;
            $dataUserAgent['revenue'] = 0;
        } else {
            $dataUserAgent['is_earn'] = 1;
            $dataUserAgent['revenue'] = config('app.CPM_RATE', 0);
            $r->user()->balance += config('app.CPM_RATE', 0);
            $r->user()->save();
        }

        $dataUserAgent['user_id'] = $file->user_id;
        $dataUserAgent['file_id'] = $file->id;
        $dataUserAgent['reason'] = 0;
        $dataUserAgent['created_at'] = now();

        $file->increment('download_count', 1);
        DownloadAccesses::create($dataUserAgent);
        return 1;
    }

    private function getUserAgentData($request, string $ip_address): array
    {
        // Get device info with fallback
        try {
            $device_info = $this->getDeviceInfo();
        } catch (\Exception $e) {
            Log::error('Error getting device info: ' . $e->getMessage());
            $device_info = [
                'operating_system' => 'unknown',
                'device' => 'unknown',
                'browser' => 'unknown',
            ];
        }

        // Get IP data with fallback
        try {
            $ip_data = $this->geoIPService->getCountry($ip_address);
        } catch (\Exception $e) {
            Log::error('Error getting IP data ['.$ip_address.']: ' . $e->getMessage());
            $ip_data = [
                'ip_address' => $ip_address,
                'country' => 'unknown',
                'iso_code' => 'unknown',
            ];
        }

        return [
            'platform' => $device_info['operating_system'] ?? 'unknown',
            'device' => $device_info['device'] ?? 'unknown',
            'browser' => $device_info['browser'] ?? 'unknown',
            'country' => $ip_data['iso_code'] ?? 'unknown',
            'referer' => $request->headers->get('referer', 'direct'),
            'ip_address' => $ip_address,
            'detection' => 'null'
        ];
    }

    public function getDeviceInfo()
    {
        $agent = new Agent();

        $operating_system = $agent->platform(); // lấy hệ điều hành
        $browser = $agent->browser();

        $isMobile = $agent->isMobile();
        $isDesktop = $agent->isDesktop();
        $isTablet = $agent->isTablet();

        return [
            'device' => $isMobile ? 'Mobile' : ($isTablet ? 'Tablet' : 'Desktop'),
            'operating_system' => $operating_system,
            'browser' => $browser,
        ];
    }

    protected function s3(): S3Client
    {
        return new S3Client([
            'version' => 'latest',
            'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => true,
            'credentials' => [
                'key' => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ],
            'http' => [
                'verify' => false,
                'timeout' => 120,
                'connect_timeout' => 60,
            ],
        ]);
    }

    public function directDownload(Request $request, $uid, $alias)
    {
        $file = File::where('alias', $alias)->firstOrFail();
        $this->stats($request, $file);

        // Generate filename for download
        $fileName = $file->name;
        if (!empty($file->extension)) {
            $fileName .= '.' . $file->extension;
        }

        $safeFileName = Str::slug($file->name) . ($file->extension ? '.' . $file->extension : '');

        try {
            $s3 = $this->s3();

            // Get the file content from R2
            $result = $s3->getObject([
                'Bucket' => env('AWS_BUCKET'),
                'Key' => $file->path,
            ]);

            $content = $result['Body']->getContents();
            $contentType = $result['ContentType'] ?? $file->mime_type ?? 'application/octet-stream';

            return response($content)
                ->header('Content-Type', $contentType)
                ->header('Content-Disposition', 'attachment; filename="' . $safeFileName . '"')
                ->header('Content-Length', strlen($content))
                ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
                ->header('Pragma', 'no-cache')
                ->header('Expires', '0');

        } catch (\Exception $e) {
            Log::error('Direct download error: ' . $e->getMessage());
            abort(500, 'File download failed');
        }
    }

    public function streamDownload(Request $request, $uid, $alias)
    {
        $file = File::where('alias', $alias)->firstOrFail();
        $this->stats($request, $file);

        $safeFileName = Str::slug($file->name) . ($file->extension ? '.' . $file->extension : '');

        try {
            $s3 = $this->s3();

            // Create a stream response for large files
            return response()->streamDownload(function () use ($s3, $file) {
                $result = $s3->getObject([
                    'Bucket' => env('AWS_BUCKET'),
                    'Key' => $file->path,
                ]);

                // Stream the content directly to output
                echo $result['Body']->getContents();
            }, $safeFileName, [
                'Content-Type' => $file->mime_type ?? 'application/octet-stream',
                'Cache-Control' => 'no-cache, no-store, must-revalidate',
                'Pragma' => 'no-cache',
                'Expires' => '0'
            ]);

        } catch (\Exception $e) {
            Log::error('Stream download error: ' . $e->getMessage());
            abort(500, 'File download failed');
        }
    }
}
