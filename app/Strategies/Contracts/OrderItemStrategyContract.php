<?php

namespace App\Strategies\Contracts;

use Illuminate\Support\Collection;

interface OrderItemStrategyContract
{
    public function assignWarehouses(): Collection;
}
