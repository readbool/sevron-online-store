<?php

declare(strict_types=1);

namespace App\Providers;

use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use App\Services\Order\Interfaces\OrderFactoryInterface;
use App\Services\Order\Interfaces\OrderStatusUpdaterInterface;
use App\Services\Order\OrderFactory;
use App\Services\Order\OrderStatusUpdater;
use App\Services\Product\Interfaces\ProductFactoryInterface;
use App\Services\Product\ProductFactory;
use Illuminate\Support\ServiceProvider;

final class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Repositories
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);

        // Services
        $this->app->bind(ProductFactoryInterface::class, ProductFactory::class);
        $this->app->bind(OrderStatusUpdaterInterface::class, OrderStatusUpdater::class);
        $this->app->bind(OrderFactoryInterface::class, OrderFactory::class);
    }

    public function boot(): void
    {
        //
    }
}
