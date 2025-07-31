<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\PostRepositoryInterface as PostRepository;
use App\Services\BlogService as BlogService;
use App\Repositories\Interfaces\CategoryRepositoryInterface as CategoryRepository;

class BlogController extends Controller
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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $_data = $this->blogService->index();

        $pinned = $_data['pinned'];
        $posts = $_data['posts'];
        $labels = $this->categoryRepository->all(['posts']);

        return view('fontend.blog.index', compact('pinned', 'posts', 'labels'));
    }

    public function showCategory($slug) {
        $category = $this->categoryRepository->with(['publishedPosts'])->findFirst(['slug', $slug]);

        return view('fontend.blog.category', [
            'category' => $category,
            'hideSidebar' => true,
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
   //
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
