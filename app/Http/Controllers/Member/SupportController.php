<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function index(Request $request)
    {
        // Logic to handle support requests
        // This could include displaying a support form, FAQs, or other support-related content

        return view('backend.member_2.support');
    }


}
