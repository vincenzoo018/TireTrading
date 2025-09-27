<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Inventory extends Model
{
    protected $primaryKey = 'inventory_id';

    protected $fillable = [
        'product_id',
        'quantity_on_hand',
        'last_updated'
    ];

    protected $casts = [
        'last_updated' => 'datetime'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class, 'inventory_id', 'inventory_id');
    }
}
