<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\Interfaces\CategoryRepositoryInterface as CategoryRepository;

class CategoriesComposer
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function compose(View $view)
    {
        $categories = $this->categoryRepository->all();
        $view->with('categories', $categories);
    }
}
