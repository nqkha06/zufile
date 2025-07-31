<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NOTELevel as Level;
use App\Repositories\Interfaces\NOTELevelRepositoryInterface as LevelRepository;
use App\Services\NOTELevelService;
use App\Models\Language;
use App\Models\NOTELevelTranslation;
use App\Models\NOTELevelRate;
use App\Models\Country;

class NOTELevelController extends Controller
{
    protected $levelRepository;
    protected $NOTELevelService;

    public function __construct(LevelRepository $levelRepository, NOTELevelService $NOTELevelService)
    {
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
            'click_limit' => $request->cpm . ',' . $request->limit,
            'click_value' => $request->cpm . ',' . $request->limit,
            'test_link' => $request->cpm . ',' . $request->limit,
            'description' => $request->description
        ];

        $created = $this->NOTELevelService->create($payload);
        if ($created) {
            return redirect(route('admin.note_levels.index'))->with('success', 'Cấp độ <b>' . $request->name . '</b>đã được tạo thành công!');
        }
        return redirect(route('admin.note_levels.index'))->with('error', 'Cấp độ <b>' . $request->name . '</b>đã thất bại, thử lại sau!');
    }

    public function edit(Request $request, string $id)
    {
        $lang_code = $request->query('ref_lang', 'en');
        $lang = Language::where(['code' => $lang_code])->first();
        $level = $this->levelRepository->findFirst([
            'id' => $id
        ]);

        return view('backend.admin.note_level.edit', compact('level', 'lang'));
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        Level::where('id', $id)->update([
            'test_link' => $request->test_link,
            'status' => $request->status,
            'minimum_pages' => $request->minimum_pages,
        ]);
        NoteLevelTranslation::updateOrCreate(
            [
                'level_id' => $id,
                'lang_code' => $request->lang, // Điều kiện tìm kiếm
            ],
            [
                'name' => $request->name,
                'description' => $request->description // Dữ liệu cập nhật hoặc thêm mới
            ]
        );

        if ($request->submitter == 'apply') {
            return redirect()->back()->with('success', 'Cấp độ <b>' . $request->name . '</b> cập nhật thành công!');
        } else {
            return redirect()->route('admin.note_levels.index')->with('success', 'Cấp độ <b>' . $request->name . '</b> cập nhật thành công!');
        }
    }

    public function rate(string $id, Request $request)
    {
        $lang_code = $request->query('ref_lang', 'en');
        $countries = Country::select(['name', 'abv'])->get();
        $rates = NOTELevelRate::where("level_id", "=", $id)->get();
        $arr = [];
        foreach ($rates as $item) {
            $arr[$item->country_code] = array_merge($item->rate, $item->daily_limit);
        }
        $rates = $arr;
        $level = $this->levelRepository->find($id);

        return view('backend.admin.note_level.rate', compact('level', 'countries', 'rates'));
    }
    public function postRate(string $id, Request $request)
    {
        $level = Level::findOrFail($id);
        $rates = $request->value;
        $arr = [];
        NOTELevelRate::where("level_id", "=", $id)->delete();
        foreach ($rates as $key => $value) {
            $_rate = [
                isset($value[0]) && !empty($value[0]) ? $value[0] : -1,
                isset($value[1]) && !empty($value[1]) ? $value[1] : -1
            ];
            $_limit = [
                isset($value[2]) && !empty($value[2]) ? $value[2] : -1,
                isset($value[3]) && !empty($value[3]) ? $value[3] : -1
            ];
            if ($_rate[0] != -1 &&  $_rate[1] != -1 &&  $_limit[0] != -1 &&  $_limit[1] != -1) {
                $arr[] = [
                    "level_id" => $id,
                    "country_code" => strtoupper($key),
                    "rate" => json_encode([
                        $value[0],
                        $value[1]
                    ]),
                    "daily_limit" => json_encode([
                        $value[2],
                        $value[3]
                    ])
                ];
            }
        }
        NOTELevelRate::insert($arr);

        if ($request->submitter == 'apply') {
            return redirect()->back()->with('success', 'Rate cấp độ <b>' . $level->name . '</b> cập nhật thành công!');
        } else {
            return redirect()->route('admin.note_levels.index')->with('success', 'Rate Cấp độ <b>' . $level->name . '</b> cập nhật thành công!');
        }
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
