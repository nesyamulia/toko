<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_category_id',
        'product_name',
        'description',
        'price',
        'stok_quantity',
        'image1_url',
        'image2_url',
        'image3_url',
        'image4_url',
        'image5_url',
    ];

    /**
     * Get the category that owns the product.
     */
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function discounts()
    {
        return $this->hasMany(Discount::class);
    }

    
}
