<?php

namespace App\Services\Interfaces;

/**
 * Interface PostServiceInterface
 * @package App\Services\Interfaces
 */
interface PostServiceInterface
{
    public function edit(int $id);
    public function getPopularPosts($take = 5);
    public function listAllPaginated($filterParams);
    public function getAllPostLinks();
}
