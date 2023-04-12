<?php

namespace App\Providers;

use App\Services\Contracts\OrderServiceContract;
use App\Services\Contracts\StockServiceContract;
use App\Services\OrderService;
use App\Services\StockService;
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
