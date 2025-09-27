<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    protected $primaryKey = 'supplier_id';

    protected $fillable = [
        'supplier_name',
        'address',
        'contact_person',
        'contact_number',
        'email',
        'payment_terms'
    ];

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'supplier_id', 'supplier_id');
    }
}
