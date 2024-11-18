<?php

namespace App\Services\Interfaces;

/**
 * Interface AccessServiceInterface
 * @package App\Services\Interfaces
 */
interface AccessServiceInterface
{
    public function getPaginatedAccesses($searchParams);
    public function deleteAllAccess(): bool;
}
