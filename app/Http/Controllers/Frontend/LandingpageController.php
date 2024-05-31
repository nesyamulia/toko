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
        $products = Product::orderBy('id', 'desc')->take(8)->get();
        return view('frontend.landingpage.landingpage', compact('products'));
    }
}
