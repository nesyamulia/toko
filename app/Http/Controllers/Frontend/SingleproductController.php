<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Discount;
use App\Models\ProductReview;
use Carbon\Carbon;

class SingleproductController extends Controller
{

    public function show($id)
    {
        // Ambil satu produk berdasarkan ID
        $product = Product::findOrFail($id);
        
        // Ambil data diskon yang sesuai untuk produk ini
        $discount = Discount::where('product_id', $id)->first();

        // Jika ada diskon dan tanggal saat ini berada di antara start_date dan end_date
        if ($discount && Carbon::now()->between($discount->start_date, $discount->end_date)) {
            // Hitung harga diskon
            $discountedPrice = $product->price - ($product->price * $discount->percentage / 100);
            $product->discounted_price = $discountedPrice;

            // Ambil category_name berdasarkan category_discount_id
            $product->discount_category_name = $discount->categoryDiscount->category_name ?? null;

            // Tambahkan informasi diskon ke dalam data produk
            $product->discount = $discount;
        }

        // Buat array untuk menyimpan URL gambar-gambar produk
        $imageUrls = [];
        for ($i = 1; $i <= 5; $i++) {
            $imageUrls[] = asset('storage/product_images/' . $product->id . '/' . $product->{'image'.$i.'_url'});
        }

        // Kembalikan view dengan produk, URL gambar-gambar, dan informasi diskon
        return view('frontend.single-product.single-product', compact('product', 'imageUrls'));
    }

    public function store(Request $request)
{
    // Validasi data
    $validatedData = $request->validate([
        'rating' => 'required|numeric|min:1|max:5',
        'comment' => 'required|string|max:255',
        'product_id' => 'required|exists:products,id', // Pastikan product_id ada di tabel products
    ]);

    // Buat instance baru dari model ProductReview
    $review = new ProductReview();
    
    // Isi atribut-atribut ulasan produk dari data yang diterima
    $review->customer_id = auth()->user()->id;
    $review->product_id = $validatedData['product_id']; // Ambil product_id dari data yang divalidasi
    $review->rating = $validatedData['rating'];
    $review->comment = $validatedData['comment'];

    // Simpan ulasan produk
    $review->save();

    // Berikan respons yang sesuai, misalnya dengan mengarahkan kembali pengguna ke halaman produk
    return redirect()->route('single-product.show', $validatedData['product_id'])->with('success', 'Product review has been submitted successfully!');
}


}
