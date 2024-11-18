<?php

namespace App\Repositories;

use Spatie\Permission\Models\Role;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Repositories\BaseRepository;

/**
 * Class RoleRepository.
 */
class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{
    protected $model;

    public function __construct(Role $model)
    {
        $this->model = $model;
    }
}
