<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $primaryKey = 'product_id';

    // ✅ If you want Laravel to auto-handle created_at & updated_at, set this to true
    public $timestamps = true;

    protected $fillable = [
        'category_id',
        'product_name',
        'brand',
        'size',
        'length',
        'width',
        'description',
        'base_price',
        'selling_price',
        
        'status'
    ];

    protected $casts = [
        'base_price' => 'decimal:2',
        'selling_price' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * ✅ Belongs to a Category
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    /**
     * ✅ Has one inventory record (if you are tracking stock separately)
     */
    public function inventory(): HasOne
    {
        return $this->hasOne(Inventory::class, 'product_id', 'product_id');
    }

    /**
     * ✅ Has many stock-in records (for stock history)
     */
    public function stockIns(): HasMany
    {
        return $this->hasMany(StockIn::class, 'product_id', 'product_id');
    }
}
