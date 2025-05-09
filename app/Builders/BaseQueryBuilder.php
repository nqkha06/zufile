<?php
namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;
use App\Enums\BaseStatusEnum;

class BaseQueryBuilder extends Builder
{

    public function wherePublished($column = 'status'): static
    {
        $this->where($column, BaseStatusEnum::PUBLISHED);

        return $this;
    }
}