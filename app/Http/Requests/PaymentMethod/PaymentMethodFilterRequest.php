<?php

namespace App\Http\Requests\PaymentMethod;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\BaseStatusEnum;
use Illuminate\Validation\Rule;

class PaymentMethodFilterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'keyword'    => 'nullable|string|max:255',
            'created_at' => 'nullable|date',
            'status'     => ['nullable', Rule::enum(BaseStatusEnum::class)],
        ];
    }
}
