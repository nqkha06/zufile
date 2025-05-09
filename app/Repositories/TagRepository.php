<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\TagRepositoryInterface;
use App\Models\Tag;
use Illuminate\Support\Facades\Cache;

/**
 * Class CategoryRepository.
 */
class TagRepository extends BaseRepository implements TagRepositoryInterface
{
    /**
     * @return string
     *  Return the model
     */
  
     protected $model;

     public function __construct(Tag $model)
     {
         $this->model = $model;
     }
}
