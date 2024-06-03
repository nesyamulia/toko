<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
   
    protected $fillable = [
        'customer_id',
        'order_date',
        'discount_id',
        'discount',
        'subtotal',
        'total_amount',
        'payment_method',
        'bank_name',
        'card_number',
        'payment_status',
        'status',
        'shipping_date',
    ];

  
    protected $casts = [
        'order_date' => 'datetime',
    ];


    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function items(){
        return $this->hasMany(OrderDetail::class);
    }
}
