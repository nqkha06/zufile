<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PostService as PostService;
use App\Repositories\Interfaces\PostRepositoryInterface as PostRepository;
use App\Repositories\Interfaces\CategoryRepositoryInterface as CategoryRepository;
use App\Repositories\Interfaces\TagRepositoryInterface as TagRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Enums\BaseStatusEnum;
use App\Models\Tag;

class PostController extends Controller
{
    protected $postService;
    protected $postRepository;
    protected $categoryRepository;
    protected $tagRepository;

    public function __construct(PostService $postService, PostRepository $postRepository, CategoryRepository $categoryRepository, TagRepository $tagRepository)
    {
        $this->postService = $postService;
        $this->postRepository = $postRepository;
        $this->postRepository = $postRepository;
        $this->categoryRepository = $categoryRepository;
        $this->tagRepository = $tagRepository;
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
        $categories = $this->categoryRepository->all();

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
            'status' => ['required', Rule::enum(BaseStatusEnum::class)],
            'categories' => ['required', 'array'],
            'categories.*' => ['integer', 'exists:categories,id'],
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
            'summary' => $request->description,
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
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $post = $this->postRepository->with(['categories', 'tags'])->find($id);
        $categories = $this->categoryRepository->findMany(['status' => BaseStatusEnum::PUBLISHED]);
        $tags = $this->tagRepository->findMany(['status' => BaseStatusEnum::PUBLISHED]);

        return view('backend.admin.post.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => ['required', Rule::enum(BaseStatusEnum::class)],
            'categories' => ['array'],
            'categories.*' => ['integer', 'exists:categories,id'],
            'tags' => ['array'],
            'tags.*' => ['integer', 'exists:tags,id'],
        ]);
        // Handle the file upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);

            $path = '/images/' . $imageName;
        }
        $seo_meta = $request->seo_meta;

        $dataUpd = [
            'title' => $request->title,
            'slug' => $request->slug,
            'description' => $request->description,
            'content' => $request->content,
            'meta_title' => $seo_meta['seo_title'] ?? '',
            'meta_description' => $seo_meta['seo_description'] ?? '',
            'meta_keywords' => $request->meta_keywords,
            'status' => $request->status
        ];
        if (isset($path)) {
            $dataUpd['image'] = $path;
        }

        $post = $this->postRepository->findFirst(['id' => $id]);
        $this->postRepository->update($id, $dataUpd);
        $post->categories()->sync($request->categories);
        $post->tags()->sync($request->tags);

        if ($request->submitter == 'apply') {
            return redirect()->back()->with('success', 'Bài viết đã được cập nhật thành công.');

        } else {
            return redirect()->route('admin.posts.index')->with('success', 'Bài viết đã được cập nhật thành công.');
        }
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
