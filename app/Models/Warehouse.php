<?php

namespace App\Models;

use App\Commons\ConstantsPool as P;
use App\Commons\Database\ConstantsPool as D;
use App\Commons\Database\TableNames as T;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Warehouse
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property string $name
 * @property string $location
 * @property int $priority
 * @method static insertOrIgnore(array $data)
 */
class Warehouse extends Model
{
    use SoftDeletes;

    protected $table = T::WAREHOUSES;

    protected $fillable = [
        D::CREATED_AT,
        D::UPDATED_AT,
        D::DELETED_AT,
        D::NAME,
        D::LOCATION,
        D::PRIORITY
    ];

    protected $casts = [
        D::CREATED_AT => P::DATETIME,
        D::UPDATED_AT => P::DATETIME,
        D::DELETED_AT => P::DATETIME
    ];

    public function products(): HasManyThrough
    {
        return $this->hasManyThrough(
            Product::class,
            Stock::class,
            D::WAREHOUSE_ID,
            D::ID,
            D::ID,
            D::PRODUCT_ID
        );
    }

    public function stocks(): HasMany
    {
        return $this->hasMany(Stock::class);
    }
}
