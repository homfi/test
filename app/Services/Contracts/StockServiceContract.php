<?php

namespace App\Services\Contracts;

use App\Strategies\Contracts\StockStrategyContract;

interface StockServiceContract
{
    public function availability(StockStrategyContract $strategy): bool;
}
