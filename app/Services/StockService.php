<?php

namespace App\Services;

use App\Services\Contracts\StockServiceContract;
use App\Strategies\Contracts\StockStrategyContract;

class StockService implements StockServiceContract
{
    public function availability(StockStrategyContract $strategy): bool
    {
        if (env('STOCK_AVAILABILITY')) {
            return $strategy->check();
        }

        return true;
    }
}
