<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Facades\UserSetting;

class AccountController extends Controller
{
    public function index()
    {
        // Logic to display the member's account information
        return view('backend.member_2.account');
    }

    public function update(Request $request)
    {
        $request->validate([
            '_upload' => 'nullable|in:1',
            'private' => 'nullable|in:on'
            // Add other validation rules as needed
        ]);

        if ($request->has('_upload')) {
            UserSetting::set('private_upload', $request->input('private') == 'on' ? 1 : 0);
        }

        return response()->json(['message' => 'Account settings updated successfully.']);
    }
}
