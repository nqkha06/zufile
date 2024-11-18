<?php

namespace App\Repositories\Interfaces;
use App\Repositories\Interfaces\BaseRepositoryInterface;

/**
 * Interface PostRepositoryInterface
 * @package App\Repositories\Interfaces
 */
interface PostRepositoryInterface extends BaseRepositoryInterface
{
    public function getPosts(int $take = null, int $paginate = null);
    public function getPost($slug);
    public function getPostById($id);
    public function getPaginate($paginate = 10);
    public function getPopularPosts(int $take = 5);
    public function getPostsInRange(string $start, string $end);
    public function getPostsCache(int $take = null, int $paginate = null);
    public function getPublishedPost($slug);
}
