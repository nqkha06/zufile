<?php

namespace App\Repositories\Interfaces;
use App\Repositories\Interfaces\BaseRepositoryInterface;
/**
 * Interface STUAccessRepositoryInterface
 * @package App\Repositories\Interfaces
 */
interface STUAccessRepositoryInterface extends BaseRepositoryInterface
{
    public function getStatsBetweenDates(
        $column = ['*'],
        array $date,
        $group,
        array $order = [],
        array $relation = []
    );
    public function getAccessedByCondition(
        array $condition,
        string $date,
        array $relation = []
    );
    public function getAccessByCondition(
        array $condition,
        array $column = ['*'],
        string $groupBy,
        array $orderBy = ['id', 'desc'],
        array $relation = []
    );
    public function sumAccessByCondition(
        array $condition,
        string $column = '',
    );
}
