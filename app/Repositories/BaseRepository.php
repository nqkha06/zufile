<?php

namespace App\Repositories;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use App\Traits\Queryable;
use Illuminate\Database\Eloquent\Model;
use App\Traits\QueryScopes;

/**
 * Class BaseService
 * @package App\Services
 */
class BaseRepository implements BaseRepositoryInterface
{
    use Queryable;

    protected $model;

    public function __construct(
        Model $model
    ){
        $this->model = $model;
    }
    
    public function getModel(): Model {
        return $this->model;
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

    public function forceDelete(int $id = 0){
        return $this->find($id)->forceDelete();
    }

    public function createPivot($model, array $payload = [], string $relation = ''){
        return $model->{$relation}()->attach($model->id, $payload);
    }

}
