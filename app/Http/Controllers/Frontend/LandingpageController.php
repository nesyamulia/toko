<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\DiscountCategory;
use App\Models\Discount;
use Carbon\Carbon;

class LandingpageController extends Controller
{
    public function index()
    {
        // Ambil ID kategori untuk Populer, Limited, dan Diskon
        $categoryId_populer = ProductCategory::where('category_name', 'Populer')->value('id');
        $categoryId_limited = ProductCategory::where('category_name', 'Limited')->value('id'); 
        $categoryId_discount = ProductCategory::where('category_name', 'Diskon')->value('id');

        // Ambil produk untuk setiap kategori dengan batasan tertentu
        $products_populer = Product::where('product_category_id', $categoryId_populer)->take(3)->get();
        $products_limited = Product::where('product_category_id', $categoryId_limited)->take(3)->get();
        $products_discount = Product::where('product_category_id', $categoryId_discount)->take(4)->get();

        // Ambil data diskon yang sesuai untuk produk yang memiliki kategori diskon
        $discounts = Discount::whereIn('product_id', $products_discount->pluck('id'))->get();

        // Hitung diskon dan harga yang didiskon untuk setiap produk diskon
        foreach ($products_discount as $product) {
            $productDiscount = $discounts->where('product_id', $product->id)->first();
            if ($productDiscount && Carbon::now()->between($productDiscount->start_date, $productDiscount->end_date)) {
                $product->percentage = $productDiscount->percentage; // tambahkan percentage ke produk
                $discountedPrice = $product->price - ($product->price * $productDiscount->percentage / 100);
                $product->discounted_price = $discountedPrice;
                // Ambil data kategori diskon
                $discountCategory = DiscountCategory::find($productDiscount->category_discount_id);
                $product->discount_category_name = $discountCategory ? $discountCategory->category_name : null;
            }
        }

        return view('frontend.landingpage.index', compact('products_populer', 'products_limited', 'products_discount'));
    }
}
