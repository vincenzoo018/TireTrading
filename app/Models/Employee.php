<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $primaryKey = 'employee_id';

    protected $fillable = [
        'name',
        'position',
        'contact_number',
        'email',
        'hire_date',
        'is_active',
    ];

    protected $casts = [
        'hire_date' => 'date',
        'is_active' => 'boolean',
    ];

    // Relationships
    public function suppliers()
    {
        return $this->hasMany(Supplier::class, 'employee_id', 'employee_id');
    }

    public function receivings()
    {
        return $this->hasMany(Receiving::class, 'employee_id', 'employee_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'employee_id', 'employee_id');
    }
}
