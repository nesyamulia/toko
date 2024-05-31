<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Discount;


class DiscountController extends Controller
{

public function index()
{
    $discounts = Discount::all();
    return view('admin.discount.index', compact('discounts'));
}


    public function create()
    {
         return view('admin.discount.create');
    }


    public function store(Request $request)
    {
        
         $discount = $request->only([
          'code',
          'name',
          'type',
          'discount_amount',
          'start_date',
          'end_date',
          'status' ,
        ]);

        Discount::create($discount);

        return redirect()->route('discount.index')->with('success', 'Discount created successfully');
    }


    public function edit( $id)
    {
       $discounts = Discount::find($id);
        return view('admin.discount.edit', compact('discounts'));
    }

    public function update(Request $request, string $id)
    {
        $discount = Discount::find($id);
        $request->validate([
            'code' => 'required|unique:discount,code,'. $id,
        ]);

        $discount->update($request->all());
        $discount->save();
        return redirect()->route('discount.index')->with('success', 'Discount updated successfully');
    }

    public function destroy(Discount $discount)
    {
        $discount->delete();

        return redirect()->route('discount.index')->with('success', 'Discount deleted successfully');
    }
}
