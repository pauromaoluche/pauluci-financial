<?php

namespace App\Providers;

use App\Interfaces\AccountServiceInterface;
use App\Interfaces\NotificationServiceInterface;
use App\Interfaces\UserServiceInterface;
use App\Repositories\AccountRepositoryInterface;
use App\Repositories\Eloquent\AccountRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\UserRepositoryInterface;
use App\Services\AccountService;
use App\Services\NotificationService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(AccountRepositoryInterface::class, AccountRepository::class);

        // Bindings dos Serviços
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(AccountServiceInterface::class, AccountService::class);
        $this->app->bind(NotificationServiceInterface::class, NotificationService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
