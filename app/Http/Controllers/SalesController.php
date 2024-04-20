<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\sales;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $id = $request->product_id;
        $stock = Product::select('stock')->where('id', $id)->first();
        $harga = Product::select('id', 'price')->where('id','=', $id)->first();

        if (Sale::where('status', 'Undone')->where('product_id', $id)->exists()){
            return redirect()->route('sales');
        }else{
            if ($stock->stock < 1){
                return redirect()->route('sales');
            }else{
                $validateData = Sale::create([
                    'receipt_id' => $request->receipt_id,
                    'product_id' => $id,
                    'total_price' => $harga->price,
                ]);
        
                // User::create($validateData);
                return redirect()->route('sales');
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(sales $sales)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(sales $sales)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, sales $sales)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(sales $sales)
    {
        //
    }
}
