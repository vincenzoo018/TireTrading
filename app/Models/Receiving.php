<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receiving extends Model
{
    use HasFactory;

    protected $primaryKey = 'receiving_id';

    protected $fillable = [
        'supplier_id',
        'employee_id',
        'receiving_no',
        'reference_number',
        'receive_date',
        'delivery_date',
        'sub_total',
        'discount',
        'total',
        'tax',
        'shipping_fee',
        'notes',
    ];

    protected $casts = [
        'receive_date' => 'date',
        'delivery_date' => 'date',
        'sub_total' => 'decimal:2',
        'discount' => 'decimal:2',
        'total' => 'decimal:2',
        'tax' => 'decimal:2',
        'shipping_fee' => 'decimal:2',
    ];

    // Relationships
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'supplier_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }

    public function receivingDetails()
    {
        return $this->hasMany(ReceivingDetail::class, 'receiving_id', 'receiving_id');
    }
}
