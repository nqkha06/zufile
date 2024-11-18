<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\Interfaces\DashboardServiceInterface as DashboardService;
use App\Services\SystemMonitorService;

class DashboardController extends Controller
{
    protected $dashboardService;
    protected $systemMonitorService;

    public function __construct(DashboardService $dashboardService, SystemMonitorService $systemMonitorService)
    {
        $this->dashboardService = $dashboardService;
        $this->systemMonitorService = $systemMonitorService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $stats = $this->dashboardService->index($request);
        $data['data'] = $stats;

        return view('backend.admin.dashboard.index', compact('data'));
    }

}
