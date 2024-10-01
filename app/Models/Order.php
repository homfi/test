<?php

namespace App\Models;

use App\Commons\{
    ConstantsPool as P,
    Database\ConstantsPool as D,
    Database\TableNames as T
};
use App\Enums\OrderStatus;
use Illuminate\Database\{
    Eloquent\Model,
    Eloquent\Relations\BelongsTo,
    Eloquent\Relations\HasMany,
    Eloquent\SoftDeletes
};
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property int $client_id
 * @property string|OrderStatus $status
 * @method static insertOrIgnore(array $data)
 * @method static Order find(int $id)
 */
class Order extends Model
{
    use SoftDeletes;

    protected $table = T::ORDERS;

    protected $fillable = [
        D::CREATED_AT,
        D::UPDATED_AT,
        D::DELETED_AT,
        D::CLIENT_ID,
        D::STATUS,
    ];

    protected $casts = [
        D::CREATED_AT => P::DATETIME,
        D::UPDATED_AT => P::DATETIME,
        D::DELETED_AT => P::DATETIME,
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, D::CLIENT_ID);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function processedItems(): HasMany
    {
        return $this->hasMany(ProcessedOrderItem::class);
    }
}
