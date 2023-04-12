<?php

namespace Database\Seeders;

use App\Commons\Database\ConstantsPool as D;
use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class OrderItemSeeder extends Seeder
{
    public function __construct(
        private readonly array $items = [
            [
                D::ORDER_ID => 1,
                D::PRODUCT_ID => 1,
                D::AMOUNT => 6
            ],
            [
                D::ORDER_ID => 2,
                D::PRODUCT_ID => 1,
                D::AMOUNT => 7
            ],
            [
                D::ORDER_ID => 3,
                D::PRODUCT_ID => 1,
                D::AMOUNT => 10
            ]
        ]
    )
    {
    }

    public function run(): void
    {
        collect($this->items)
            ->map(fn($item) => [
                D::CREATED_AT => Carbon::now(),
                ...$item
            ])
            ->each(OrderItem::insertOrIgnore(...));
    }
}
