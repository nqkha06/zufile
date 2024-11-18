<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\PostViewRepositoryInterface;
use App\Models\PostView;
/**
 * Class PostViewRepository.
 */
class PostViewRepository extends BaseRepository implements PostViewRepositoryInterface
{
    /**
     * @return string
     *  Return the model
     */
  
     protected $model;

     public function __construct(PostView $model)
     {
         $this->model = $model;
     }
     
}
