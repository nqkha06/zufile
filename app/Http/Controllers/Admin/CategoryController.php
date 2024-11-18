<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\CategoryServiceInterface as CategoryService;
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
        $request->validate([
            'name' => ['required', 'max:255', Rule::unique(Category::class)],
            'description' => ['max:255', Rule::unique(Category::class)],
            'slug' => ['required', 'max:255', Rule::unique(Category::class)],
        ]);

        $this->categoryRepository->create([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.category.index')->with('success', 'Cập nhật/thêm vai trò thành công.');
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
        $category = $this->categoryRepository->findById($id);

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

        $this->categoryRepository->update($id, [
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Cập nhật thành công');
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
