<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use App\Services\Interfaces\CategoryServiceInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

/**
 * Class CategoryService
 * @package App\Services
 */
class CategoryService implements CategoryServiceInterface
{   
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        return $this->categoryRepository->getPaginate(10);
    }
}
