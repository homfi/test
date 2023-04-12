<?php

namespace App\Services\Contracts;

use App\Strategies\Contracts\OrderItemStrategyContract;
use App\Strategies\Contracts\StockStrategyContract;

interface OrderServiceContract
{
    public function process(StockStrategyContract $stockStrategy, OrderItemStrategyContract $orderStrategy): bool;
}
