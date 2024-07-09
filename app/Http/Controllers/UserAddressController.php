<?php

namespace App\Http\Controllers;

use App\Models\UserAddress;
use App\Http\Requests\StoreUserAddressRequest;
use App\Http\Requests\UpdateUserAddressRequest;
use App\Services\UserAddressService;
use Illuminate\Database\Eloquent\Collection;

class UserAddressController extends Controller
{
    public $userAddressService;
    public function __construct(UserAddressService $userAddressService)
    {
        $this->userAddressService = $userAddressService;
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        return $this->response(auth()->user()->addresses);
    }

    public function store(StoreUserAddressRequest $request)
    {

       $address = $this->userAddressService->store($request);

        return $this->success('Address added successfully', $address);
    }

    public function show(UserAddress $userAddress)
    {
        //
    }

    public function update(UpdateUserAddressRequest $request, UserAddress $userAddress)
    {
        //
    }

    public function destroy(UserAddress $userAddress)
    {
        //
    }
}
