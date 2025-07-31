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
