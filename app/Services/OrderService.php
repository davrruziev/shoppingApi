<?php
namespace App\Services;

use App\Http\Requests\StoreOrderRequest;
use App\Repositories\OrderRepository;

class OrderService
{

    private $orderRepository;

    public function __construct()
    {
        $this->orderRepository = new OrderRepository();
    }

    public function saveOrder($deliveryMethod, StoreOrderRequest $request, $sum, $address, $products)
    {
        $sum += $deliveryMethod->sum;

        $order = $this->orderRepository->orderStore($request, $sum, $address, $products);

        if ($order) {
            $this->orderRepository->StocksOrders($products);
        }

        return $order;
    }
}
