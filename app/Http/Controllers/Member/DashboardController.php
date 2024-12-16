<?php

namespace App\Http\Controllers\Member;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\ApiToken;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UploadImageRequest;

use App\Services\Interfaces\StatisticsServiceInterface as StatisticsService;
use App\Services\Interfaces\DashboardServiceInterface as DashboardService;


class DashboardController extends Controller
{
    protected $statisticsService;
    protected $dashboardService;
    
    public function __construct(StatisticsService $statisticsService, DashboardService $dashboardService)
    {
        $this->statisticsService = $statisticsService;
        $this->dashboardService = $dashboardService;
    }

    public function index(Request $request)
    {
        $get_month = $request->filled('month') && is_numeric(request('month')) && request('month') >= 1 && request('month') <= 12 ? request('month') : date('m');
        $get_year = $request->filled('year') && is_numeric(request('year')) && request('year') >= 1000 && request('year') <= 9999 ? request('year') : date('Y');
        $statistic = $this->dashboardService->generate($request, $get_month, $get_year);

        return view('backend.member.dashboard.index', compact('statistic'));
    }

    public function apiTokens(Request $request) 
    {
        $userId = $request->user()->id;
        $user = User::find($userId);

        $results = ApiToken::where('user_id', $userId)->where('status', 1)->paginate(10);

        $data['title'] = 'Mã API';
        $data['content'] = 'api-tokens';

        $data['user_detail'] = $request->user();
        $data['user_api_tokens'] = $results;

        return view('layouts.member.dashboard_layout', compact('data'));
    }
    public function quickLink(Request $request)
    {
        $userId = $request->user()->id;
        $user = User::find($userId);

        $results = ApiToken::where('user_id', $userId)->where('status', 1)->get();

        $data['title'] = 'Liên kết nhanh';
        $data['content'] = 'quick-link';

        $data['user_detail'] = $request->user();
        $data['user_api_tokens'] = $results;

        return view('layouts.member.dashboard_layout', compact('data'));  
    }

 
    public function upload(Request $request)
{
    if ($request->hasFile('upload')) {

        $originName = $request->file('upload')->getClientOriginalName();

        $fileName = pathinfo($originName, PATHINFO_FILENAME);

        $extension = $request->file('upload')->getClientOriginalExtension();

        $fileName = time() . '.' . $extension;

  
        $request->file('upload')->move(public_path('uploads/notes'), $fileName);

        $url = asset('uploads/notes/' . $fileName);


        return response()->json(['fileName' => $fileName, 'uploaded'=> 1, 'url' => $url]);

    }
}

}
