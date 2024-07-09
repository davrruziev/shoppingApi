<?php

namespace App\Repositories;

use App\Repositories\Interfaces\FavoriteRepositoryInterface;

class FavoriteRepository implements FavoriteRepositoryInterface
{
    public function index()
    {
        return auth()->user()->favorites()->paginate(10);
    }

    public function destroy($favoriteId)
    {
        if (auth()->user()->favorites()->where('product_id', $favoriteId)->exists()) {
            auth()->user()->favorites()->detach($favoriteId);
            return true;
        }
        return false;
    }
}
