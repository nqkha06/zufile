<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\PostRepositoryInterface;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

/**
 * Class PostRepository.
 */
class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    protected $model;

    public function __construct(Post $model)
    {
        $this->model = $model;
    }

    public function getPostsCache(int $take = null, int $paginate = null)
    {
        $cacheKey = "posts_{$take}_{$paginate}";

        return Cache::remember($cacheKey, 60, function () use ($take, $paginate) {
            $query = $this->model->with('category', 'views')->where('status', 'public');

            if ($take != null) {
                $query = $query->latest()->take($take);
            }

            if ($paginate != null) {
                return $query->latest()->paginate($paginate);
            } else {
                return $query->latest()->get();
            }
        });
    }

    public function getPosts(int $take = null, int $paginate = null)
        {
            $query = $this->model->with('category', 'views')->where('status', 'public');

            if ($take != null) {
                $query = $query->latest()->take($take);
            }

            if ($paginate != null) {
                return $query->latest()->paginate($paginate);
            } else {
                return $query->latest()->get();
            }
        }
    public function getPaginate($paginate = 10)
    {
        $cacheKey = "posts_paginate_{$paginate}";

        return Cache::remember($cacheKey, 60, function () use ($paginate) {
            $query = $this->model->where('status', 'public');

            if (isset($paginate) && !empty($paginate)) {
                return $query->paginate($paginate);
            } else {
                return $query->get();
            }
        });
    }

    public function getPost($slug)
    {
        $cacheKey = "post_slug_{$slug}";

        return Cache::remember($cacheKey, 60, function () use ($slug) {
            return $this->model->with('category')->where('slug', $slug)->firstOrFail();
        });
    }

    public function getPostById($id)
    {
        $cacheKey = "post_id_{$id}";

        return Cache::remember($cacheKey, 60, function () use ($id) {
            return $this->model->findOrFail($id);
        });
    }

    public function getPopularPosts(int $take = 5)
    {
        $cacheKey = "popular_posts_{$take}";
    
        return Cache::remember($cacheKey, 60, function () use ($take) {
            $query = $this->model
                ->select('posts.*')
                ->with('category')
                ->leftJoin('post_views', 'posts.id', '=', 'post_views.post_id')
                ->selectRaw('COALESCE(SUM(post_views.views), 0) as views')
                ->where('posts.status', 'public')
                ->groupBy('posts.id')
                ->orderBy('views', 'DESC')
                ->take($take);
            return $query->get();
        });
    }
    
    public function getPostsInRange(string $start, string $end)
    {
        $cacheKey = "posts_range_{$start}_{$end}";

        return Cache::remember($cacheKey, 60, function () use ($start, $end) {
            return $this->model->skip($start)->take($end)->latest()->get();
        });
    }

    public function getPublishedPost($slug)
    {
        return $this->model->with('category')->where('slug', $slug)->where('status', 'public')->firstOrFail();
    }

    // public function getPaginatedPosts() {

    // }
}
