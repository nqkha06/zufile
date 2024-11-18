<?php

namespace App\Repositories;

use App\Models\PaymentMethod;
use App\Repositories\Interfaces\PaymentMethodRepositoryInterface;
use App\Repositories\BaseRepository;

/**
 * Class PaymentMethodRepository.
 */
class PaymentMethodRepository extends BaseRepository implements PaymentMethodRepositoryInterface
{
    protected $model;

    public function __construct(PaymentMethod $model)
    {
        $this->model = $model;
    }
}
