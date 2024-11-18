<?php

namespace App\Services\Interfaces;

/**
 * Interface DashboardServiceInterface
 * @package App\Services\Interfaces
 */
interface DashboardServiceInterface
{
    public function generate($user, $month, $year);
    public function adminIndex($request);
}
