<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\LevelRepositoryInterface as LevelRepository;

class PayoutRateController extends Controller
{
    protected $levelRepository;

    public function __construct(LevelRepository $levelRepository)
    {
        $this->levelRepository = $levelRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $level_paginted = $this->levelRepository->pagination(['*'], ['where' => [['status', '=', 1]]]);

        return view('backend.member.payout-rate.index', compact('level_paginted'));

    }
}
