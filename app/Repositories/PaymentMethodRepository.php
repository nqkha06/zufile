<?php

namespace App\Repositories;

use App\Models\PaymentMethod;
use App\Repositories\Interfaces\PaymentMethodRepositoryInterface;
use App\Repositories\Abstracts\BaseRepositoryAbstract;
use App\Filters\PaymentMethodFilter;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class PaymentMethodRepository.
 */
class PaymentMethodRepository extends BaseRepositoryAbstract implements PaymentMethodRepositoryInterface
{
    public function __construct(PaymentMethod $model) {
        parent::__construct($model);
    }

    public function getAllPaginated(array $search = [], int $pageSize = 15): LengthAwarePaginator
    {
        $filter = new PaymentMethodFilter($this->getQuery(), $search);
        $this->setFilter($filter);

        return parent::getAllPaginated($search, $pageSize);
    }
}
