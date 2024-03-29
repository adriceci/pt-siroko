<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;
use Siroko\Domain\Cart\CartRepository;
use Siroko\Domain\Order\OrderRepository;
use Siroko\Domain\Order\OrderStatusRepository;
use Siroko\Domain\Product\ProductRepository;
use Siroko\Domain\User\PersonalAccessToken;
use Siroko\Domain\User\UserRepository;
use Siroko\Infrastructure\Cart\MySQLCartRepository;
use Siroko\Infrastructure\Order\MySQLOrderRepository;
use Siroko\Infrastructure\Order\MySQLOrderStatusRepository;
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
        $this->app->bind(CartRepository::class, MySQLCartRepository::class);
        $this->app->bind(OrderRepository::class, MySQLOrderRepository::class);
        $this->app->bind(OrderStatusRepository::class, MySQLOrderStatusRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
    }
}
