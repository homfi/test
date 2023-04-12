<?php

namespace App\Models;

use App\Commons\Database\ConstantsPool as D;
use App\Commons\Database\TableNames as T;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\ProcessedOrderItem
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property int $order_id
 * @property int $product_id
 * @property int $warehouse_id
 * @property int $amount
 * @method static updateOrCreate(array $find, array $data)
 */
class ProcessedOrderItem extends OrderItem
{
    protected $table = T::PROCESSED_ORDER_ITEMS;

    protected $fillable = [
        D::CREATED_AT,
        D::UPDATED_AT,
        D::DELETED_AT,
        D::ORDER_ID,
        D::PRODUCT_ID,
        D::WAREHOUSE_ID,
        D::AMOUNT,
    ];

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class, D::WAREHOUSE_ID);
    }
}
