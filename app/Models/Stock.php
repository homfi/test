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
 * App\Models\Stock
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property int $warehouse_id
 * @property int $product_id
 * @property int $amount
 * @method static where(string $key, mixed $value)
 * @method static insertOrIgnore(array $data)
 */
class Stock extends Model
{
    use SoftDeletes;

    protected $table = T::STOCKS;

    protected $fillable = [
        D::CREATED_AT,
        D::UPDATED_AT,
        D::DELETED_AT,
        D::WAREHOUSE_ID,
        D::PRODUCT_ID,
        D::AMOUNT
    ];

    protected $casts = [
        D::CREATED_AT => P::DATETIME,
        D::UPDATED_AT => P::DATETIME,
        D::DELETED_AT => P::DATETIME
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, D::PRODUCT_ID);
    }

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class, D::WAREHOUSE_ID);
    }
}
