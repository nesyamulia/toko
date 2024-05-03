<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $fillable = [
        'customer_id',
        'product_id',
    ];

    // Relationship with Customer model
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Relationship with Product model
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
