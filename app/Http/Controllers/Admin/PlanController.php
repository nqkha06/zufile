<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\PlanTranslation; // added
use App\Models\Language; // added

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plans = Plan::with('translations')->orderByDesc('id')->paginate(15);

        return view('backend.admin.plan.index', compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     * Inline form is displayed on index page, so this can redirect there.
     */
    public function create()
    {
        return redirect()->route('admin.plans.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
            'price' => ['required', 'numeric', 'min:0'],
            'storage_limit_mb' => ['required', 'integer', 'min:0'],
            'file_size_limit_mb' => ['required', 'integer', 'min:0'],
            'file_keep_forever' => ['nullable'],
            'file_keep_days' => ['nullable', 'integer', 'min:0'],
            'ads_reduced' => ['nullable'],
        ]);

        $fileKeepForever = $request->boolean('file_keep_forever');
        $fileKeepDays = $fileKeepForever ? 0 : ($validated['file_keep_days'] ?? 0);

        $plan = Plan::create([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'storage_limit' => ((int) $validated['storage_limit_mb']) * 1048576, // MB -> bytes
            'file_size_limit' => ((int) $validated['file_size_limit_mb']) * 1048576, // MB -> bytes
            'file_keep_forever' => $fileKeepForever,
            'file_keep_days' => $fileKeepDays,
            'ads_reduced' => $request->boolean('ads_reduced'),
        ]);

        // Save default translation
        $langCode = $request->input('lang', config('app.DEFAULT_LANG_ADMIN', 'en'));
        PlanTranslation::updateOrCreate(
            [
                'plan_id' => $plan->id,
                'lang_code' => $langCode,
            ],
            [
                'name' => $validated['name'],
                'description' => $validated['description'] ?? null,
            ]
        );

        return redirect()->route('admin.plans.index')->with('success', 'Tạo gói thành công!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, Request $request)
    {
        $lang_code = $request->query('ref_lang', 'en');
        $lang = Language::where('code', $lang_code)->first();
        $plan = Plan::with('translations')->findOrFail($id);

        return view('backend.admin.plan.edit', compact('plan', 'lang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
            'price' => ['required', 'numeric', 'min:0'],
            'storage_limit_mb' => ['required', 'integer', 'min:0'],
            'file_size_limit_mb' => ['required', 'integer', 'min:0'],
            'file_keep_forever' => ['nullable'],
            'file_keep_days' => ['nullable', 'integer', 'min:0'],
            'ads_reduced' => ['nullable'],
            'lang' => ['nullable', 'string', 'max:10'],
        ]);

        $fileKeepForever = $request->boolean('file_keep_forever');
        $fileKeepDays = $fileKeepForever ? 0 : ($validated['file_keep_days'] ?? 0);

        Plan::where('id', $id)->update([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'storage_limit' => ((int) $validated['storage_limit_mb']) * 1048576,
            'file_size_limit' => ((int) $validated['file_size_limit_mb']) * 1048576,
            'file_keep_forever' => $fileKeepForever,
            'file_keep_days' => $fileKeepDays,
            'ads_reduced' => $request->boolean('ads_reduced'),
        ]);

        // Save translation for selected language
        $langCode = $request->input('lang', config('app.DEFAULT_LANG_ADMIN', 'en'));
        PlanTranslation::updateOrCreate(
            [
                'plan_id' => $id,
                'lang_code' => $langCode,
            ],
            [
                'name' => $validated['name'],
                'description' => $validated['description'] ?? null,
            ]
        );

        if ($request->submitter === 'apply') {
            return redirect()->back()->with('success', 'Cập nhật gói thành công!');
        }

        return redirect()->route('admin.plans.index')->with('success', 'Cập nhật gói thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Plan::where('id', $id)->delete();

        return redirect()->route('admin.plans.index')->with('success', 'Xóa gói thành công');
    }
}
