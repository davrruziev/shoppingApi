<?php

namespace App\Http\Controllers;

use App\Models\Value;
use App\Http\Requests\StoreValueRequest;
use App\Http\Requests\UpdateValueRequest;

class ValueController extends Controller
{
    public function index()
    {
        //
    }

    public function store(StoreValueRequest $request)
    {
        //
    }

    public function show(Value $value)
    {
        //
    }

    public function update(UpdateValueRequest $request, Value $value)
    {
        //
    }

    public function destroy(Value $value)
    {
        //
    }
}
