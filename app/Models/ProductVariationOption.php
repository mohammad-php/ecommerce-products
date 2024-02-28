<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductVariationOption extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $fillable = [
        'product_variation_id',
        'value',
        'quantity',
        'availability'
    ];

    public function variation(): BelongsTo
    {
        return $this->belongsTo(ProductVariations::class);
    }

}
