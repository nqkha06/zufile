<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\PostServiceInterface as PostService;
use App\Repositories\Interfaces\PostRepositoryInterface as PostRepository;
use App\Repositories\Interfaces\CategoryRepositoryInterface as CategoryRepository;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{   
    protected $postService;
    protected $postRepository;
    protected $categoryRepository;

    public function __construct(PostService $postService, PostRepository $postRepository, CategoryRepository $categoryRepository)
    {
        $this->postService = $postService;
        $this->postRepository = $postRepository;
        $this->postRepository = $postRepository;
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filterParams = $request->only('keyword', 'status');
        $posts = $this->postService->listAllpaginated($filterParams);

        return view('backend.admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->categoryRepository->all([]);

        return view('backend.admin.post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'  => 'required',
            'slug'  => 'required',
            'content'  => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        // Handle the file upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);

            $path = '/images/' . $imageName;
        }
        $dataUpd = [
            'user_id' => $request->user()->id,
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => $request->content,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'category_id' => $request->category,
            'summary' => $request->description,
            'tags' => $request->tags,
            'image' => $path ?? null,
            'status' => $request->status
        ];
        
        $dataUpd = array_filter($dataUpd, function($value) {
            return !is_null($value);
        });

        $this->postRepository->create($dataUpd);
        
        return redirect()->route('admin.posts.index')->with('success', 'Thêm mới bài viết thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $post = $this->postRepository->with(['category'])->find($id);
        $categories = $this->categoryRepository->all([]);

        return view('backend.admin.post.edit', compact('post', 'categories'));
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle the file upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);

            $path = '/images/' . $imageName;
        }
        $dataUpd = [
            'title' => $request->title,
            'slug' => $request->slug,
            'summary' => $request->description,
            'content' => $request->content,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'category_id' => $request->category,
            'tags' => $request->tags,
            'status' => $request->status
        ];
        if (isset($path)) {
            $dataUpd['image'] = $path;
        }

        $this->postRepository->update($id, $dataUpd);
        
        return redirect()->route('admin.posts.index')->with('success', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try{
            $this->postRepository->delete($id);
            DB::commit();
            return redirect()->route('admin.posts.index')->with('success', 'Vài viết đã được xoá thành công!');
        }catch(\Exception $e ){
            DB::rollBack();
            echo $e->getMessage();die();
        }
        return redirect()->route('admin.posts.index')->withErrors('Xoá Bài viết không thành công!');
    }
}
