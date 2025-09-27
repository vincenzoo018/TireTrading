<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    protected $primaryKey = 'services_id';
    protected $table = 'services';

    protected $fillable = [
        'service_name',
        'service_price',
        'description',
        'employee_id',
        'status'
    ];

    protected $casts = [
        'service_price' => 'decimal:2'
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class, 'service_id', 'services_id');
    }
}