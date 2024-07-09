<?php

namespace App\Repositories\Interfaces;

interface CategoryRepositoryInterface
{
     public function getAllCategories();

     public function CategoryProduct($category);
}
