<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

abstract class BaseFilter
{
    protected Builder $query;
    protected array $params;

    /**
     * Constructor
     *
     * @param Builder $query  Eloquent query builder
     * @param array   $params Mảng các tham số lọc (vd: keyword, status, created_at,...)
     */
    public function __construct(Builder $query, array $params = [])
    {
        $this->query = $query;
        $this->params = $params;
    }

    /**
     * Phương thức bắt buộc các lớp con cài đặt để áp dụng các điều kiện lọc
     *
     * @return Builder
     */
    abstract public function apply(): Builder;

    /**
     * Hàm tiện ích để lọc theo keyword cho một column
     *
     * @param string      $column  Tên cột (vd: 'title')
     * @param string|null $keyword Từ khóa
     * @return $this
     */
    protected function filterByKeyword(string $column, ?string $keyword): self
    {
        if (!empty($keyword)) {
            $this->query->where($column, 'like', "%{$keyword}%");
        }

        return $this;
    }

    /**
     * Hàm tiện ích để lọc theo ngày (whereDate)
     *
     * @param string      $column Tên cột (vd: 'created_at')
     * @param string|null $date
     * @return $this
     */
    protected function filterByDate(string $column, ?string $date): self
    {
        if (!empty($date)) {
            $this->query->whereDate($column, $date);
        }

        return $this;
    }

    // Bạn có thể thêm các hàm tiện ích khác như filterByStatus, filterByRange, ...
}
