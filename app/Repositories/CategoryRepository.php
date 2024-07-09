<?php
namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getAllCategories()
    {
        return Category::all();
    }

    public function CategoryProduct($category)
    {
        return Category::with('products')->where('id', $category->id)->get();
    }

}
