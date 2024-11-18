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
    public function getAll();
    public function findById(int $modelId, array $column = ['*'], array $relation = []);
    public function findByCondition($condition = [], array $relation = []);
    public function create(array $payload);
    public function update(int $id = 0, array $payload = []);
    public function updateOrInsert(array $attributes, array $values);
    public function delete(int $id = 0);
    public function getPaginate();
    public function pagination(
        array $column = ['*'], 
        array $condition = [], 
        int $perPage = 1,
        array $extend = [],
        array $orderBy = ['id', 'DESC'],
        array $join = [],
        array $relations = [],
        array $rawQuery = [],
    );
    public function updateByWhereIn(string $whereInField = '', array $whereIn = [], array $payload = []);
    public function createPivot($model, array $payload = [], string $relation = '');
    public function forceDeleteByCondition(array $condition = []);
    public function getByCondition($condition = [], array $relation = []);
    public function firstOrNew(array $attributes, array $values = []);
    public function firstByCondition($condition = [], array $relation = []);
    public function getAllPaginated(array $search = [], int $pageSize = 10);
    public function find($id);
    public function findOrFail($value, ?string $column = null);
    public function findMany(array $attributes): Collection;
    public function findFirst(array $attributes): ?Model;
    public function with(array $with);
    public function withCount(array $withCount);
    public function deleteAll(array $search = []): int;

}
