<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\STULogService;
use App\Services\Interfaces\AccessServiceInterface as AccessService;
use App\Facades\Setting;

class GeneralController extends Controller
{
    protected $STULogService;
    protected $accessService;

    public function __construct(STULogService $STULogService, AccessService $accessService) {
        $this->STULogService = $STULogService;
        $this->accessService = $accessService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.admin.system.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {   
        $action = $request->action;
        if (!empty($action)) {
            if ($action == 'access') {
                $deleted = $this->accessService->deleteAllAccess();
                if ($deleted) {
                    return redirect()->route('admin.general.index')->withInput()->with('success', 'Xoá bộ nhớ đệm access thành công!');
                } else {
                    return redirect()->route('admin.general.index')->withInput()->with('error', 'Xoá bộ nhớ đệm access thất bại, thử lại sau');
                }
            } else if ($action == 'ref') {
                $deleted = $this->STULogService->deleteAllSTULog();
                if ($deleted) {
                    return redirect()->route('admin.general.index')->withInput()->with('success', 'Xoá bộ nhớ đệm ref thành công!');
                } else {
                    return redirect()->route('admin.general.index')->withInput()->with('error', 'Xoá bộ nhớ đệm ref thất bại, thử lại sau');
                }
            }
        }
        $request->validate([
            'web_name' => 'required|string|max:255',
            'web_url' => 'required|url',
            'web_status' => 'nullable|string',
            'stu_url' => 'required|url',
            'stu_length' => 'nullable|integer',
            'stu_decode' => 'nullable|string',
            'note_decode' => 'nullable|string',
            'web_favicon' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'web_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $web_f = $this->uploadImg($request, 'web_favicon');
        $web_i = $this->uploadImg($request, 'web_image');

        $param = $request->except('_token', 'web_favicon', 'web_image', 'stu_axaj');

        if (!empty($web_f)) {
            $param['web_favicon'] = $web_f;
        }
        if (!empty($web_i)) {
            $param['web_image'] = $web_i;
        }

        // $param['stu_axaj'] = $request->stu_axaj ? '1' : '0';
        Setting::set('stu_axaj', $request->stu_axaj ? '1' : '0');

        foreach ($param as $key=>$val) {
            if (!empty($val)) {
                Setting::set($key, $val);
            }
        }

        return redirect()->route('admin.general.index')->withInput()->with('success', 'Cập nhật thành công!');
    }

    private function uploadImg($request, $name)
    {
        if ($request->hasFile($name)) {
            $image = $request->file($name);
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);

            $path = '/images/' . $imageName;

            return $path;
        } else {
            return false;
        }
    }
}
