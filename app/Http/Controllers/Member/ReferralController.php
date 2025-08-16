<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;

class ReferralController extends Controller
{
    public function index()
    {
        $referrals = auth()->user()->referrals()->get();

        return view('backend.member_2.referral', compact('referrals'));
    }

    public function ref($id)
    {
        return view('backend.member_2.referral');
    }
}
