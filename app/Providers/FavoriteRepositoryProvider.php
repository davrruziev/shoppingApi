<?php

namespace App\Providers;

use App\Repositories\FavoriteRepository;
use App\Repositories\Interfaces\FavoriteRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class FavoriteRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(FavoriteRepositoryInterface::class, FavoriteRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
