<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    // Mass assignable fields
    protected $fillable = [
        'product_id',
        'quantity',
        'total_price',
        'type' // 'in' for stock in, 'out' for stock out
    ];

    // Relationship: Transaction belongs to a Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
