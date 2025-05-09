<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;

class ReferralController extends Controller
{
    public function index()
    {
        return view('backend.member_2.referral');
    }

    public function ref($id)
    {
        return view('backend.member_2.referral');
    }
}
