<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangeStatusOrderRequest;
use App\Http\Requests\StoreStatusRequest;
use App\Models\Order;
use App\Models\Status;
use Illuminate\Http\Request;
use League\CommonMark\Node\Query\OrExpr;

class ChangeStatusOrderController extends Controller
{
    public function store(ChangeStatusOrderRequest $request,Status $status)
    {
           $order = Order::findOrFail($request['order_id']);

           $order->update(['status_id' => $status->id]);

           return $this->success('status changed');
    }
}
