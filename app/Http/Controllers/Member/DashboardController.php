<?php

namespace App\Http\Controllers\Member;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\StatisticsService as StatisticsService;
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
        if ($request->header('Accept') === 'application/json') {
            return response()->json($this->statistics());
        }

        $statistic = $this->dashboardService->generate($request);

        return view('backend.member_2.dashboard', compact('statistic'));
    }

    public function statistics()
    {
        return [];
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
    public function topCountries()
    {
        $countries = $this->statisticsService->getTopCountries();

        return response()->json($countries);
    }

    public function topDevices()
    {
        $devices = $this->statisticsService->getTopDevices();

        return response()->json($devices);
    }

    public function topLinks()
    {
        $links = $this->statisticsService->getTopLinks();

        return response()->json($links);
    }

}
