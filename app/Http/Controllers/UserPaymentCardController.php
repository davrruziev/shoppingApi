<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserPaymentCardResource;
use App\Models\UserPaymentCard;
use App\Http\Requests\StoreUserPaymentCardRequest;
use App\Http\Requests\UpdateUserPaymentCardRequest;
use Illuminate\Support\Facades\Crypt;

class UserPaymentCardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }
    public function index()
    {
        return $this->response(UserPaymentCardResource::collection(auth()->user()->paymentCards));
    }

    public function store(StoreUserPaymentCardRequest $request)
    {
        $card = auth()->user()->paymentCards()->create([
            "name" => encrypt($request->name),
            "number" => encrypt($request->number),
            "exp_date" => encrypt($request->exp_date),
            "holder_name" => encrypt($request->holder_name),
            "last_four_numbers" => encrypt(substr($request->number, -4)),
            "payment_card_type_id" => $request->payment_card_type_id,
        ]);

        return $this->success('Payment card created', ['card' => $card]);
    }

    public function show(UserPaymentCard $userPaymentCard)
    {
        //
    }

    public function update(UpdateUserPaymentCardRequest $request, UserPaymentCard $userPaymentCard)
    {
        //
    }

    public function destroy(UserPaymentCard $userPaymentCard)
    {
        //
    }
}
