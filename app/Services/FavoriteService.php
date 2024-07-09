<?php
namespace App\Services;

class FavoriteService
{
    public function store($request)
    {
        return auth()->user()->favorites()->attach($request->product_id);
    }
}
