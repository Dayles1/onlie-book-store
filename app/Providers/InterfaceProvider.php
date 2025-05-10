<?php

namespace App\Providers;

use App\Services\AuthService;
use App\Services\BookService;
use App\Services\UserService;
use App\Services\CategoryService;
use App\Services\LanguageService;
use App\Services\TranslationService;
use App\Services\ExchangeRateService;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\Services\AuthServiceInterface;
use App\Interfaces\Services\BookServiceInterface;
use App\Interfaces\Services\UserServiceInterface;
use App\Interfaces\Services\CategoryServiceInterface;
use App\Interfaces\Services\LanguageServiceInterface;
use App\Interfaces\Services\TranslationServiceInterface;
use App\Interfaces\Services\ExchangeRateServiceInterface;

class InterfaceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
         $this->app->bind(AuthServiceInterface::class, AuthService::class);
        $this->app->bind(BookServiceInterface::class, BookService::class);
        $this->app->bind(CategoryServiceInterface::class, CategoryService::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(ExchangeRateServiceInterface::class, ExchangeRateService::class);
        $this->app->bind(LanguageServiceInterface::class, LanguageService::class);
        $this->app->bind(TranslationServiceInterface::class, TranslationService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
