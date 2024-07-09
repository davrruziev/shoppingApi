<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryProductController extends Controller
{
    public $categoryRepository;

    public function __construct
    (
        CategoryRepositoryInterface $categoryRepository
    )
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index(Category $category)
    {
        return $this->categoryRepository->CategoryProduct($category);
    }
}
