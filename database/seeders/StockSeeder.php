<?php

namespace Database\Seeders;

use App\Commons\Database\ConstantsPool as D;
use App\Models\Stock;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class StockSeeder extends Seeder
{
    public function __construct(
        private readonly array $stocks = [
            [
                D::WAREHOUSE_ID => 1,
                D::PRODUCT_ID => 1,
                D::AMOUNT => 5
            ],
            [
                D::WAREHOUSE_ID => 2,
                D::PRODUCT_ID => 1,
                D::AMOUNT => 4
            ],
            [
                D::WAREHOUSE_ID => 3,
                D::PRODUCT_ID => 1,
                D::AMOUNT => 3
            ],
        ]
    )
    {
    }

    public function run(): void
    {
        collect($this->stocks)
            ->map(fn($stock) => [
                D::CREATED_AT => Carbon::now(),
                ...$stock
            ])
            ->each(Stock::insertOrIgnore(...));
    }
}
