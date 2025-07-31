<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\NOTELevelRepositoryInterface as LevelRepository;
use App\Enums\BaseStatusEnum;
use App\Repositories\Interfaces\NOTELevelRepositoryInterface as NoteLevelRepository;
use App\Facades\UserSetting;

class NotePayoutRateController extends Controller
{
    protected $levelRepository;
    protected $noteLevelRepository;

    public function __construct(LevelRepository $levelRepository, NoteLevelRepository $noteLevelRepository)
    {
        $this->levelRepository = $levelRepository;
        $this->noteLevelRepository = $noteLevelRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $autoLevel = UserSetting::get('note_auto_level', 0);

        $dataLevels = $this->levelRepository->wherePublished()->with(['translations'])->getAll();

        return view('backend.member_2.note_payout_rate', compact('dataLevels', 'autoLevel'));
    }

    public function saveAutoLevel(Request $request)
    {
        $autoLevel = $request->input('note_auto_level', 0);
        UserSetting::set('note_auto_level', $autoLevel);

        return redirect()->back()->with('success', __('Auto level setting updated successfully.'));
    }
}
