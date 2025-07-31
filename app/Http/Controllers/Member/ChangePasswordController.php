<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function update(Request $request)
    {
        # Validation
        $request->validate([
            'current_password' => 'required|max:255',
            'password' => 'required|max:255|regex:/^[\x20-\x7E]*$/',
        ], [
            'password.regex' => 'Mật khẩu không được có dấu, khoảng trắng.',
            'current_password.required' => 'Mật khẩu hiện tại là bắt buộc.',
            'password.required' => 'Mật khẩu mới là bắt buộc.',
            'password.max' => 'Mật khẩu mới không được vượt quá 255 ký tự.',
        ]);


        #Match The Old Password
        if(!Hash::check($request->current_password, Auth::user()->password)){
            return response()->json(['message' => 'Mật khẩu hiện tại không đúng.'], 422);
        }

        #Update the new Password
        User::whereId(Auth::user()->id)->update([
            'password' => Hash::make($request->password)
        ]);

        return response()->json(['message' => 'Mật khẩu đã được cập nhật thành công.']);
    }
}
