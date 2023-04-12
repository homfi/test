<?php

namespace App\Strategies;

use App\Commons\Database\ConstantsPool as D;
use App\Models\ProcessedOrderItem;
use App\Models\Stock;
use Illuminate\Support\Collection;

final class WarehouseOrderItemStrategy extends OrderItemStrategy
{
    public function assignWarehouses(): Collection
    {
        $processedOrderItems = new Collection();

        $this
            ->getMatchingStocks()
            ->each(fn($stock) => $processedOrderItems
                ->add(
                    (new ProcessedOrderItem())
                        ->fill(
                            [
                                ...$this->item->getAttributes(),
                                D::WAREHOUSE_ID => $stock->warehouse_id,
                                D::AMOUNT => $this->restock($stock),
                            ]
                        )
                )
            );

        return $processedOrderItems;
    }

    private function restock(Stock $stock): int
    {
        // todev

        return $amount;
    }

    private function getMatchingStocks(): Collection
    {
        $stocksWithProduct = Stock
            ::with('warehouse')
            ->where(D::PRODUCT_ID, $this->item->product_id)
            ->get()
            ->sortBy('warehouse.priority');
        $matchingStocks = new Collection();

        for (
            $warehouseCount = 1;
            $warehouseCount <= $stocksWithProduct->count();
            $warehouseCount++
        ) {
            $matchingSets = $stocksWithProduct;
            $joins = [];
            for (
                $crossJoin = 1;
                $crossJoin < $warehouseCount;
                $crossJoin++
            ) {
                $joins[] = $stocksWithProduct;
            }
            $matchingSets = $matchingSets->crossJoin(...$joins);

            $matchingStocks = collect($matchingSets
                ->map(fn($set) => collect($set)->unique())
                ->filter(fn($set) => collect($set)->count() === $warehouseCount)
                ->filter(fn($set) => collect($set)->pluck(D::AMOUNT)->sum() >= $this->item->amount)
                ->first()
            );
            if ($matchingStocks->count() > 0) {
                break;
            }
        }

        return $matchingStocks;
    }
}
