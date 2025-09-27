<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaction extends Model
{
    protected $primaryKey = 'transaction_id';

    protected $fillable = [
        'reference_num',
        'delivery_date',
        'delivery_fee',
        'delivery_received',
        'tax',
        'sub_total',
        'overall_total',
        'supplier_id',
        'customer_id'
    ];

    protected $casts = [
        'delivery_date' => 'date',
        'delivery_received' => 'boolean',
        'delivery_fee' => 'decimal:2',
        'tax' => 'decimal:2',
        'sub_total' => 'decimal:2',
        'overall_total' => 'decimal:2'
    ];

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'supplier_id');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }

    public function stockIns(): HasMany
    {
        return $this->hasMany(StockIn::class, 'transaction_id', 'transaction_id');
    }
}
