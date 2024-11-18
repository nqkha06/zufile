<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;

/**
 * Class CategoryRepository.
 */
class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    /**
     * @return string
     *  Return the model
     */
  
     protected $model;

     public function __construct(Category $model)
     {
         $this->model = $model;
     }
     public function all(array $relation = [])
     {
         $cacheKey = 'posts_all_' . md5(json_encode($relation));
 
         return Cache::remember($cacheKey, 60, function () use ($relation) {
             return $this->model->with($relation)->get();
         });
     }
     public function getPaginate($paginate = 10)
     {
         $query = $this->model;
         if (isset($paginate) && !empty($paginate)) {
             $query = $query->paginate($paginate);
         } else {
             $query = $query->get();
         }
         return $query;
     }
}
