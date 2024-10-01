<?php

namespace App\Providers;

use App\Services\{
    Contracts\OrderServiceContract,
    Contracts\StockServiceContract,
    OrderService,
    StockService
};
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this
            ->app
            ->bind(StockServiceContract::class, StockService::class);
        $this
            ->app
            ->bind(OrderServiceContract::class, OrderService::class);
    }
}
