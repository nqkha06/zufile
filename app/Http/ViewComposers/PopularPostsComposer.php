<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Services\PostService as PostService;

class PopularPostsComposer
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function compose(View $view)
    {
        $popular_posts = $this->postService->getPopularPosts();
        $view->with('popular_posts', $popular_posts);
    }
}
