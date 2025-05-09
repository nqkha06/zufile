<?php

namespace App\Services\Interfaces;
use Illuminate\Support\Collection;
/**
 * Interface PageServiceInterface
 * @package App\Services\Interfaces
 */
interface PageServiceInterface
{
    public function listAllPagesPaginated();
    public function updatePage($id, $req);
    public function find(array $attributes): Collection;
    public function findOrFail($key, string $column = null);

}
