<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductController extends Controller
{
    public $productRepository;

    public function __construct
    (
        ProductRepositoryInterface $productRepository
    )
    {
        $this->productRepository = $productRepository;

    }

    public function index()
    {
        return ProductResource::collection($this->productRepository->getProducts());
    }

    public function store(StoreProductRequest $request)
    {
        //
    }

    public function show(Product $product)
    {
        return  new ProductResource($this->productRepository->getProductId($product));

    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    public function destroy(Product $product)
    {
        //
    }
}
