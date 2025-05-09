<?php

namespace App\Services;

use App\Repositories\Interfaces\PaymentMethodRepositoryInterface as PaymentMethodRepository;
use App\Services\Abstracts\CrudServiceAbstract;

/**
 * Class PaymentMethodService
 * @package App\Services
 */
class PaymentMethodService extends CrudServiceAbstract
{
    protected function getRepositoryClass(): string {
        return PaymentMethodRepository::class;
    }
}
