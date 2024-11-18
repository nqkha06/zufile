<?php

namespace App\Repositories\Interfaces;
use App\Repositories\Interfaces\BaseRepositoryInterface;
/**
 * Interface AccessRepositoryInterface
 * @package App\Repositories\Interfaces
 */
interface AccessRepositoryInterface extends BaseRepositoryInterface
{
    public function getAllAccessesPaginated (
        $column = ['*'],
        array $date,
        $group,
        array $order = [],
        array $conditions
    );
    public function getRealTimeAccesseMinutes(int $minutes = 30);
}
