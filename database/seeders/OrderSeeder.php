<?php

namespace Database\Seeders;

use App\Commons\Database\ConstantsPool as D;
use App\Enums\OrderStatus;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function __construct(
        private readonly array $clients = [
            1,
            2,
            3
        ]
    )
    {
    }

    public function run(): void
    {
        collect($this->clients)
            ->map(fn($client) => [
                D::CREATED_AT => Carbon::now(),
                D::STATUS => OrderStatus::CREATED->name,
                D::CLIENT_ID => $client
            ])
            ->each(Order::insertOrIgnore(...));
    }
}
