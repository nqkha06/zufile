<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\LevelRepositoryInterface as LevelRepository;
use App\Enums\BaseStatusEnum;
use App\Repositories\Interfaces\NOTELevelRepositoryInterface as NoteLevelRepository;


class PayoutRateController extends Controller
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
        $note_level_paginted = $this->noteLevelRepository->wherePublished()->getAllPaginated();
        $dataLevels = $this->levelRepository->wherePublished()->with(['translations'])->getAll();

        return view('backend.member_2.payout_rate', compact( 'note_level_paginted', 'dataLevels'));

    }
}
