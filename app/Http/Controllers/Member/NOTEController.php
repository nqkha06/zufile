<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\NOTEService as NOTEService;

class NOTEController extends Controller
{

    protected $NOTEService;

    public function __construct(NOTEService $NOTEService)
    {
        $this->NOTEService = $NOTEService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user_note_links = $this->NOTEService->getAllPaginated();

        return view('backend.member.note-link.index', compact('user_note_links'));
    }

    public function destroy(string $alias)
    {
        $destroy = $this->NOTEService->softDeleteOwn($alias);
        
        if ($destroy) {
            return redirect()->back()
            ->with('success', 'Đã xoá liên kết note: <b>'.$alias.'</b> thành công!');
        }

        return redirect()->back()
            ->with('error', 'Không thể xoá liên kết note: <b>'.$alias.'</b>, thử lại sau!');
    }
}
