<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Customer;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::latest('orders.created_at')
            ->select('orders.*', 'customers.first_name', 'customers.last_name', 'customers.email')
            ->leftJoin('customers', 'customers.id', 'orders.customer_id')
            ->with('items.product')
            ->get();


        return view('admin.order.index', compact('orders'));
    }


    public function create()
    {
        $customers = Customer::all();
        return view('admin.order.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'order_date' => 'required|date',
            'total_amount' => 'required|numeric',
            'status' => 'required|string|max:20',
        ]);

        Order::create($request->all());

        return redirect()->route('order.index')->with('success', 'Order created successfully');
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $order = Order::select('orders.*', 'customers.first_name', 'customers.last_name', 'customers.email')->where('orders.id', $id)->leftJoin('customers', 'customers.id', 'orders.customer_id')->first();
        $customers = Customer::all();
        return view('admin.order.edit', compact('order', 'customers'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'order_date' => 'required|date',
            'total_amount' => 'required|numeric',
            'status' => 'required|string|max:20',
        ]);

        $order = Order::findOrFail($id);
        $order->update($request->all());

        return redirect()->route('order.index')->with('success', 'Order updated successfully');
    }


    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('order.index')->with('success', 'Order deleted successfully');
    }
}
