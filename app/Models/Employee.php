<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    protected $primaryKey = 'employee_id';

    protected $fillable = [
        'employee_name',
        'email',
        'contact_number',
        'position',
        'role_id'
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id', 'role_id');
    }

    public function services(): HasMany
    {
        return $this->hasMany(Service::class, 'employee_id', 'employee_id');
    }
}