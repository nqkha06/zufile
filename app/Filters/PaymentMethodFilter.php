<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class PaymentMethodFilter extends BaseFilter
{
    /**
     * Áp dụng các điều kiện lọc cụ thể cho bảng "pages"
     *
     * @return Builder
     */
    public function apply(): Builder
    {
        // Lọc theo keyword (title)
        $this->filterByKeyword('name', $this->params['keyword'] ?? null);

        // Lọc theo ngày tạo
        $this->filterByDate('created_at', $this->params['created_at'] ?? null);

        // Lọc theo status
        if (!empty($this->params['status'])) {
            $this->query->where('status', $this->params['status']);
        }

        // Thêm các điều kiện lọc khác nếu cần

        return $this->query;
    }
}
