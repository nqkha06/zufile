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
        $serchParams = [
            ['user_id' => auth()->id()],
            ['status', '!=', 'deleted'],
        ];
        if ($request->has('keyword') && $request->keyword != '') {
            $serchParams[] = ['alias', 'LIKE', '%' . $request->keyword . '%'];
        }
        if ($request->has('level') && $request->level != '') {
            $serchParams[] = ['level_id', $request->level];
        }


        $links = $this->NOTEService->getAllPaginated(
            $serchParams
        );

        return view('backend.member_2.note', compact('links'));
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
