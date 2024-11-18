<?php

namespace App\Services\Admin\Interfaces;

/**
 * Interface UserServiceInterface
 * @package App\Services\Admin\Interfaces
 */
interface UserServiceInterface
{
    public function show($request, $id);
    public function getUserStats($request);
    public function listAllPaginated($params);

}
