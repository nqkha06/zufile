<?php

namespace App\Repositories\Abstracts;

use Closure;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\LazyCollection;
use App\Enums\BaseStatusEnum;
use App\Repositories\Interfaces\BaseRepositoryInterface;

use App\Filters\BaseFilter;

class BaseRepositoryAbstract implements BaseRepositoryInterface
{
    /**
     * Handle soft deletes
     *
     * @var int
     */
    private static $EXCLUDE_DELETED = 1;
    private static $INCLUDE_DELETED = 2;
    private static $ONLY_DELETED = 3;

    /**
     * @var string
     */
    protected $defaultOrderBy;

    /**
     * @var string
     */
    protected $deletedAtColumnName = 'deleted_at';

    /**
     * Array of "with" relations
     *
     * @var array
     */
    protected $with = [];

    /**
     * Array of "withCount" relations
     *
     * @var array
     */
    protected $withCount = [];

    /**
     * Array of "global scopes" to exclude
     *
     * @var array
     */
    protected $withoutGlobalScopes = [];

    protected $conditions = [];

    /**
     * Soft query delete handle
     *
     * @var int
     */
    protected $softDeleteQueryMode;

    /**
     * Find model by PK
     *
     * @param $key
     * @return Model|null
     */
    protected $model;

    protected ?BaseFilter $filter = null;

    public function setFilter(BaseFilter $filter): self
    {
        $this->filter = $filter;
        return $this;
    }
    /**
     * QueryableAbstract constructor.
     * Gọi hàm getModel() để gán $this->model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get model
     *
     * @return Model
     */
    public function getModel() {
        $model = $this->model;
        return $model;
    }

    public function find($key): ?Model
    {
        return $this->getQuery()->whereKey($key)->first();
    }

    /**
     * Find or fail by primary key or custom column
     *
     * @param $value
     * @param string|null $column
     * @return Model
     * @throws RepositoryException
     */
    public function findOrFail($value, ?string $column = null): Model
    {
        if (is_null($column)) {
            return is_array($value)
                ? $this->findMany([$value])->firstOrFail()
                : $this->getQuery()->findOrFail($value);
        }

        return $this->getQuery()->where($column, $value)->firstOrFail();
    }

    /**
     * Find all models by params
     *
     * @param array $attributes
     * @return Collection
     * @throws RepositoryException
     */
    public function findMany(array $attributes): Collection
    {
        return $this->applyFilterConditions($attributes)->get();
    }

    /**
     * Find first model
     *
     * @param array $attributes
     * @return Model|null
     * @throws RepositoryException
     */
    public function findFirst(array $attributes): ?Model
    {
        return $this->findMany($attributes)->first();
    }

    /**
     * Get filtered collection
     *
     * @param array $search
     * @return Collection
     * @throws RepositoryException
     */
    public function getAll(array $search = []): Collection
    {
        return $this->applyFilters($search)->get();
    }

    public function deleteAll(array $search = []): int
    {
        return $this->applyFilters($search)->delete();
    }

    /**
     * Get filtered collection as cursor output
     *
     * @param array $search
     * @return LazyCollection
     * @throws RepositoryException
     */
    public function getAllCursor(array $search = []): LazyCollection
    {
        return $this->applyFilters($search)->cursor();
    }

    /**
     * Get results count
     *
     * @throws RepositoryException
     */
    public function count(array $search = []): int
    {
        return $this->applyFilters($search)->count();
    }

    /**
     * Get paginated data
     *
     * @param array $search
     * @param int $pageSize
     * @return LengthAwarePaginator
     * @throws RepositoryException
     */
    public function getAllPaginated(array $search = [], int $pageSize = 15): LengthAwarePaginator
    {
        return $this->applyFilters($search)->paginate($pageSize)->appends(request()->query());
    }

    /**
     * Set with
     *
     * @param array $with
     * @return BaseRepositoryInterface
     */
    public function with(array $with): BaseRepositoryInterface
    {
        $this->with = $with;

        return $this;
    }

    public function wherePublished(): BaseRepositoryInterface
    {
        $this->conditions[] = ['status', '=', BaseStatusEnum::PUBLISHED];
        return $this;
    }

    /**
     * Set global scopes to include
     *
     * @param array $withoutGlobalScopes
     * @return BaseRepositoryInterface
     */
    public function withoutGlobalScopes(array $withoutGlobalScopes): BaseRepositoryInterface
    {
        $this->withoutGlobalScopes = $withoutGlobalScopes;

        return $this;
    }

