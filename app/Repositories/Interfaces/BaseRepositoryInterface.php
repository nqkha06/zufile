<?php

namespace App\Repositories\Interfaces;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Interface BaseServiceInterface
 * @package App\Services\Interfaces
 */
interface BaseRepositoryInterface
{
    public function all(array $relation);
    public function getAll(array $search = []): Collection;
    public function create(array $payload);
    public function update(int $id = 0, array $payload = []);
    public function updateOrInsert(array $attributes, array $values);
    public function delete(int $id = 0);
    public function getAllPaginated(array $search = [], int $pageSize = 10);
    public function find($id);
    public function findOrFail($value, ?string $column = null);
    public function findMany(array $attributes): Collection;
    public function findFirst(array $attributes): ?Model;
    public function with(array $with);
    public function withCount(array $withCount);
    public function deleteAll(array $search = []): int;

}
