<?php

namespace App\Repositories;

use Spatie\Permission\Models\Permission;
use App\Repositories\Interfaces\PermissionRepositoryInterface;
use App\Repositories\BaseRepository;

/**
 * Class PermissionRepository.
 */
class PermissionRepository extends BaseRepository implements PermissionRepositoryInterface
{
    protected $model;

    public function __construct(Permission $model)
    {
        $this->model = $model;
    }
}
