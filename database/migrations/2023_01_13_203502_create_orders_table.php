<?php

use App\Commons\Database\ConstantsPool as D;
use App\Commons\Database\TableNames as T;
use App\Enums\OrderStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable(T::ORDERS)) {
            Schema::create(T::ORDERS, static function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->softDeletes();

                $table->unsignedBigInteger(D::CLIENT_ID);
                $table
                    ->foreign(D::CLIENT_ID)
                    ->references(D::ID)
                    ->on(T::CLIENTS);

                $table->enum(D::STATUS, OrderStatus::names());
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists(T::ORDERS);
    }
};
