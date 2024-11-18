<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index()
    {
        return view('backend.member.profile.index');
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'fullname' => 'required|max:200',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)->ignore($request->user()->id)],
            'phonenumber' => 'required|numeric',
            'address_1' => 'required|max:200',
            'address_2' => 'nullable|max:200',
            'country' => 'required|max:200',
            'city' => 'nullable|max:200',
            'region' =>  'nullable|max:200',
            'zipcode' => 'nullable|max:10',
        ], ['email.unique' => 'Email này đã được người khác sử dụng.']);

        $user = $request->user();
    
        $user->update(['email' => $validatedData['email']]);
    
        $addressData = [
            'user_id' => $user->id,
            'fullname' => $validatedData['fullname'],
            'number_phone' => $validatedData['phonenumber'],
            'address_1' => $validatedData['address_1'],
            'address_2' => $validatedData['address_2'],
            'country' => $validatedData['country'],
            'city' => $validatedData['city'],
            'region' => $validatedData['region'],
            'zipcode' => $validatedData['zipcode'],
        ];
    
        UserAddress::updateOrCreate(
            ['user_id' => $user->id],
            $addressData
        );
    
        return redirect()->back()->with('success', 'Cập nhật thông tin thành công');
    }
}
