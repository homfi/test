<?php

namespace Database\Seeders;

use App\Commons\Database\ConstantsPool as D;
use App\Models\Warehouse;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class WarehouseSeeder extends Seeder
{
    public function __construct(
        private readonly array $warehouses = [
            [
                D::NAME => 'Main Warehouse',
                D::LOCATION => 'Warsaw',
                D::PRIORITY => 100
            ],
            [
                D::NAME => 'Warehouse #1',
                D::LOCATION => 'Krakov',
                D::PRIORITY => 200
            ],
            [
                D::NAME => 'Warehouse #2',
                D::LOCATION => 'Gdansk',
                D::PRIORITY => 300
            ],
        ]
    )
    {
    }

    public function run(): void
    {
        collect($this->warehouses)
            ->map(fn($warehouse) => [
                D::CREATED_AT => Carbon::now(),
                ...$warehouse
            ])
            ->each(Warehouse::insertOrIgnore(...));
    }
}