    /**
     * Set with count
     *
     * @param array $withCount
     * @return BaseRepositoryInterface
     */
    public function withCount(array $withCount): BaseRepositoryInterface
    {
        $this->withCount = $withCount;

        return $this;
    }

    /**
     * Include soft deleted records to a query
     *
     * @return BaseRepositoryInterface
     */
    public function withTrashed(): BaseRepositoryInterface
    {
        $this->softDeleteQueryMode = self::$INCLUDE_DELETED;

        return $this;
    }

    /**
     * Show only soft deleted records in a query
     *
     * @return BaseRepositoryInterface
     */
    public function onlyTrashed(): BaseRepositoryInterface
    {
        $this->softDeleteQueryMode = self::$ONLY_DELETED;

        return $this;
    }

    /**
     * Exclude soft deleted records from a query
     *
     * @return BaseRepositoryInterface
     */
    public function withoutTrashed(): BaseRepositoryInterface
    {
        $this->softDeleteQueryMode = self::$EXCLUDE_DELETED;

        return $this;
    }
    public function create(array $payload = []){
        $model = $this->model->create($payload);
        return $model->fresh();
    }
    public function update(int $id = 0, array $payload = []){
        $model = $this->find($id);
        return $model->update($payload);
     }


     public function delete(int $id = 0){
         return $this->find($id)->delete();
     }
    /**
     * The purpose of this function is to apply filtering to the model by overriding this function inside child repository
     *
     * @param array $searchParams
     * @return Builder
     * @throws RepositoryException
     */
    protected function applyFilters(array $searchParams = []): Builder
    {
        $query = $this->applyFilterConditions(array_merge($searchParams, $this->conditions));

        // Áp dụng Filter nếu có
        if ($this->filter) {
            $query = $this->filter->apply();
        }

        return $query->when(
            !is_array(($orderByField = $this->defaultOrderBy ?? $this->model->getKeyName())),
            function (Builder $query) use ($orderByField) {
                $query->orderBy($orderByField, 'desc');
            }
        );
    }

    /**
     * Apply filter conditions
     *
     * @param array $conditions
     * @return Builder
     * @throws RepositoryException
     */
    protected function applyFilterConditions(array $conditions): Builder
    {
        $query = $this->getQuery();

        if (empty($conditions)) {
            return $query;
        }

        $conditions = $this->parseConditions($conditions);

        foreach ($conditions as $data) {
            list($field, $operator, $val) = $data;

            $operator = preg_replace('/\s\s+/', ' ', trim($operator));

            $exploded = explode(' ', $operator);
            $condition = strtoupper(trim($exploded[0]));
            $operator = trim($exploded[1] ?? '=');

            // Detect if it's an orWhere condition
            $isOrWhere = false;
            if (str_starts_with($condition, 'OR')) {
                $isOrWhere = true;
                $condition = str_replace('OR', '', $condition);
            }
            $whereMethod = $isOrWhere ? 'orWhere' : 'where';

            switch ($condition) {
                case 'NULL':
                    $query->{$whereMethod . 'Null'}($field);
                    break;
                case 'NOT_NULL':
                    $query->{$whereMethod . 'NotNull'}($field);
                    break;
                case 'IN':
                    $this->validateArrayData($val);
                    $query->{$whereMethod . 'In'}($field, $val);
                    break;
                case 'NOT_IN':
                    $this->validateArrayData($val);
                    $query->{$whereMethod . 'NotIn'}($field, $val);
                    break;
                case 'DATE':
                    $query->{$whereMethod . 'Date'}($field, $operator, $val);
                    break;
                case 'DAY':
                    $query->{$whereMethod . 'Day'}($field, $operator, $val);
                    break;
                case 'MONTH':
                    $query->{$whereMethod . 'Month'}($field, $operator, $val);
                    break;
                case 'YEAR':
                    $query->{$whereMethod . 'Year'}($field, $operator, $val);
                    break;
                case 'HAS':
                    $this->validateClosureFunction($val);
                    $query->{$whereMethod . 'Has'}($field, $val);
                    break;
                case 'DOESNT_HAVE':
                    $this->validateClosureFunction($val);
                    $query->{$whereMethod . 'DoesntHave'}($field, $val);
                    break;
                case 'HAS_MORPH':
                    $this->validateClosureFunction($val);
                    $query->{$whereMethod . 'HasMorph'}($field, $val);
                    break;
                case 'DOESNT_HAVE_MORPH':
                    $this->validateClosureFunction($val);
                    $query->{$whereMethod . 'DoesntHaveMorph'}($field, $val);
                    break;
                case 'BETWEEN':
                    $this->validateArrayData($val);
                    $query->{$whereMethod . 'Between'}($field, $val);
                    break;
                case 'BETWEEN_COLUMNS':
                    $this->validateArrayData($val);
                    $query->{$whereMethod . 'BetweenColumns'}($field, $val);
                    break;
                case 'NOT_BETWEEN':
                    $this->validateArrayData($val);
                    $query->{$whereMethod . 'NotBetween'}($field, $val);
                    break;
                case 'NOT_BETWEEN_COLUMNS':
                    $this->validateArrayData($val);
                    $query->{$whereMethod . 'NotBetweenColumns'}($field, $val);
                    break;
                case 'LIKE':
                    $query->{$whereMethod}($field, 'like', $val);
                    break;
                case 'NOT_LIKE':
                    $query->{$whereMethod}($field, 'not like', $val);
                    break;
                default:
                    $query->{$whereMethod}($field, $condition, $val);
            }
        }

        return $query;
    }


