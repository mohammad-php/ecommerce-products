<?php

namespace App\Models;

use App\Casts\ProductCurrencyCast;
use App\Casts\ProductStatusCast;
use Domain\Product\Casts\ProductTypeCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static create(array|null $toArray)
 * @method static find(mixed $id)
 * @method static updateOrCreate(array $array, array $array1)
 */
class Product extends Model
{
    use HasFactory, SoftDeletes;

//    protected $guarded = ['id'];

    protected $fillable = [
        'id',
        'name',
        'sku',
        'status',
        // To Do: To move it to new ProductsVariations And ProductsVariationOptions
        'variations',
        'price',
        'currency',
        'image_url',
        'deleted_at',
    ];

    protected $dates = ['deleted_at'];

    protected $casts = [
        'price' => 'float',
        'name' => 'string',
        'status' => ProductStatusCast::class,
        'currency' => ProductCurrencyCast::class,
    ];

    // Mutator for the 'price' attribute
    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = is_numeric($value) ? $value : null;
    }

//    public function setNameAttribute($value)
//    {
//        $this->attributes['name'] = $value === 'NULL' ? null : $value;
//    }

    public function variations(): HasMany
    {
        return $this->hasMany(ProductVariations::class, 'product_id');
    }


//    protected static function booted()
//    {
//        static::creating(static function ($model) {
//            if($model->status === 'deleted') {
//                $model->delete();
//            }
//        });
//    }


}
