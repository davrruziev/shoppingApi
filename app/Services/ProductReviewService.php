<?php
namespace App\Services;

class ProductReviewService
{
    public function store($product, $request)
    {
        $product->reviews()->create([
            'user_id' => auth()->user()->id,
            "rating" => $request->rating,
            "body" => $request->body,
        ]);

        return $product;
    }
}
