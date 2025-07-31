<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\DashboardService as DashboardService;

class DashboardController extends Controller
{
    protected $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
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
