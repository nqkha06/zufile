<?php

namespace App\Services;

use App\Services\Interfaces\PostServiceInterface;
use App\Repositories\Interfaces\PostRepositoryInterface as PostRepository;

/**
 * Class PostService
 * @package App\Services
 */
class PostService implements PostServiceInterface
{
    protected $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }
    public function listAllPaginated($filterParams)
    {
        $search = [];
        if (!empty($filterParams['keyword'])) {
            $keyword = '%'.$filterParams['keyword'].'%';

            $search[] = ['title', 'like', $keyword];
            $search[] = ['slug', 'ORlike', $keyword];
            $search[] = ['content', 'ORlike', $keyword];
            $search[] = ['summary', 'ORlike', $keyword];
            $search[] = ['meta_title', 'ORlike', $keyword];
            $search[] = ['meta_description', 'ORlike', $keyword];
            $search[] = ['meta_keywords', 'ORlike', $keyword];
            $search[] = ['tags', 'ORlike', $keyword];
        }

        if (!empty($filterParams['status'])) {
            $status = $filterParams['status'];
            $search[] = ['status', '=', $status];
        }

        return $this->postRepository->getAllPaginated($search);
    }

    public function edit(int $id)
    {
        return $this->postRepository->getPostById($id)->toArray();
    }

    public function getPopularPosts($take = 5) {
        return $this->postRepository->getPopularPosts($take);
    }

    public function getAllPostLinks() {
        $links = [];

        $data = $this->postRepository->getAllPublished();
        
        foreach ($data as $slug) {
            $links[] = route('blog.article', ['slug' => $slug]);
        }

        return $links;
    }
}
