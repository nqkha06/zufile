<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AaDeviceFingerprint;

class DeviceFingerprintController extends Controller
{
    public function index(Request $request)
    {
        $fingerprints = AaDeviceFingerprint::with(['automationFlags', 'performanceTiming'])
            ->orderByDesc('created_at')
            ->paginate(20);


        return view('backend.admin.fingerprint.index', compact('fingerprints'));
    }

    public function show($id)
    {
        $fingerprint = AaDeviceFingerprint::with([
            'vectors', 'automationFlags', 'fonts', 'performanceTiming',
            'storageCapabilities', 'jsErrors', 'permissions'
        ])->findOrFail($id);

        return view('backend.admin.fingerprint.show', compact('fingerprint'));
    }
}
