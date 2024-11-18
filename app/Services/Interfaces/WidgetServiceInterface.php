<?php

namespace App\Services\Interfaces;

/**
 * Interface WidgetServiceInterface
 * @package App\Services\Interfaces
 */
interface WidgetServiceInterface
{
    public function getPaginatedWidgets($searchParams = null, $sortBy = 'created_at', $sortOrder = 'desc', $perPage = 15);
}
