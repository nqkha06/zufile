<?php

namespace App\Repositories\Interfaces;
use App\Repositories\Interfaces\BaseRepositoryInterface;
/**
 * Interface CategoryRepositoryInterface
 * @package App\Repositories\Interfaces
 */
interface CategoryRepositoryInterface extends BaseRepositoryInterface
{
    public function all(array $relation = []);
    public function getPaginate($paginate = 10);
}
