<?php

namespace App\Http\Requests\PaymentMethod;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\BaseStatusEnum;
use Illuminate\Validation\Rule;

class UpdatePaymentMethodRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'status' => ['required', Rule::enum(BaseStatusEnum::class)],
            'withdraw_fee' => 'required|numeric|min:0',
            'min_withdraw_amount' => 'required|numeric|min:0',
            'fields' => 'nullable|array',
            'fields.*.label' => 'required|string|max:255',
            'fields.*.name' => 'required|string|max:255|alpha_dash',
            'fields.*.type' => 'required|in:text,number,email,password,select',
            'fields.*.options' => 'nullable|string', // Thêm quy tắc validate cho options
            'fields.*.placeholder' => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'fields.*.label.required' => 'Nhãn hiển thị của trường là bắt buộc.',
            'fields.*.name.required' => 'Tên trường là bắt buộc.',
            'fields.*.name.alpha_dash' => 'Tên trường chỉ chứa chữ, số, dấu gạch ngang và dấu gạch dưới.',
            'fields.*.type.required' => 'Loại trường là bắt buộc.',
            'fields.*.type.in' => 'Loại trường không hợp lệ.',
            // Thêm các thông báo lỗi khác nếu cần
        ];
    }
}