<?php

namespace App\Strategies;

use App\Commons\Database\ConstantsPool as D;
use App\Exceptions\StockException;
use App\Models\Stock;

final readonly class ThrowableStockStrategy extends StockStrategy
{
    /**
     * @throws StockException
     */
    public function check(): true
    {
        $currentStockAmount = Stock
            ::where(D::PRODUCT_ID, $this->data[D::PRODUCT_ID])
            ->pluck(D::AMOUNT)
            ->sum();

        $currentStockAmount >= $this->data[D::AMOUNT]
            ?: throw new StockException(__(
            'Item amount (:currentAmount) in all warehouses is lower than requested (:requestedAmount)',
            [
                'currentAmount' => $currentStockAmount,
                'requestedAmount' => $this->data[D::AMOUNT]
            ]
        ));

        return true;
    }
}
