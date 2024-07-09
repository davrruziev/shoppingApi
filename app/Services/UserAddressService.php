<?php
namespace App\Services;

class UserAddressService
{

    public function store($request)
    {
        return auth()->user()->addresses()->create($request->all());
    }
}
