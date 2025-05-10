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


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        
       
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
