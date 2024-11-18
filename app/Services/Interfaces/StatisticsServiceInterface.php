<?php

namespace App\Services\Interfaces;

/**
 * Interface StatisticsServiceInterface
 * @package App\Services\Interfaces
 */
interface StatisticsServiceInterface
{
    public function getStatistics($id);
    
    public function getStatisticsForMonth($user_id = null, $month, $year);
}
