<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Level;
use App\Repositories\Interfaces\LevelRepositoryInterface as LevelRepository;
use App\Services\Interfaces\STULevelServiceInterface as STULevelService;

class LevelController extends Controller
{
    protected $levelRepository;
    protected $STULevelService;

    public function __construct(LevelRepository $levelRepository, STULevelService $STULevelService) {
        // $this->middleware('permission:view_all_invoices', ['only' => ['index']]);
        // $this->middleware('permission:view_all_invoices', ['only' => ['create', 'store']]);
        // $this->middleware('permission:view_all_invoices', ['only' => ['update','edit']]);
        // $this->middleware('permission:view_all_invoices', ['only' => ['destroy']]);

        $this->levelRepository = $levelRepository;
        $this->STULevelService = $STULevelService;
    }
    
    public function index()
    {
        $levelss = $this->STULevelService->getPaginatedWidgets();
        $data = ['levelss' => $levelss, 'title' => 'Cấp độ', 'content' => 'level.index'];
        return view('backend.admin.level.index', compact('levelss'));
    }


    public function create()
    {
        return view('backend.admin.level.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'cpm' => 'required',
            'limit' => 'required',
        ]);

        $user = Level::create([
                    'name' => $request->name,
                    'click_limit' => $request->cpm.','.$request->limit,
                    'click_value' => $request->cpm.','.$request->limit,
                    'test_link' => $request->cpm.','.$request->limit,
                    'description' => $request->description
                ]);

        return redirect(route('admin.levels.index'))->with('success', 'Cấp độ <b>'.$request->name.'</b>đã được tạo thành công!');
    }

    public function edit(string $id)
    {
        $level = $this->levelRepository->findById($id);

        return view('backend.admin.level.edit', compact('level'));
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'click_limit' => 'required',
            'click_value' => 'required',
            'status' => 'required',
        ]);

        $user = Level::where('id', $id)->update([
                    'name' => $request->name,
                    'click_limit' => $request->click_limit,
                    'click_value' => $request->click_value,
                    'test_link' => $request->test_link,
                    'status' => $request->status,
                    'description' => $request->description ?? '',
                    'minimum_pages' => $request->minimum_pages,

                ]);

        return redirect(route('admin.levels.index'))->with('success', 'Cấp độ <b>'.$request->name.'</b> cập nhật thành công!');
    }


    public function destroy(string $id)
    {
        //
    }

    public function editConfig(string $id)
    {
        $level = Level::find($id);

        return view('backend.admin.level.config', compact('level'));
    }
    public function updateConfig(Request $request, string $id)
    {
        $configs = [];        
        $data = array_filter($request->all(), function ($key) {
            return !in_array($key, ['_method', '_token']);
        }, ARRAY_FILTER_USE_KEY);
        
        $updated = Level::where('id', $id)->update([
            'config' => json_encode($data)
        ]);
        
        return redirect()->route('admin.levels.editConfig', $id)->with('success', 'Cập nhật cấu hình thành công!');
    }
    public function editPageload(string $id)
    {
        $level = Level::find($id);
        return view('backend.admin.level.pageload', compact('level'));
    }
    public function updatePageload(Request $request, string $id)
    {
        $configs = [];        
        $data = array_filter($request->all(), function ($key) {
            return !in_array($key, ['_method', '_token']);
        }, ARRAY_FILTER_USE_KEY);

        $numberOfConfigs = count($data[array_key_first($data)]);

        // Tạo cấu hình cho từng phần tử
        for ($i = 0; $i < $numberOfConfigs; $i++) {
            $arr = [];
            foreach ($data as $key => $values) {
                $arr[$key] = $values[$i] ?? null;
            }
            $configs[] = $arr;

        }
        $updated = Level::where('id', $id)->update([
            'pageload_config' => json_encode($configs)
        ]);
        if ($updated) {
            return redirect()->route('admin.levels.editPageload', $id)->with('success', 'Cập nhật thành công!');
        } else {
            return response()->json(['success' => false, 'message' => 'Không thể cập nhật cấu hình'], 500);
        }
    }
}
