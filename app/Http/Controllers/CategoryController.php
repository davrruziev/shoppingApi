<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    public $categoryRepository;

    public $categoryService;

    public function __construct
    (
        CategoryRepositoryInterface $categoryRepository,
        CategoryService             $categoryService
    )
    {
        $this->categoryRepository = $categoryRepository;
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        return $this->categoryRepository->getAllCategories();
    }

    public function store(StoreCategoryRequest $request)
    {
        $category = $this->categoryService->store($request);
        return $this->success('Category created', $category);

    }

    public function show(Category $category)
    {
        return $this->response(new CategoryResource($category));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {

    }

    public function destroy(Category $category)
    {
        $category->delete();
        return $this->success('category deleted', $category);
    }
}
