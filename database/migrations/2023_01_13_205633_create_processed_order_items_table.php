<?php

use App\Commons\Database\ConstantsPool as D;
use App\Commons\Database\TableNames as T;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable(T::PROCESSED_ORDER_ITEMS)) {
            Schema::create(T::PROCESSED_ORDER_ITEMS, static function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->softDeletes();

                $table->unsignedBigInteger(D::ORDER_ID);
                $table
                    ->foreign(D::ORDER_ID)
                    ->references(D::ID)
                    ->on(T::ORDERS);

                $table->unsignedBigInteger(D::PRODUCT_ID);
                $table
                    ->foreign(D::PRODUCT_ID)
                    ->references(D::ID)
                    ->on(T::PRODUCTS);

                $table->unsignedBigInteger(D::WAREHOUSE_ID);
                $table
                    ->foreign(D::WAREHOUSE_ID)
                    ->references(D::ID)
                    ->on(T::WAREHOUSES);

                $table->integer(D::AMOUNT);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists(T::PROCESSED_ORDER_ITEMS);
    }
};
