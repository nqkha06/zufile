<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\WidgetRepositoryInterface;
use App\Models\Widget;
/**
 * Class WidgetRepository.
 */
class WidgetRepository extends BaseRepository implements WidgetRepositoryInterface
{
    /**
     * @return string
     *  Return the model
     */
  
     protected $model;

     public function __construct(Widget $model)
     {
         $this->model = $model;
     }
     
}
