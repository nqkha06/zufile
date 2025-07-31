<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ToolControler extends Controller
{
    public function quick()
    {

        return view('backend.member_2.tool.quick_link', [
            'title' => __('Quick Link'),
        ]);
    }
}
