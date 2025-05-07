<?php

namespace App\Providers;

use Auth;
use App\Services\AuthService;
use App\Services\BookService;
use App\Services\CategoryService;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\Services\AuthServiceInterface;
use App\Interfaces\Services\BookServiceIntarface;
use App\Interfaces\Services\CategoryServiceInterface;

class ControllerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        $this->app->bind(BookServiceIntarface::class, BookService::class);
        $this->app->bind(CategoryServiceInterface::class, CategoryService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
