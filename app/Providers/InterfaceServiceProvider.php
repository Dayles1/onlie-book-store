<?php

namespace App\Providers;

use Auth;
use App\Services\AuthService;
use App\Services\BookService;
use App\Services\UserService;
use App\Services\CategoryService;
use App\Services\LanguageService;
use App\Services\ExchangeRateService;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\Services\AuthServiceInterface;
use App\Interfaces\Services\BookServiceIntarface;
use App\Interfaces\Services\UserServiceInterface;
use App\Interfaces\Services\CategoryServiceInterface;
use App\Interfaces\Services\LanguageServiceInterface;
use App\Interfaces\Services\ExchangeRateServiceInterface;

class InterfaceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        $this->app->bind(BookServiceIntarface::class, BookService::class);
        $this->app->bind(CategoryServiceInterface::class, CategoryService::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(ExchangeRateServiceInterface::class, ExchangeRateService::class);
        $this->app->bind(LanguageServiceInterface::class, LanguageService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
