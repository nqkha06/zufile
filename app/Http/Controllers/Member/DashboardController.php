<?php

namespace App\Http\Controllers\Member;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Interfaces\StatisticsServiceInterface as StatisticsService;
use App\Services\DashboardService as DashboardService;


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
     
        $statistic = $this->dashboardService->generate($request);

        return view('backend.member_2.dashboard', compact('statistic'));
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
