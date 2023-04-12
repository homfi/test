<?php

namespace App\Services;

use App\Services\Contracts\OrderServiceContract;
use App\Strategies\Contracts\OrderItemStrategyContract;
use App\Strategies\Contracts\StockStrategyContract;
use Illuminate\Support\Collection;

final readonly class OrderService implements OrderServiceContract
{
    public function __construct(private Collection $processedOrderItems)
    {
    }

    public function process(StockStrategyContract $stockStrategy, OrderItemStrategyContract $orderStrategy): bool
    {
        if ($stockStrategy->check()) {
            $orderStrategy
                ->assignWarehouses()
                ->each($this->processedOrderItems->add(...));
        }

        $this
            ->processedOrderItems
            ->each(fn($item) => $item->save());

        return $this->processedOrderItems->count() > 0;
    }
}
