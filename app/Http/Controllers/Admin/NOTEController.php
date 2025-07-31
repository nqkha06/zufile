<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\NOTEService as NOTEService;

class NOTEController extends Controller
{
    protected $NOTEService;

    public function __construct(NOTEService $NOTEService) {
        $this->NOTEService = $NOTEService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filterParam = $request->only('keyword', 'username', 'start_date', 'end_date', 'view', 'revenue', 'status');

        $links = $this->NOTEService->listAllpaginated($filterParam);

        return view('backend.admin.note.index', compact('links'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function softDelete(string $alias)
    {
        $this->NOTEService->softDeleteAny($alias);
        return redirect()->route('admin.note.index')->with('success', 'Đã xoá mềm liên kết '. $alias . ' thành công!');
    }

    public function restore(string $alias)
    {
        $this->NOTEService->restore($alias);
        return redirect()->route('admin.note.index')->with('success', 'Liên kết đã phục hồi.');
    }
}
