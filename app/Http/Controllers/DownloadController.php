<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class DownloadController extends Controller
{
    public function index(Request $request, $alias)
    {

        $file = File::where('alias', $alias)->firstOrFail();

        return view('frontend.download.index', ['file' => $file]);
    }

    public function download(Request $request, $alias)
    {
        $file = File::where('alias', $alias)->firstOrFail();

        // Increase download count
        $file->increment('download_count');

        // Generate temporary URL for download
        $url = Storage::disk('s3')->temporaryUrl(
            $file->path,
            now()->addMinutes(5),
            [
                'ResponseContentDisposition' => 'attachment; filename="' . $file->file_name . '"'
            ]
        );

        return redirect($url);
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
}
