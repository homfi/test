<?php

namespace Database\Seeders;

use App\Commons\Database\ConstantsPool as D;
use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    public function __construct(
        private readonly array $clients = [
            'John Smith',
            'Jane Jones',
            'Steven Brown'
        ]
    )
    {
    }

    public function run(): void
    {
        collect($this->clients)
            ->map(fn($client) => [
                D::CREATED_AT => Carbon::now(),
                D::NAME => $client
            ])
            ->each(Client::insertOrIgnore(...));
    }
}
