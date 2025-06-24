<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductSize extends Model
{
    protected $fillable = [
        'product_id',
        'display_size_id',
        'price',
        'discount',
        'final_price',
        'is_show'
    ];

    protected $casts = [
        'is_show' => 'boolean'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function size(): BelongsTo
    {
        return $this->belongsTo(DisplaySize::class, 'display_size_id');
    }

    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class, 'size_id');
    }
}
