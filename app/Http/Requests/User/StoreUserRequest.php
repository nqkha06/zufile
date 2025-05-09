<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
{

    public function rules(): array
    {
        $rules = [
            'name' => [
                'required',
                'string',
                'max:250',
                Rule::unique('users'),
            ],
            'email' => [
                'required',
                'string',
                'email',
                Rule::unique('users'),
            ],
            'fullname' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'address_1' => 'nullable|string|max:255',
            'address_2' => 'nullable|string|max:255',
            'region' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
            'zipcode' => 'nullable|string|max:20',
            'role' => 'nullable|array',
            'role.*' => 'exists:roles,id',
            'payment_method' => 'nullable|exists:payment_methods,id',
            'fields' => 'nullable|array',
            'fields.*' => 'nullable|string',
        ];

        return $rules;
    }
}
