<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\PostRepositoryInterface as PostRepository;
use App\Services\Interfaces\BlogServiceInterface as BlogService;
use App\Repositories\Interfaces\CategoryRepositoryInterface as CategoryRepository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;

class PostController extends Controller
{
    protected $blogService;
    protected $postRepository;
    protected $categoryRepository;

    public function __construct(BlogService $blogService, PostRepository $postRepository, CategoryRepository $categoryRepository)
    {
        $this->blogService = $blogService;
        $this->postRepository = $postRepository;
        $this->categoryRepository = $categoryRepository;
    }
    public function show($slug) {
        $cookieData = Cookie::get('_note');
        $stuCookie = Cookie::get('_stu');
        $stuAxajCookie = Cookie::get('_stuAxaj');

        if ($cookieData) {
            $data = json_decode($cookieData);

            return view('fontend.note.show', compact('data'));
        }

        if ($stuCookie && !$stuAxajCookie) {
            return view('layouts.stu');
        }

        $article_data = $this->postRepository->with(['categories'])->getPublishedPost($slug);

        $related_articles = $this->postRepository->with(['categories'])->getAllPaginated();

        return view('fontend.blog.post', compact('article_data', 'related_articles'));
    }
}
