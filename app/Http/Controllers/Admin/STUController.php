<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\Interfaces\STUServiceInterface as STUService;

class STUController extends Controller
{
    protected $STUService;

    public function __construct(STUService $STUService) {
        $this->middleware('permission:view_all_stu', ['only' => ['index']]);
        $this->middleware('permission:create_stu', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit_all_stu', ['only' => ['update','edit']]);
        $this->middleware('permission:delete_all_stu', ['only' => ['destroy']]);

        $this->STUService = $STUService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filterParam = $request->only('keyword', 'username', 'start_date', 'end_date', 'level', 'view', 'revenue', 'status');

        $links = $this->STUService->listAllpaginated($filterParam);
        return view('backend.admin.stu.index', compact('links'));
    }

    public function popular(Request $request)
    {
        $filterParam = $request->only('keyword', 'username', 'start_date', 'end_date', 'level', 'view', 'revenue', 'status');

        $links = $this->STUService->listAllPopularPaginated($filterParam, $request->sort_by, $request->sort_order);

        return view('backend.admin.popular.link', compact('links'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    // public function show(Request $request, string $id)
    // {
    //     $link = $this->STUService->show($request, $id);

    //     $data['title'] = 'Liên kết: '. $link['data']->alias;
    //     $data['content'] = 'stu.show';
    //     $data['linkData'] =  $link;

    //     return view('backend.tabler.layout', compact('data'));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function softDelete(string $alias)
    {
        $this->STUService->deleteAny($alias);
        return redirect()->route('admin.stu.index')->with('success', 'Đã xoá mềm liên kết '. $alias . ' thành công!');
    }
    public function restore(string $alias)
    {
        $this->STUService->restoreSTU($alias);
        return redirect()->route('admin.stu.index')->with('success', 'Liên kết đã phục hồi.');
    }
}
