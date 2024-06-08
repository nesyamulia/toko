<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customer = Customer::where('user_id', Auth::id())->first();
        $user = User::where('id', Auth::id())->first();
        return view('frontend.account.account', compact('customer', 'user'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function myOrder()
    {
        $customer = Customer::where('user_id', Auth::id())->get()->first();
        $orders = Order::where('customer_id', $customer->id)->orderBy('id', 'desc')->get();
        return view('frontend.account.my_order', compact('orders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function myAddress()
    {
        $customer = Customer::where('user_id', Auth::id())->first();
        $user = User::where('id', Auth::id())->first();
        return view('frontend.account.my_address', compact('customer', 'user'));
    }

    public function updateAddress(Request $request)
    {
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

        
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function updateAccount( Request $request)
    {
        $user = Auth::user();
        User::updateOrCreate(
            ['id' => $user->id],
            [
                'name' => $request->name,
                'email' => $request->email
            ],
        );

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function myOrderDetail(string $id)
    {
        $user = User::where('id', Auth::id())->first();
        $customer = Customer::where('user_id', $user->id)->first();
        $order = Order::where('orders.id', $id)
        ->select('orders.*')
        ->where('orders.customer_id', $customer->id)
        ->leftJoin('customers', 'customers.id', '=', 'orders.customer_id')
        ->first();

        $orderDetail = OrderDetail::where('order_id', $order->id)->select('order_details.*', 'products.product_name')->leftJoin('products', 'products.id', 'order_details.product_id')->get();

        return view('frontend.account.my_order_detail', compact('order', 'orderDetail'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
