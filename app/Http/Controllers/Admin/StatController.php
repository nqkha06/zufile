<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\Interfaces\StatServiceInterface as StatService;

class StatController extends Controller
{
    private $statService;
    public function __construct(StatService $statService) {
        $this->statService = $statService;
    }
    public function level(Request $request)
    {
        $levelStat = $this->statService->getAllLevelStats([123]);

        return view('backend.admin.stat.level', compact('levelStat'));
    }
}
