<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_id';

    protected $fillable = [
        'product_name',
        'description',
        'price',
        'stock_quantity',
        'brand',
        'model',
        'selling_price',
        'category_id',
        'cost_price',
        'min_stock_level',
        'max_stock_level',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'selling_price' => 'decimal:2',
        'cost_price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    // Relationships
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    public function receivingDetails()
    {
        return $this->hasMany(ReceivingDetail::class, 'product_id', 'product_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'product_id', 'product_id');
    }

    // Helper methods
    public function isLowStock()
    {
        return $this->stock_quantity <= $this->min_stock_level;
    }

    public function profitMargin()
    {
        return $this->selling_price - $this->cost_price;
    }
}