<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\DashboardServiceInterface as DashboardService;
use App\Repositories\Interfaces\StatisticsRepositoryInterface as StatisticsRepository;
use App\Services\Interfaces\AccessServiceInterface as AccessService;

class AccessController extends Controller
{
    protected $dashboardService;
    protected $statisticsRepository;
    protected $accessService;

    public function __construct(AccessService $accessService)
    {
        $this->accessService = $accessService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $searchParams = $request->only('group_by', 'parent', 'order_by', 'order_direction', 'start_date', 'end_date', 'link', 'user');
        $accessData = $this->accessService->getPaginatedAccesses($searchParams);

        return view('backend.admin.access.index', compact('accessData'));
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
    public function show(string $id)
    {
        //
    }

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
    public function destroy(string $id)
    {
        //
    }
}
