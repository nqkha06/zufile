<?php

namespace App\Repositories\Interfaces;
use App\Repositories\Interfaces\BaseRepositoryInterface;

/**
 * Interface STUStatisticRepositoryInterface
 * @package App\Repositories\Interfaces
 */
interface STUStatisticRepositoryInterface extends BaseRepositoryInterface
{
    public function updateOrInsertStatsByAttr(array $attrs = [], $click_value = 0);
    public function getStatsBetweenDates($startDate, $endDate);
    public function findSTUStats($attrs);
}
