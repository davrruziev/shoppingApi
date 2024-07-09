<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductReviewRequest;
use App\Http\Resources\ReviewResource;
use App\Models\Product;
use App\Services\ProductReviewService;
use Illuminate\Http\Request;

class ProductReviewController extends Controller
{
    public $productReviewService;

    public function __construct(ProductReviewService $productReviewService)
    {
        $this->productReviewService = $productReviewService;
        $this->middleware('auth:sanctum');
    }

    public function index(Product $product)
    {
        return $this->response([
            'overall_rating' => round($product->reviews()->avg('rating'), 1),
            "reviews_count" => $product->reviews()->count(),
            "reviews" => ReviewResource::collection($product->reviews()->paginate(10))
        ]);
    }

    public function store(Product $product, ProductReviewRequest $request)
    {
        $review = $this->productReviewService->store($product, $request);
        return $this->success('Review created success', $review);
    }
}
