<?php

namespace App\Http\Controllers\Admin;

use App\Enums\BaseStatusEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CategoryService as CategoryService;
use App\Repositories\Interfaces\CategoryRepositoryInterface as CategoryRepository;
use Illuminate\Validation\Rule;
use App\Models\Category;

class CategoryController extends Controller
{
    protected $categoryService;
    protected $categoryRepository;

    public function __construct(CategoryService $categoryService, CategoryRepository $categoryRepository)
    {
        $this->categoryService = $categoryService;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = $this->categoryService->index();

        return view('backend.admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'max:255', Rule::unique(Category::class)],
            'slug' => ['required', 'max:255', Rule::unique(Category::class)],
            'description' => ['max:255'],
            'status' => ['required', Rule::enum(BaseStatusEnum::class)]
        ]);

        $this->categoryRepository->create($validated);

        if ($request->submitter == 'apply') {
            return redirect()->back()->with('success', 'Tạo danh mục thành công!');
        } else {
            return redirect()->route('admin.categories.index')->with('success', 'Tạo danh mục thành công!');
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
        $category = $this->categoryRepository->find($id);

        return view('backend.admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'max:255', Rule::unique(Category::class)->ignore($id)],
            'slug' => ['required', 'max:255', Rule::unique(Category::class)->ignore($id)],
            'description' => ['max:255'],
        ]);
        $validated = $request->validate([
            'name' => ['required', 'max:255', Rule::unique(Category::class)->ignore($id)],
            'slug' => ['required', 'max:255', Rule::unique(Category::class)->ignore($id)],
            'description' => ['max:255'],
            'status' => ['required', Rule::enum(BaseStatusEnum::class)]
        ]);

        $this->categoryRepository->update($id, $validated);

        if ($request->submitter == 'apply') {
            return redirect()->back()->with('success', 'Cập nhật danh mục thành công!');
        } else {
            return redirect()->route('admin.categories.index')->with('success', 'Cập nhật danh mục thành công!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->categoryRepository->delete($id);

        return redirect()->route('admin.categories.index')->with('success', 'Xóa thành công');
    }
}
