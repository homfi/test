<?php

namespace App\Strategies;

use App\Models\OrderItem;
use App\Strategies\Contracts\OrderItemStrategyContract;

abstract class OrderItemStrategy implements OrderItemStrategyContract
{
    public function __construct(public OrderItem $item)
    {
    }
}
