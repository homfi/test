<?php

namespace App\Strategies;

use App\Commons\Database\ConstantsPool as D;
use App\Models\Stock;

final readonly class SilentStockStrategy extends StockStrategy
{
    public function check(): bool
    {
        $currentStockAmount = Stock
            ::where(D::PRODUCT_ID, $this->data[D::PRODUCT_ID])
            ->pluck(D::AMOUNT)
            ->sum();

        return $currentStockAmount >= $this->data[D::AMOUNT];
    }
}
