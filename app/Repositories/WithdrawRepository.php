<?php

namespace App\Repositories;

use App\Models\UserWithdraw as Withdraw;
use App\Repositories\Interfaces\WithdrawRepositoryInterface;
use App\Repositories\BaseRepository;
/**
 * Class WithdrawReponsitory.
 */
class WithdrawRepository extends BaseRepository implements WithdrawRepositoryInterface
{
    /**
     * @return string
     *  Return the model
     */
    protected  $model;

    public function __construct(Withdraw $model)
    {
        $this->model = $model;
    }

    public function findInvoice($id) {
        return $this->model->find($id);
    }
}
