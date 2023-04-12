<?php

use App\Commons\Database\ConstantsPool as D;
use App\Commons\Database\TableNames as T;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable(T::PRODUCTS)) {
            Schema::create(T::PRODUCTS, static function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->softDeletes();

                $table
                    ->string(D::NAME)
                    ->fulltext()
                    ->unique();
                $table
                    ->decimal(D::PRICE, 12)
                    ->default(0);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists(T::PRODUCTS);
    }
};
