<?php

namespace App\Http\Requests\Page;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\BaseStatusEnum;
use Illuminate\Validation\Rule;

class PageFilterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Điều chỉnh theo logic phân quyền của bạn
    }

    public function rules(): array
    {
        return [
            'keyword'    => 'nullable|string|max:255',
            'created_at' => 'nullable|date',
            'status'     => ['nullable', Rule::enum(BaseStatusEnum::class)],
            'page_size'  => 'nullable|integer|min:1|max:100',
            // Thêm các quy tắc validate khác nếu cần
        ];
    }

    /**
     * Tùy chỉnh các thông báo lỗi (nếu cần)
     */
    public function messages()
    {
        return [
            'keyword.string'    => 'Từ khóa phải là chuỗi ký tự.',
            'created_at.date'   => 'Ngày tạo không hợp lệ.',
            'status.in'         => 'Trạng thái không hợp lệ.',
            'page_size.integer' => 'Kích thước trang phải là số nguyên.',
            // Thêm các thông báo khác nếu cần
        ];
    }
}
