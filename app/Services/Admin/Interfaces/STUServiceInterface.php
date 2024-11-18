<?php

namespace App\Services\Admin\Interfaces;

/**
 * Interface STUServiceInterface
 * @package App\Services\Interfaces
 */
interface STUServiceInterface
{
    // public function show($request, string $id);
    public function listAllpaginated($searchParams = null, $sortBy = 'created_at', $sortOrder = 'desc', $perPage = 15);
    public function listOwnSTUPaginated($searchParams = null, $sortBy = 'created_at', $sortOrder = 'desc', $perPage = 15);
    public function listAllPopularPaginated($searchParams = null, $sortBy = 'created_at', $sortOrder = 'desc', $perPage = 15);
    public function deleteOwnSTU(string $alias, $user_id);
    public function restoreSTU(string $alias);
    public function deleteAny(string $alias);
    public function updateSTU(string $id, array $payload = []): bool;
    
    public function getLink($alias);
}