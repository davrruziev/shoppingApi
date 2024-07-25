<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public $productRepository;

    public function __construct
    (
        ProductRepositoryInterface $productRepository
    )
    {
        $this->productRepository = $productRepository;
        $this->middleware('auth:sanctum');

    }

    public function index()
    {
        return ProductResource::collection($this->productRepository->getProducts());
    }

    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->toArray());

        return $this->success('product created', new ProductResource($product));
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
        Gate::authorize('product:delete');

        Storage::delete($product->photos()->pluck('path')->toArray());
        $product->photos()->delete();
        $product->delete();

        return $this->success('product deleted');
    }

    public function related(Product $product)
    {
        return $this->response(ProductResource::collection(Product::query()->where('category_id', $product->category_id)->limit(20)->get()));
    }
}
