<?php

namespace App\Services\Interfaces;

/**
 * Interface NOTEServiceInterface
 * @package App\Services\Interfaces
 */
interface NOTEServiceInterface
{
    public function index($request);
    public function listAllpaginated($searchParams = null, $sortBy = 'created_at', $sortOrder = 'desc', $perPage = 15);
    public function softDeleteOwn($alias);
    public function softDeleteAny($alias);

    public function restore(string $alias);
}
