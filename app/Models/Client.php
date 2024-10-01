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
    Eloquent\SoftDeletes
};
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property string $name
 * @method static insertOrIgnore(array $data)
 */
class Client extends Model
{
    use SoftDeletes;

    protected $table = T::CLIENTS;

    protected $fillable = [
        D::CREATED_AT,
        D::UPDATED_AT,
        D::DELETED_AT,
        D::NAME,
    ];

    protected $casts = [
        D::CREATED_AT => P::DATETIME,
        D::UPDATED_AT => P::DATETIME,
        D::DELETED_AT => P::DATETIME,
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
