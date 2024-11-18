<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\PostRepositoryInterface as PostRepository;

class BlogController extends Controller
{
    public $postRepository;

    public function __construct(PostRepository $postRepository = null) {
        $this->postRepository = $postRepository;
    }

    public function loadAjax(Request $request) {
        $start = $request->query('start') ?? 0;
        $end = $request->query('end') ?? 0;
    
        $posts = $this->postRepository->getPostsInRange($start, $end);
    
        if (count($posts) > 0) {
            $viewData = [];
            foreach ($posts as $post) {
                $viewData[] = view('fontend.blog.components.article', ['article' => $post])->render();
            }
    
            return response()->json(['html' => implode('', $viewData)]);
        }
    
        return response()->json(['html' => '']);
    }
    
}
