<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    public function getProducts()
    {
       return Product::cursorPaginate(25);
    }

    public function getProductId($product)
    {
        return Product::where('id', $product->id)->first();
    }
}
