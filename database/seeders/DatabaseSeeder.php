<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    private array $seeders = [
        ClientSeeder::class,
        ProductSeeder::class,
        WarehouseSeeder::class,
        StockSeeder::class,
        OrderSeeder::class,
        OrderItemSeeder::class
    ];

    public function run(): void
    {
        User
            ::factory(10)
            ->create();

        $this->call($this->seeders);
    }
}
