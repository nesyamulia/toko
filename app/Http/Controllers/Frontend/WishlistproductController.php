<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class WishlistproductController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $wishlistItems = Cart::instance('wishlist_' . $user->id)->content();
       
        return view('frontend.wishlist.wishlist', compact('wishlistItems'));
    }

    public function addWishlist(Request $request) {
        $user = Auth::user();
        $id = $request->id;
        $product = Product::find($id);
        Cart::instance('wishlist_' . $user->id)->add($id, $product->product_name, 1, $product->price, ['image' => $product->image1_url]);
        $message = '<strong>' . $product->product_name . '</strong> added to wishlist successfully.';
        session()->flash('success', $message);
        return redirect()->back();
    }

    public function deleteWishlist(Request $request)
    {
        $user = Auth::user();
        $itemInfo = Cart:: instance('wishlist_' . $user->id)->get($request->rowId);
        Cart:: instance('wishlist_' . $user->id)->remove($request->rowId);

        $message = 'Item removed successfully.';
        session()->flash('success', $message);

        return redirect()->back();
    }
}


