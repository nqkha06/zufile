<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\StuAnalysis;

class LeaderboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = StuAnalysis::selectRaw('user_id, count(*) as total_views')
            ->where('user_id', '!=', 0)
            ->groupBy('user_id')
            ->orderBy('total_views', 'desc')
            ->with('user')
            ->take(10)->get();
        return view('backend.member_2.leaderboard', compact('users'));
    }

   
}
