<?php

use App\Commons\Database\ConstantsPool as D;
use App\Commons\Database\TableNames as T;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create(T::STOCKS, static function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger(D::WAREHOUSE_ID);
            $table
                ->foreign(D::WAREHOUSE_ID)
                ->references(D::ID)
                ->on(T::WAREHOUSES);

            $table->unsignedBigInteger(D::PRODUCT_ID);
            $table
                ->foreign(D::PRODUCT_ID)
                ->references(D::ID)
                ->on(T::PRODUCTS);

            $table->integer(D::AMOUNT);

            $table->unique(
                [
                    D::WAREHOUSE_ID,
                    D::PRODUCT_ID
                ]
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(T::STOCKS);
    }
};
