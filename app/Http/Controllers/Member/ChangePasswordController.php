<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.member_2.profile.password');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        # Validation
        $request->validate([
            'old_password' => 'required|regex:/^[a-zA-Z0-9]+$/',
            'new_password' => 'required|confirmed',
        ], [
            'old_password.regex' => 'Mật khẩu không được có dấu, khoảng trắng hoặc kí tự đặc biệt'
        ]);


        #Match The Old Password
        if(!Hash::check($request->old_password, Auth::user()->password)){
            return back()->withErrors('Mật khẩu cũ không khớp!');
        }


        #Update the new Password
        User::whereId(Auth::user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with('success', 'Đã thay đổi mật khẩu thành công!');
    }
}
