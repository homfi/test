<?php

namespace App\Services\Contracts;

use App\Strategies\Contracts\{
    OrderItemStrategyContract,
    StockStrategyContract
};

interface OrderServiceContract
{
    public function process(StockStrategyContract $stockStrategy, OrderItemStrategyContract $orderStrategy): bool;

    private function check(): bool;
}
