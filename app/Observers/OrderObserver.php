<?php

namespace App\Observers;

use App\Commons\Database\ConstantsPool as D;
use App\Enums\OrderStatus;
use App\Models\Order;
use App\Services\Contracts\OrderServiceContract;
use App\Strategies\SilentStockStrategy;
use App\Strategies\WarehouseOrderItemStrategy;

class OrderObserver
{
    public bool $afterCommit = true;

    public function __construct(private readonly OrderServiceContract $orderService)
    {
    }

    public function updated(Order $order): void
    {
        if ($order->wasChanged(D::STATUS)
            && $order->getAttribute(D::STATUS) === OrderStatus::PAID->name
        ) {
            $service = $this->orderService;
            $operationsStatus = $order
                ->items()
                ->get()
                ->map(static fn($item) => $service
                    ->process(
                        new SilentStockStrategy([
                            D::PRODUCT_ID => $item->id,
                            D::AMOUNT => $item->amount
                        ]),
                        new WarehouseOrderItemStrategy($item)
                    )
                )
                ->sum();

            $order
                ->setAttribute(D::STATUS, $operationsStatus ? OrderStatus::ACCEPTED->name : OrderStatus::REJECTED->name)
                ->save();
        }
    }
}
