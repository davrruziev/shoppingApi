<?php
namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public function store($request,)
    {
        $category = new Category();
        $category->create([
            'name' => $request->name,
            'order' => $request->order ?? null,
            'icon' => $request->icon ?? null,
        ]);

        return $category;
    }
}
