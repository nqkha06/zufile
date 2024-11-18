<?php

namespace App\Repositories\Interfaces;
use App\Repositories\Interfaces\BaseRepositoryInterface;

/**
 * Interface STUStatisticRepositoryInterface
 * @package App\Repositories\Interfaces
 */
interface NOTEStatisticRepositoryInterface extends BaseRepositoryInterface
{
    public function getStatistics($user_id = null);
    public function getStatisticsForMonth($user_id = null, $month, $year);
    public function getStatsBetweenDates($startDate, $endDate);
    public function updateOrInsertStatsByAttr(array $attrs = [], $click_value = 0);

}
