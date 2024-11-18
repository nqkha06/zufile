<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NOTELevel as Level;
use App\Repositories\Interfaces\NOTELevelRepositoryInterface as LevelRepository;
use App\Services\NOTELevelService;

class NOTELevelController extends Controller
{
    protected $levelRepository;
    protected $NOTELevelService;

    public function __construct(LevelRepository $levelRepository, NOTELevelService $NOTELevelService) {
        // $this->middleware('permission:view_all_invoices', ['only' => ['index']]);
        // $this->middleware('permission:view_all_invoices', ['only' => ['create', 'store']]);
        // $this->middleware('permission:view_all_invoices', ['only' => ['update','edit']]);
        // $this->middleware('permission:view_all_invoices', ['only' => ['destroy']]);

        $this->levelRepository = $levelRepository;
        $this->NOTELevelService = $NOTELevelService;
    }
    
    public function index()
    {
        $levelss = $this->NOTELevelService->listAllpaginated();
        return view('backend.admin.note_level.index', compact('levelss'));
    }

    public function create()
    {
        return view('backend.admin.note_level.create');
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'cpm' => 'required',
        //     'limit' => 'required',
        // ]);
        $payload = [
            'name' => $request->name,
            'click_limit' => $request->cpm.','.$request->limit,
            'click_value' => $request->cpm.','.$request->limit,
            'test_link' => $request->cpm.','.$request->limit,
            'description' => $request->description
        ];

        $created = $this->NOTELevelService->create($payload);
        if ($created) {
            return redirect(route('admin.note_levels.index'))->with('success', 'Cấp độ <b>'.$request->name.'</b>đã được tạo thành công!');
        }
        return redirect(route('admin.note_levels.index'))->with('error', 'Cấp độ <b>'.$request->name.'</b>đã thất bại, thử lại sau!');
    }

    public function edit(string $id)
    {
        $level = $this->levelRepository->findById($id);

        return view('backend.admin.note_level.edit', compact('level'));
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

        return redirect(route('admin.note_levels.index'))->with('success', 'Cấp độ <b>'.$request->name.'</b> cập nhật thành công!');
    }


    public function destroy(string $id)
    {
        //
    }

    public function editConfig(string $id)
    {
        $level = Level::find($id);
        return view('backend.admin.note_level.config', compact('level'));
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
        
        return redirect()->route('admin.note_levels.editConfig', $id)->with('success', 'Cập nhật cấu hình thành công!');
    }
    public function editPageload(string $id)
    {
        $level = Level::find($id);
        return view('backend.admin.note_level.pageload', compact('level'));
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
            return redirect()->route('admin.note_levels.editPageload', $id)->with('success', 'Cập nhật thành công!');
        } else {
            return response()->json(['success' => false, 'message' => 'Không thể cập nhật cấu hình'], 500);
        }
    }
}
