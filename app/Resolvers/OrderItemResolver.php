<?php

namespace App\Resolvers;

use App\Commons\ConstantsPool as P;
use App\Commons\Database\ConstantsPool as D;
use App\Models\OrderItem;
use App\Services\Contracts\StockServiceContract;
use App\Strategies\ThrowableStockStrategy;

readonly class OrderItemResolver
{
    public function __construct(private StockServiceContract $stockService)
    {
    }

    public function __invoke(?array $root, array $args): ?OrderItem
    {
        $this
            ->stockService
            ->availability(new ThrowableStockStrategy($args));

        return OrderItem::updateOrCreate(
            [
                D::ID => $args[D::ID] ?? null
            ],
            [
                D::ORDER_ID => $args[D::ORDER_ID],
                D::PRODUCT_ID => $args[D::PRODUCT_ID],
                D::AMOUNT => $args[D::AMOUNT],
                P::ROOT => $root
            ]
        );
    }
}
