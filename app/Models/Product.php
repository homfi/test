<?php

namespace App\Models;

use App\Commons\{
    ConstantsPool as P,
    Database\ConstantsPool as D,
    Database\TableNames as T
};
use Illuminate\Database\{
    Eloquent\Model,
    Eloquent\Relations\HasMany,
    Eloquent\Relations\HasManyThrough,
    Eloquent\SoftDeletes
};
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property string $name
 * @property float $price
 * @method static insertOrIgnore(array $data)
 */
class Product extends Model
{
    use SoftDeletes;

    protected $table = T::PRODUCTS;

    protected $fillable = [
        D::CREATED_AT,
        D::UPDATED_AT,
        D::DELETED_AT,
        D::NAME,
        D::PRICE,
    ];

    protected $casts = [
        D::CREATED_AT => P::DATETIME,
        D::UPDATED_AT => P::DATETIME,
        D::DELETED_AT => P::DATETIME,
        D::PRICE => P::FLOAT,
    ];

    public function warehouses(): HasManyThrough
    {
        return $this->hasManyThrough(
            Warehouse::class,
            Stock::class,
            D::PRODUCT_ID,
            D::ID,
            D::ID,
            D::WAREHOUSE_ID
        );
    }

    public function stocks(): HasMany
    {
        return $this->hasMany(Stock::class);
    }
}
