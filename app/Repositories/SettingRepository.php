<?php

namespace App\Repositories;

use App\Models\Setting;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Repositories\BaseRepository;

/**
 * Class SettingRepository.
 */
class SettingRepository extends BaseRepository implements SettingRepositoryInterface
{
    /**
     * @return string
     *  Return the model
     */
    protected $model;

    public function __construct(Setting $model)
    {
        $this->model = $model;
    }
}
