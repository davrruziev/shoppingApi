<?php

namespace App\Repositories\Interfaces;

interface FavoriteRepositoryInterface
{
    public function index();

    public function destroy($favoriteId);
}
