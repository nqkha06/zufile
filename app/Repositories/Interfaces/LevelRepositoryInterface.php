<?php

namespace App\Repositories\Interfaces;
use App\Repositories\Interfaces\BaseRepositoryInterface;
/**
 * Interface LevelRepositoryInterface
 * @package App\Repositories\Interfaces
 */
interface LevelRepositoryInterface extends BaseRepositoryInterface
{
    public function pubLevel();
    public function findRevenueStats(array $column = ['*'], $sreach, $orderBy);
}
