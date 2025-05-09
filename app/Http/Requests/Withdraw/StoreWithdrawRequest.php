<?php

namespace App\Http\Requests\Withdraw;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreWithdrawRequest extends FormRequest
{
    public function rules()
    {
        return [
            'amount' => [
                'required',
                'integer',
                'in:3,5,10,20,30,50,80,100,500,800,1000,2000,5000,8000',
                function ($attribute, $value, $fail) {
                    $user = Auth::user();
                    
                    if ($user) {
                        $balance = $user->balance;
                        if ($value > $balance) {
                            $fail('Số dư không đủ, cày cuốc mạnh lên đi nào :3');
                        }
                    } else {
                        $fail('Không thể xác định số dư của bạn.');
                    }
                },
            ],
            'type' => 'nullable|in:fast,normal',
        ];
    }


    public function messages()
    {
        return [
            'amount.required' => 'Số tiền là bắt buộc.',
            'amount.integer' => 'Số tiền phải là số nguyên.',
            'amount.in' => 'Giá trị không hợp lệ.',
            'type.in' => 'Kiểu rút không hợp lệ.',
        ];
    }
}
