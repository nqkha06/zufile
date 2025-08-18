<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\LevelRepositoryInterface as LevelRepository;
use App\Enums\BaseStatusEnum;
use App\Facades\UserSetting;

class PayoutRateController extends Controller
{
    protected $levelRepository;
    protected $noteLevelRepository;

    public function __construct(LevelRepository $levelRepository)
    {
        $this->levelRepository = $levelRepository;
        // $this->noteLevelRepository = $noteLevelRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $level = $this->levelRepository->wherePublished()->with(['translations', 'rates'])->getAll();
        $level = $level[0];

        return view('clients.payout', compact('level'));
    }

    public function saveAutoLevel(Request $request)
    {
        $autoLevel = $request->input('auto_level', 0);
        UserSetting::set('auto_level', $autoLevel);

        return redirect()->back()->with('success', __('Auto level setting updated successfully.'));
    }
}
