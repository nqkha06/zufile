<?php

namespace App\Services\Interfaces;

/**
 * Interface STULevelServiceInterface
 * @package App\Services\Interfaces
 */
interface STULevelServiceInterface
{
    public function getPaginatedWidgets($searchParams = null, $sortBy = 'created_at', $sortOrder = 'desc', $perPage = 15);
}
