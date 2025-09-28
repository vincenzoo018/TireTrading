<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $primaryKey = 'category_id';

    // ✅ Optional: enable timestamps if you have them in DB
    public $timestamps = true;

    protected $fillable = [
        'category_name',
    ];

    /**
     * ✅ One category has many products
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id', 'category_id');
    }
}
