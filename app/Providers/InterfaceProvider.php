<?php

namespace App\Providers;

use App\Services\AuthService;
use App\Services\BookService;
use App\Services\LikeService;
use App\Services\UserService;
use App\Services\OrderService;
use App\Services\CategoryService;
use App\Services\LanguageService;
use App\Repositories\AuthRepository;
use App\Repositories\BookRepository;
use App\Repositories\LikeRepository;
use App\Repositories\UserRepository;
use App\Services\TranslationService;
use App\Repositories\OrderRepository;
use App\Services\ExchangeRateService;
use App\Services\NotificationService;
use Illuminate\Support\ServiceProvider;
use App\Repositories\CategoryRepository;
use App\Repositories\LanguageRepository;
use App\Repositories\TranslationRepository;
use App\Repositories\ExchangeRateRepository;
use App\Repositories\NotificationRepository;
use App\Interfaces\Services\AuthServiceInterface;
use App\Interfaces\Services\BookServiceInterface;
use App\Interfaces\Services\LikeServiceInterface;
use App\Interfaces\Services\UserServiceInterface;
use App\Interfaces\Services\OrderServiceInterface;
use App\Interfaces\Services\CategoryServiceInterface;
use App\Interfaces\Services\LanguageServiceInterface;
use App\Interfaces\Repositories\AuthRepositoryInterface;
use App\Interfaces\Repositories\BookRepositoryInterface;
use App\Interfaces\Repositories\LikeRepositoryInterface;
use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Interfaces\Services\TranslationServiceInterface;
use App\Interfaces\Repositories\OrderRepositoryInterface;
use App\Interfaces\Services\ExchangeRateServiceInterface;
use App\Interfaces\Services\NotificationServiceInterface;
use App\Interfaces\Repositories\CategoryRepositoryInterface;
use App\Interfaces\Repositories\LanguageRepositoryInterface;
use App\Interfaces\Repositories\TranslationRepositoryInterface;
use App\Interfaces\Repositories\ExchangeRateRepositoryInterface;
use App\Interfaces\Repositories\NotificationRepositoryInterface;

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
        $this->app->bind(LikeServiceInterface::class,LikeService::class);
        $this->app->bind(OrderServiceInterface::class,OrderService::class);
        $this->app->bind(NotificationServiceInterface::class,NotificationService::class);


       // Repositories
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
        $this->app->bind(BookRepositoryInterface::class, BookRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(LanguageRepositoryInterface::class, LanguageRepository::class);        
        $this->app->bind(TranslationRepositoryInterface::class, TranslationRepository::class);
        $this->app->bind(LikeRepositoryInterface::class, LikeRepository::class);
        $this->app->bind(NotificationRepositoryInterface::class, NotificationRepository::class);
        $this->app->bind(ExchangeRateRepositoryInterface::class, ExchangeRateRepository::class);

        

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
