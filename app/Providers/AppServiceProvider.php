<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Siroko\Domain\Product\ProductRepository;
use Siroko\Domain\User\UserRepository;
use Siroko\Infrastructure\Product\MySQLProductRepository;
use Siroko\Infrastructure\User\MySQLUserRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ProductRepository::class, MySQLProductRepository::class);
        $this->app->bind(UserRepository::class, MySQLUserRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
