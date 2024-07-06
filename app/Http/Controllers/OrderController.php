<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Http\Resources\ProductResource;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Product;
use App\Models\Stock;
use App\Models\UserAddress;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        return auth()->user()->orders()->paginate(5);
    }

    public function store(StoreOrderRequest $request)
    {
//        dd($request->all());

        $sum = 0;
        $products = [];
        $notFoundProducts = [];
        $address = UserAddress::where('user_id', $request->address_id)->firstOrFail();


        foreach ($request['products'] as $requestproduct) {
            $product = Product::with('stocks')->findOrFail($requestproduct['product_id']);
            $product->quantity = $requestproduct['quantity'];

            if (
                $product->stocks()->find($requestproduct['stock_id']) && $product->stocks()->find($requestproduct['stock_id'])->quantity >= $requestproduct['quantity']
            ) {
                $productWithStock = $product->withStocks($requestproduct['stock_id']);
                $productResource = new ProductResource($productWithStock);
                $sum += $productResource['price'] * $requestproduct['quantity'];

                $products[] = $productResource->resolve();
            }
            else {
                $requestproduct['we_have'] = $product->stocks()->find($requestproduct['stock_id'])->quantity;
                $notFoundProducts[] = $requestproduct;
            }
        }

        if ($notFoundProducts === [] && $products !== null && $sum !== 0) {
            $order = auth()->user()->orders()->create([
                'comment' => $request->comment,
                'delivery_method_id' => $request->delivery_method_id,
                'payment_type_id' => $request->payment_type_id,
                'status_id' => in_array($request['payment_type_id'], [1,2]) ? 1 : 10,
                'sum' => $sum,
                'address' => $address,
                'products' => $products,
            ]);

            if ($order) {
                foreach ($products as $product) {
                    $stock = Stock::find($product['stocks'][0]['id']);
                    $stock->quantity = $stock->quantity - $product['order_quantity'];
                    $stock->save();
                }
            }
            return response()->json([
                'message' => 'Order created successfully'
            ]);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Order not created',
                'products' => $notFoundProducts,
            ]);
        }



    }

    public function show(Order $order)
    {
        return new OrderResource($order);
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
