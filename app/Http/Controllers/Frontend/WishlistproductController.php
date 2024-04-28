<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistproductController extends Controller
{
    public function index()
{
    // Ambil customer yang sedang login
    $customer = Auth::guard('customers')->user();

    // Jika pelanggan tidak ada, kembalikan ke halaman login
    if (!$customer) {
        return redirect()->route('customer.login');
    }

    // Ambil wishlist dari pelanggan yang sedang login
    $wishlists = $customer->wishlists;

    // Inisialisasi array untuk menyimpan produk yang ada di wishlist
    $products = [];

    // Periksa apakah $wishlists null sebelum mencoba mengiterasinya
    if (!is_null($wishlists)) {
        // Loop melalui setiap wishlist
        foreach ($wishlists as $wishlist) {
            // Ambil product_id dari wishlist saat ini
            $product_id = $wishlist->product_id;

            // Cari produk yang sesuai berdasarkan product_id
            $product = Product::where('id', $product_id)->first();

            // Jika produk ditemukan, tambahkan ke dalam array produk
            if ($product) {
                $products[] = $product;
            }
        }
    }

    // Kirim data ke view frontend.wishlist-product.wishlist-product
    return view('frontend.wishlist-product.wishlist-product', compact('products', 'customer', 'wishlists'));
}


    public function store(Request $request)
    {
        // Ambil product_id dari permintaan
        $product_id = $request->product_id;

        // Ambil customer_id dari pelanggan yang sedang login menggunakan guard 'customers'
        $customer_id = Auth::guard('customers')->id();

        // Simpan data ke dalam tabel wishlists
        Wishlist::create([
            'customer_id' => $customer_id,
            'product_id' => $product_id,
        ]);

        // Redirect ke halaman wishlist
        return redirect()->route('wishlist-product.index')->with('success', 'Product added to wishlist successfully');
    }
}
