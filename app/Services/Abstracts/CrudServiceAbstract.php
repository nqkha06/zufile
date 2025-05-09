<?php

namespace App\Services\Abstracts;

use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\LazyCollection;
use App\Exceptions\ServiceException;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 * Class BaseCrudService
 */
abstract class CrudServiceAbstract
{

    protected $repository;

    /**
     * BaseCrudService constructor.
     */
    public function __construct()
    {
        $this->repository = app($this->getRepositoryClass());
    }


    public function with(array $with)
    {
        $this->repository->with($with);

        return $this;
    }

    public function withCount(array $withCount)
    {
        $this->repository->withCount($withCount);

        return $this;
    }


    public function withTrashed()
    {
        $this->repository->withTrashed();

        return $this;
    }


    public function onlyTrashed()
    {
        $this->repository->onlyTrashed();

        return $this;
    }


    public function withoutTrashed()
    {
        $this->repository->withoutTrashed();

        return $this;
    }

    /**
     * Get filtered results
     *
     * @param array $search
     * @param int $pageSize
     * @return LengthAwarePaginator
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getAllPaginated(array $search = [], int $pageSize = 15): LengthAwarePaginator
    {
        return $this->repository->getAllPaginated($search, request()->get('page_size', $pageSize));
    }

    /**
     * Get all records as collection
     *
     * @param array $search
     * @return EloquentCollection
     */
    public function getAll(array $search = []): EloquentCollection
    {
        return $this->repository->getAll($search);
    }

    /**
     * Get all records as lazy collection (cursor)
     *
     * @param array $search
     * @return LazyCollection
     */
    public function getAllAsCursor(array $search = []): LazyCollection
    {
        return $this->repository->getAllCursor($search);
    }


    public function count(array $search = []): int
    {
        return $this->repository->count($search);
    }

    /**
     * Find or fail the model
     *
     * @param $key
     * @param string|null $column
     * @return Model
     */
    public function findOrFail($key, string $column = null): Model
    {
        return $this->repository->findOrFail($key, $column);
    }

    /**
     * Find models by attributes
     *
     * @param array $attributes
     * @return Collection
     */
    public function find(array $attributes): Collection
    {
        return $this->repository->findMany($attributes);
    }


    public function create(array $data): ?Model
    {
        if (is_null($model = $this->repository->create($data))) {
            throw new \Exception('Error while creating model');
        }

        return $model;
    }

    /**
     * Insert data into db
     *
     * @param array $data
     * @return bool
     */
    public function insert(array $data): bool
    {
        return $this->repository->insert($data);
    }

    public function createMany(array $attributes): Collection
    {
        if (empty($attributes)) {
            throw new \Exception('Data is empty');
        }

        return DB::transaction(function () use ($attributes) {
            $models = collect();

            foreach ($attributes as $data) {
                $models->push($this->create($data));
            }

            return $models;
        });
    }


    public function updateOrCreate(array $attributes, array $data): ?Model
    {
        if (is_null($model = $this->repository->updateOrCreate($attributes, $data))) {
            throw new \Exception('Error while creating or updating the model');
        }

        return $model;
    }


    public function update($keyOrModel, array $data): ?Model
    {
        return $this->repository->update($keyOrModel, $data);
    }


    public function delete($keyOrModel): bool
    {
        if (!$this->repository->delete($keyOrModel)) {
            throw new \Exception('Error while deleting model');
        }

        return true;
    }


    public function deleteMany(array $keysOrModels): void
    {
        DB::transaction(function () use ($keysOrModels) {
            foreach ($keysOrModels as $keyOrModel) {
                $this->delete($keyOrModel);
            }
        });
    }


    public function softDelete($keyOrModel): void
    {
        $this->repository->softDelete($keyOrModel);
    }

 
    public function restore($keyOrModel): void
    {
        $this->repository->restore($keyOrModel);
    }

    /**
     * Should return RepositoryInterface::class
     *
     * @return string
     */
    abstract protected function getRepositoryClass(): string;
}