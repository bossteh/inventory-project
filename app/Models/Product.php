<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Mass assignable fields
    protected $fillable = [
        'name',
        'category_id',
        'quantity',
        'price'
    ];

    // Relationship: Product belongs to a Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relationship: Product has many Transactions
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
