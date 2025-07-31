<?php

namespace App\Services;

use App\Repositories\Interfaces\PostRepositoryInterface as PostRepository;
use App\Repositories\Interfaces\PostViewRepositoryInterface as PostViewRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * Class BlogService
 * @package App\Services
 */
class BlogService
{
    protected $postRepository;
    protected $postViewRepository;

    public function __construct(PostRepository $postRepository, PostViewRepository $postViewRepository)
    {
        $this->postRepository = $postRepository;
        $this->postViewRepository = $postViewRepository;
    }

    public function index()
    {
        $posts = $this->postRepository->getPosts(6);
        $popular_posts = $this->postRepository->getPopularPosts();

        return [
            'posts' => $posts,
            'pinned' => $posts[0],
            'popular_posts' => $popular_posts
        ];
    }
    public function show($slug)
    {
        $article = $this->postRepository->findByCondition([['slug', '=', $slug]]);
        if (empty($article)) {
            return abort(404);
        }

        $related_articles = $this->postRepository->getByCondition([['category_id', '=', $article->category_id]]);
        $this->increasePostViews($article->id);

        return [
            'related_articles' => $related_articles,
            'article_data' => $article
        ];
    }

    private function increasePostViews(string $post_id)
    {
        try {
            $this->postViewRepository->updateOrInsert([
                'post_id' => $post_id,
                'date' => Carbon::today()->toDateString()
            ], [
                'views' => DB::raw('COALESCE(views, 0) + 1')
            ]);
        } catch (\Throwable $th) {
            echo "LỖI DỮ LIỆU";
            dd();
        }
    }
}
