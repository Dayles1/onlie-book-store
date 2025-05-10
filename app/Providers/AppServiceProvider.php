<?php

namespace App\Providers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Language;
use App\Models\Translation;
use App\Services\AuthService;
use App\Services\BookService;
use App\Services\UserService;
use App\Observers\BookObserver;
use App\Services\CategoryService;
use App\Services\LanguageService;
use App\Observers\CategoryObserver;
use App\Observers\LanguageObserver;
use App\Services\ExchangeRateService;
use App\Observers\TranslationObserver;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\Services\AuthServiceInterface;
use App\Interfaces\Services\BookServiceInterface;
use App\Interfaces\Services\UserServiceInterface;
use App\Interfaces\Services\CategoryServiceInterface;
use App\Interfaces\Services\LanguageServiceInterface;
use App\Interfaces\Services\ExchangeRateServiceInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        
        // $this->app->bind(AuthServiceInterface::class, AuthService::class);
        // $this->app->bind(BookServiceInterface::class, BookService::class);
        // $this->app->bind(CategoryServiceInterface::class, CategoryService::class);
        // $this->app->bind(UserServiceInterface::class, UserService::class);
        // $this->app->bind(ExchangeRateServiceInterface::class, ExchangeRateService::class);
        // $this->app->bind(LanguageServiceInterface::class, LanguageService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Book::observe(BookObserver::class);
        Category::observe(CategoryObserver::class);
        Translation::observe(TranslationObserver::class);
        Language::observe(LanguageObserver::class);
    }
}
