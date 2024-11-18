<?php

namespace App\Repositories\Interfaces;
use App\Repositories\Interfaces\BaseRepositoryInterface;
/**
 * Interface NOTELevelRepositoryInterface
 * @package App\Repositories\Interfaces
 */
interface NOTELevelRepositoryInterface extends BaseRepositoryInterface
{
    public function getAll();
    public function pubLevel();
}
