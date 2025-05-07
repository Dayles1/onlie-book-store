<?php

namespace App\Providers;

use App\Interfaces\Interfaces\BookServiceIntarface;
use App\Interfaces\Interfaces\Services\AuthServiceInterface;
use App\Services\AuthService;
use App\Services\BookService;
use Auth;
use Illuminate\Support\ServiceProvider;

class ControllerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        $this->app->bind(BookServiceIntarface::class, BookService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
