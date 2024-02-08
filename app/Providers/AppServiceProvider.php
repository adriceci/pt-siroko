<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Siroko\Domain\Product\ProductRepository;
use Siroko\Infrastructure\Product\MySQLProductRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ProductRepository::class, MySQLProductRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
