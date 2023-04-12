<?php

namespace Database\Seeders;

use App\Commons\Database\ConstantsPool as D;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function __construct(
        private readonly array $products = [
            'Coffee',
        ]
    )
    {
    }

    public function run(): void
    {
        collect($this->products)
            ->map(fn($product) => [
                D::CREATED_AT => Carbon::now(),
                D::NAME => $product,
                D::PRICE => 5
            ])
            ->each(Product::insertOrIgnore(...));
    }
}
