<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Http\Resources\ProductResource;
use App\Models\DeliveryMethod;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Product;
use App\Models\Stock;
use App\Models\UserAddress;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public $orderRepository;
    public $orderService;

    public function __construct(OrderRepositoryInterface $orderRepository, OrderService $orderService)
    {
        $this->orderRepository = $orderRepository;
        $this->orderService = $orderService;
        $this->middleware('auth:sanctum');
    }

    public function index(Request $request)
    {
        if ($request->has('status_id')) {
            return $this->response($this->orderRepository->changeStatusOrder($request));
        }
        return $this->response($this->orderRepository->getAllOrders());
    }

    public function store(StoreOrderRequest $request)
    {
        $sum = 0;
        $products = [];
        $notFoundProducts = [];
        $address = UserAddress::where('user_id', $request->address_id)->firstOrFail();
        $deliveryMethod = DeliveryMethod::findorFail($request->delivery_method_id);

        foreach ($request['products'] as $requestproduct) {
            $product = Product::with('stocks')->findOrFail($requestproduct['product_id']);
            $product->quantity = $requestproduct['quantity'];

            if (
                $product->stocks()->find($requestproduct['stock_id']) &&
                $product->stocks()->find($requestproduct['stock_id'])->quantity >= $requestproduct['quantity']
            ) {
                $productWithStock = $product->withStocks($requestproduct['stock_id']);
                $productResource = new ProductResource($productWithStock);
                $sum += $productResource['price'] * $requestproduct['quantity'];

                $products[] = $productResource->resolve();
            } else {
                $requestproduct['we_have'] = $product->stocks()->find($requestproduct['stock_id'])->quantity;
                $notFoundProducts[] = $requestproduct;
            }
        }

        if ($notFoundProducts === [] && $products !== null && $sum !== 0) {
            $order = $this->orderService->saveOrder($deliveryMethod, $request, $sum, $address, $products);
            return $this->success('Order created successfully', [$order]);

        }

        return $this->error('Order not created', ['products' => $notFoundProducts]);
    }

    public function show(Order $order)
    {
        return $this->response(new OrderResource($order));
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    public function destroy(Order $order)
    {
        //
    }
}
