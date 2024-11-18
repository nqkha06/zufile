<?php

namespace App\Repositories;

use App\Repositories\Interfaces\AddressRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Models\UserAddress;

/**
 * Class AddressRepository.
 */
class AddressRepository extends BaseRepository implements AddressRepositoryInterface
{
    protected $model;

    public function __construct(UserAddress $model) {
        $this->model = $model;
    }
}
