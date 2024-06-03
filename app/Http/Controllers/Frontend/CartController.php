<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Discount;
use Carbon\Carbon; 
use Illuminate\Support\Facades\Auth;
use App\Models\OrderDetail;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function addCart(Request $request)
    {
        $id = $request->id;
        $user = Auth::user();
        $product = Product::find($id);
        // dd($id);
        Cart::instance('cart_' . $user->id)->add($id, $product->product_name, 1, $product->price,
            ['image' => $product->image1_url]
        );
        // dd(Cart::content());
        $message = '<strong>' . $product->product_name . '</strong> added to cart successfully.';
        session()->flash('success', $message);

        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function cart()
    {
        $user = Auth::user();
        $cartContent = Cart:: instance('cart_' . $user->id)->content();
        // if (Auth::check()) {
        //     dd(Auth::user()->id);
        // } else {
        //     dd('User not authenticated');
        // }
        return view('frontend.cart.cart', compact('cartContent'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function updateCart(Request $request)
    {
        $user = Auth::user();
        $rowId = $request->rowId;
        $qty = $request->qty;

        // dd('rowId: ' . $rowId . ' qty: ' . $qty);

        $itemInfo = Cart::instance('cart_' . $user->id)->get($rowId);
        $product = Product::find($itemInfo->id);

        if ($qty <= $product->stok_quantity) {
            Cart::instance('cart_' . $user->id)->update($rowId, $qty);
            $message = 'Cart updated successfully.';
            $status = true;
            session()->flash('success', $message);

        } else {
            $message = 'Request qty(' . $qty . ') not available in stock.';
            $status = false;
            session()->flash('error', $message);

        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function deleteCart(Request $request)
    {
        $user = Auth::user();
        $itemInfo = Cart:: instance('cart_' . $user->id)->get($request->rowId);
        Cart:: instance('cart_' . $user->id)->remove($request->rowId);

        $message = 'Item removed successfully.';
        session()->flash('success', $message);

        return redirect()->back();
    }
    public function applyDiscount(Request $request)
    {
        // dd($request->code);
        $code = Discount::where('code', $request->code)->first();
    
        if ($code == null) {
            return redirect()->back()->with('discountResponse', [
                'status' => false,
                'message' => 'Invalid or Expired Discount Code.'
            ]);
        }
    
        // Check if coupon start date is valid
        $now = Carbon::now();
    
        if ($code->start_date != "") {
            $startDate = Carbon::createFromFormat('Y-m-d H:i:s', $code->start_date);
    
            if ($now->lt($startDate)) {
                return redirect()->back()->with('discountResponse', [
                    'status' => false,
                    'message' => 'Invalid or Expired Discount Code.'
                ]);
            }
        }
    
        if ($code->end_date != "") {
            $endDate = Carbon::createFromFormat('Y-m-d H:i:s', $code->end_date);
    
            if ($now->gt($endDate)) {
                return redirect()->back()->with('discountResponse', [
                    'status' => false,
                    'message' => 'Invalid or Expired Discount Code.'
                ]);
            }
        }
    
        session()->put('code', $code);
        
        $user = Auth::user();
        $couponCodeId = $code->id;
        $codeValue = $code->code;
        $discount = 0;
        $subTotal = Cart:: instance('cart_' . $user->id)->subtotal(0, '.', '');
    
        if ($code->type == 'percentage') {
            $discount = ($code->discount_amount / 100) * $subTotal;
        } else {
            $discount = $code->discount_amount;
        }
        // Check if fixed discount amount exceeds subtotal
        if ($discount > $subTotal) {
            return redirect()->back()->with('discountResponse', [
                'status' => false,
                'message' => 'Discount amount exceeds subtotal. Invalid Discount Code.'
            ]);
        }
        $grandTotal = $subTotal - $discount;
    
        $response = [
            'status' => true,
            'grandTotal' => number_format($grandTotal, 0, '.', ''),
            'discount' => number_format($discount, 0, '.', ''),
            'discountString' => 'Discount applied successfully!'
        ];
    
        session()->put('discountResponse', $response);
    
        return redirect()->back()->with('discountResponse', $response);
    }

    public function checkout()
    {
        $user = Auth::user();
        $customer = Customer::where('user_id', $user->id)->first();
        $cartItems = Cart::instance('cart_' . $user->id)->content();
        
        return view('frontend.checkout.checkout', compact('customer' , 'cartItems'));
    }

    public function saveCustomer(Request $request)
    {
        // store ke tabel customer 
        $user = Auth::user();
        Customer::updateOrCreate(
            ['user_id' => $user->id],
            [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'zip' => $request->zip,
                'order_notes' => $request->order_notes
            ],
        );

        $message = 'Customer information saved successfully.';
        session()->flash('success', $message);
        
        return redirect()->back();
    }
    
    public function processCheckout(Request $request)
    {
        $user = Auth::user();
        $customer = Customer::where('user_id', $user->id)->first();
        
        // Ambil subtotal dari keranjang belanja
        $subTotal = Cart:: instance('cart_' . $user->id)->subtotal(0, '.', '');
        // Ambil diskon dari sesi jika ada
        $discount = session('discountResponse')['discount'] ?? 0;
        $discountId = session('code')->id ?? null;
        // Hitung grand total, gunakan subtotal jika tidak ada diskon
        $grandTotal = session('discountResponse')['grandTotal'] ?? $subTotal;

        // store ke tabel orders

        $lastOrder = Order::latest()->first();
        $LastOrderNo = $lastOrder ? intval(substr($lastOrder->order_no, 5)) : 0;
        $nextOrder = $LastOrderNo + 1;
        $formatOrder = '#ORD-' . str_pad($nextOrder, 2, 0, STR_PAD_LEFT);


        $order = new Order;
        $order->order_no = $formatOrder;
        $order->customer_id = $customer->id;
        $order->order_date = Carbon::now();
        $order->subtotal = $subTotal;
        $order->discount_id = $discountId;
        $order->discount = $discount;
        $order->total_amount = $grandTotal;
        $order->payment_method = $request->payment_method;
        if ($request->payment_method == 'transfer') {
            $order->payment_status = 'paid';
            $order->bank_name = $request->bank_name;
            $order->card_number = $request->card_number;
        } else {
            $order->payment_status = 'not_paid';
        }
        $order->status = 'pending';
        $order->save();
    
    
        // store ke tabel order_details
        $cartItems = Cart:: instance('cart_' . $user->id)->content();
        foreach ($cartItems as $cartItem) {
            $orderDetail = new OrderDetail;
            $orderDetail->order_id = $order->id;
            $orderDetail->product_id = $cartItem->id;
            $orderDetail->quantity = $cartItem->qty;
            $orderDetail->price = $cartItem->price;
            $orderDetail->total = $cartItem->price * $cartItem->qty;
            $orderDetail->save();

            // save product stock 
            $product = Product::find($cartItem->id);
            $product->stok_quantity -= $cartItem->qty;
            $product->update();
        }
    
        Cart:: instance('cart_' . $user->id)->destroy();
    
        return redirect()->route('success')->with('success', 'Order placed successfully. Thank you for shopping with us.');
    }
    // success checkout
    public function success()
    {
        return view('frontend.success.success');
    }
}