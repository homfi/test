<?php

namespace App\Models;

use App\Commons\ConstantsPool as P;
use App\Commons\Database\ConstantsPool as D;
use App\Commons\Database\TableNames as T;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\OrderItem
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property int $order_id
 * @property int $product_id
 * @property int $amount
 * @method static updateOrCreate(array $find, array $data)
 * @method static insertOrIgnore(array $data)
 * @method static find(int $id)
 */
class OrderItem extends Model
{
    use SoftDeletes;

    protected $table = T::ORDER_ITEMS;

    protected $fillable = [
        D::CREATED_AT,
        D::UPDATED_AT,
        D::DELETED_AT,
        D::ORDER_ID,
        D::PRODUCT_ID,
        D::AMOUNT
    ];

    protected $casts = [
        D::CREATED_AT => P::DATETIME,
        D::UPDATED_AT => P::DATETIME,
        D::DELETED_AT => P::DATETIME
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, D::ORDER_ID);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, D::PRODUCT_ID);
    }
}
