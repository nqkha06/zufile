<?php

namespace App\Http\Controllers\Admin;

use App\Enums\BaseStatusEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CategoryService as CategoryService;
use App\Repositories\Interfaces\TagRepositoryInterface as TagRepository;
use Illuminate\Validation\Rule;
use App\Models\Tag;

class TagController extends Controller
{
    protected $categoryService;
    protected $tagRepository;

    public function __construct(CategoryService $categoryService, TagRepository $tagRepository)
    {
        $this->categoryService = $categoryService;
        $this->tagRepository = $tagRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::paginate();

        return view('backend.admin.tag.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'max:120', Rule::unique(Tag::class)],
            'slug' => ['required', 'max:255', Rule::unique(Tag::class)],
            'description' => ['max:400'],
            'status' => ['required', Rule::enum(BaseStatusEnum::class)]
        ]);

        $this->tagRepository->create($validated);

        if ($request->submitter == 'apply') {
            return redirect()->back()->with('success', 'Tạo thẻ thành công!');
        } else {
            return redirect()->route('admin.categories.index')->with('success', 'Tạo thẻ thành công!');
        }
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
    public function edit(string $id)
    {
        $category = $this->tagRepository->find($id);

        return view('backend.admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'max:255', Rule::unique(Tag::class)->ignore($id)],
            'slug' => ['required', 'max:255', Rule::unique(Tag::class)->ignore($id)],
            'description' => ['max:255'],
        ]);
        $validated = $request->validate([
            'name' => ['required', 'max:255', Rule::unique(Tag::class)->ignore($id)],
            'slug' => ['required', 'max:255', Rule::unique(Tag::class)->ignore($id)],
            'description' => ['max:255'],
            'status' => ['required', Rule::enum(BaseStatusEnum::class)]
        ]);

        $this->tagRepository->update($id, $validated);

        if ($request->submitter == 'apply') {
            return redirect()->back()->with('success', 'Cập nhật thẻ thành công!');
        } else {
            return redirect()->route('admin.categories.index')->with('success', 'Cập nhật thẻ thành công!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->tagRepository->delete($id);

        return redirect()->route('admin.categories.index')->with('success', 'Xóa thành công');
    }
}
