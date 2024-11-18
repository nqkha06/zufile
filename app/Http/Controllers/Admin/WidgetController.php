<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\WidgetServiceInterface as WidgetService;
use App\Repositories\Interfaces\WidgetRepositoryInterface as WidgetRepository;

class WidgetController extends Controller
{
    protected $widgetService;
    protected $widgetRepository;

    public function __construct(WidgetService $widgetService, WidgetRepository $widgetRepository) {
        $this->widgetService = $widgetService;
        $this->widgetRepository = $widgetRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {  
        $widgets = $this->widgetService->getPaginatedWidgets(request()->only('keyword', 'type', 'status', 'method'));

        return view('backend.admin.widget.index', compact('widgets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.widget.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' =>'nullable|max:255',
            'canonical' =>'required|max:255',
            'content' =>'required',
        ]);

        $this->widgetRepository->create($request->only(['name', 'description', 'canonical', 'content']));

        return redirect()->route('admin.widgets.index')->with('success', 'Widget được tạo thành công.');
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
