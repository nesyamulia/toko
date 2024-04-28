<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::all();
        return view('admin.product.index', compact('products'));
    }

  
    public function create()
    {
        $categories = ProductCategory::all();
        return view('admin.product.create', compact('categories'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'product_category_id' => 'required|exists:product_categories,id',
            'product_name' => 'required|string|max:100|unique:products,product_name',
            'description' => 'required|string',
            'price' => 'required|integer',
            'stok_quantity' => 'required|integer',
            'image1_url' => 'nullable|image|max:20048',
            'image2_url' => 'nullable|image|max:20048',
            'image3_url' => 'nullable|image|max:20048',
            'image4_url' => 'nullable|image|max:20048',
            'image5_url' => 'nullable|image|max:20048',
        ]);

        // Simpan gambar
        $imagePaths = [];
        for ($i = 1; $i <= 5; $i++) {
            if ($request->hasFile('image'.$i.'_url')) {
                $image = $request->file('image'.$i.'_url');
                $imageName = 'product_' . $i . '_' . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('storage/product_images'), $imageName);
                $imagePaths['image'.$i.'_url'] = 'storage/product_images/' . $imageName;
            }
        }

        // Tambahkan path gambar ke request data
        $requestData = $request->except(['_token', '_method']);
        $requestData = array_merge($requestData, $imagePaths);

        Product::create($requestData);

        return redirect()->route('product.index')->with('success', 'Product created successfully');
    }

    
    public function edit($id)
{
    // Ambil data produk yang akan diedit
    $product = Product::findOrFail($id);

    // Ambil semua kategori produk
    $categories = ProductCategory::all();

    // Render view edit.blade.php dan lewatkan data produk dan kategori produk ke dalam view
    return view('admin.product.edit', compact('product', 'categories'));
}

 
    public function update(Request $request, Product $product)
    {
        $rules = [
            'product_category_id' => 'required|exists:product_categories,id',
            'product_name' => ['required', 'string', 'max:100', Rule::unique('products')->ignore($product->id)],
            'description' => 'required|string',
            'price' => 'required|integer',
            'stok_quantity' => 'required|integer',
            'image1_url' => 'nullable|image|max:20048',
            'image2_url' => 'nullable|image|max:20048',
            'image3_url' => 'nullable|image|max:20048',
            'image4_url' => 'nullable|image|max:20048',
            'image5_url' => 'nullable|image|max:20048',
        ];

        // Tambahkan validasi untuk setiap kolom gambar yang diunggah
        for ($i = 1; $i <= 5; $i++) {
            if ($request->hasFile("image{$i}_url")) {
                $rules["image{$i}_url"] = 'image|max:20048';
            }
        }

        $request->validate($rules);

        // Update data produk
        $product->update($request->except(['_token', '_method', 'image1_url', 'image2_url', 'image3_url', 'image4_url', 'image5_url']));

        // Simpan gambar-gambar baru
        $imagePaths = [];
        for ($i = 1; $i <= 5; $i++) {
            if ($request->hasFile("image{$i}_url")) {
                $image = $request->file("image{$i}_url");
                $imageName = 'products_' . $i . '_' . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('storage/product_images'), $imageName);
                $imagePaths["image{$i}_url"] = 'storage/product_images/' . $imageName;
            }
        }

        // Simpan path foto baru ke dalam model
        $product->update($imagePaths);

        // Redirect dengan pesan sukses
        return redirect()->route('product.index')->with('success', 'Product updated successfully');
    }


    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('product.index')->with('success', 'Product deleted successfully');
    }
}