    /**
     * @return Builder
     */
    protected function getQuery(): Builder
    {
        /** @var Model $model */
        $model = $this->model;

        // $query = $this->isInstanceOfSoftDeletes($model)
        //     ? $model->newQueryWithoutScope(SoftDeletingScope::class)
        //     : $model->query();
            $query = $model->query();
        return $query
            ->when(!empty($this->withoutGlobalScopes), function (Builder $query) {
                $query->withoutGlobalScopes($this->withoutGlobalScopes);
            })
            ->when(!empty($this->with), function (Builder $query) {
                $query->with($this->with);
            })
            ->when(!empty($this->withCount), function (Builder $query) {
                $query->withCount($this->withCount);
            });
            // ->when(
            //     $this->isInstanceOfSoftDeletes($model) || $this->isModelHasSoftDeleteColumn($model),
            //     function (Builder $query) {
            //         $mode = $this->softDeleteQueryMode ?? self::$EXCLUDE_DELETED;

            //         $query
            //             ->when($mode === self::$EXCLUDE_DELETED, function (Builder $query) {
            //                 $query->whereNull($this->deletedAtColumnName);
            //             })
            //             ->when($mode === self::$INCLUDE_DELETED, function (Builder $query) {
            //                 $query->where(function (Builder $query) {
            //                     $query
            //                         ->whereNull($this->deletedAtColumnName)
            //                         ->orWhereNotNull($this->deletedAtColumnName);
            //                 });
            //             })
            //             ->when($mode === self::$ONLY_DELETED, function (Builder $query) {
            //                 $query->whereNotNull($this->deletedAtColumnName);
            //             });
            //     }
            // );
    }

    /**
     * Get condition data for search
     *
     * @param array $conditions
     * @return array
     */
    private function parseConditions(array $conditions): array
    {
        $processedConditions = [];

        if (isset($conditions[0]) && !is_array($conditions[0])) {
            $conditions = [$conditions];
        }

        foreach ($conditions as $field => $condition) {
            // [field, operator, value] or [field, value] handler
            if (is_array($condition) && ($count = count($condition)) >= 2 && isset($condition[0])) {
                $processedConditions[] = [
                    $condition[0],
                    $count === 2 ? (!in_array(strtoupper($condition[1]), [
                        'NULL',
                        'NOT_NULL'
                    ]) ? '=' : $condition[1]) : $condition[1],
                    $condition[2] ?? $condition[1]
                ];
                continue;
            }

            // 'key' => 'value' handler
            if (is_string($field) && !is_array($condition)) {
                $processedConditions[] = [$field, '=', $condition];
                continue;
            }

            // ['key' => 'value'] handler
            if (is_numeric($field) && is_array($condition) && !isset($condition[0])) {
                $field = key($condition);

                if (!isset($condition[$field])) {
                    continue;
                }

                $processedConditions[] = [$field, '=', $condition[$field]];
            }
        }

        return $processedConditions;
    }

    /**
     * Validate array data
     *
     * @throws RepositoryException
     */
    private function validateArrayData($data): void
    {
        if (!is_array($data)) {
            // throw new RepositoryException("Invalid data provided, data must be an array.");
        }
    }

    /**
     * Validate closure data
     *
     * @throws RepositoryException
     */
    private function validateClosureFunction($value): void
    {
        if (!$value instanceof Closure && !is_null($value)) {
            // throw new RepositoryException("Invalid closure provided.");
        }
    }

    public function query(): Builder
    {
        return $this->getQuery();
    }
}
