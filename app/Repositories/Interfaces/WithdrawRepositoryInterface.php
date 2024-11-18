<?php

namespace App\Repositories\Interfaces;
use App\Repositories\Interfaces\BaseRepositoryInterface;
/**
 * Interface StatisticsRepositoryInterface
 * @package App\Repositories\Interfaces
 */
interface WithdrawRepositoryInterface extends BaseRepositoryInterface
{
    public function findInvoice($id);
}
