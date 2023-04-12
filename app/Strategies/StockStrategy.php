<?php

namespace App\Strategies;

use App\Strategies\Contracts\StockStrategyContract;

abstract readonly class StockStrategy implements StockStrategyContract
{
    public function __construct(public array $data)
    {
    }
}
