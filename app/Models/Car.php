<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $primaryKey = 'car_id';
    public $timestamps = true;

    protected $fillable = [
        'brand',
        'model',
        'year',
        'plate_number',
        'price',
        'status',
        'mileage',
        'type',
        'photo',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'year' => 'integer',
        'mileage' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Accessor for photo URL
    public function getPhotoUrlAttribute()
    {
        if ($this->photo) {
            return asset($this->photo);
        }
        return asset('images/default-car.jpg');
    }

    // Scope for available cars
    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    // Scope for rented cars
    public function scopeRented($query)
    {
        return $query->where('status', 'rented');
    }

    // Scope for maintenance cars
    public function scopeMaintenance($query)
    {
        return $query->where('status', 'maintenance');
    }
}