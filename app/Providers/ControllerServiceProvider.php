<?php

namespace App\Providers;

use App\Interfaces\Interfaces\Services\AuthServiceInterface;
use App\Services\AuthService;
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
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
