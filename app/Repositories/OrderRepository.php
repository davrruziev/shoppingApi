<?php

namespace App\Repositories;

use App\Http\Resources\OrderResource;
use App\Repositories\Interfaces\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{
    public function getAllOrders()
    {
        return OrderResource::collection(auth()->user()->orders);
    }

    public function changeStatusOrder($request)
    {
        if ($request->has('status_id')){
            return OrderResource::collection(auth()->user()->orders()->where('status_id', $request['status_id'])->get());
        }
    }

    public function orderStore($request, $sum, $address, $products)
    {
      return auth()->user()->orders()->create([
            'comment' => $request->comment,
            'delivery_method_id' => $request->delivery_method_id,
            'payment_type_id' => $request->payment_type_id,
            'status_id' => in_array($request['payment_type_id'], [1, 2]) ? 1 : 10,
            'sum' => $sum,
            'address' => $address,
            'products' => $products
            ]);

    }

    public function StocksOrders($products)
    {
        // TODO: Implement StocksOrders() method.
    }

}
