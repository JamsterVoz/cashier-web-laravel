<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Models\Sale;
use App\Models\Product;
use App\Models\DetailSales;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DetailSalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $data = DetailSales::all();

       return view('receipt.list', compact('data'));
    }

    public function receiptDetail($id)
    {
        $data = DetailSales::where('id', $id)->first();
        $data_product = Sale::where('receipt_id', $id)->get();
        $total_sales = $data_product->sum('total_price');
        // dd($data);
        return view('receipt.detail', compact('data', 'data_product', 'total_sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, $id)
    {
        $data = [
            'customer' => 'required'
        ];

        $validate = $request->validate($data);
        $sub_total = Sale::where('status', 'Undone')->sum('total_price');
        $customer = $request->customer;
        
        DetailSales::where('id', $id)->update([
            'customer' => $customer,
            'sub_total' => $sub_total,
            'status' => 'Done'  
        ]);

        Sale::where('receipt_id', $id)->update([
            'status' => 'Done'
        ]);


        // Mengurangi stok produk
        $test = Sale::where('receipt_id', $id)->get();

        foreach ($test as $t)
        {
            $value = Product::where('id', $t->product_id)->get();
            foreach ($value as $v) {
                $hasil = $v->stock - $t->stock_quantity;

                Product::where('id', $t->product_id)->update([
                    'stock' => $hasil
                ]);
                echo $hasil;
            }
        }
        //
        return redirect()->route('receiptDetail', $id);
    }

    public function printReceipt($id)
    {
        $data = DetailSales::where('id', $id)->first();
        $data_product = Sale::where('receipt_id', $id)->get();
        $total_harga_keseluruhan = $data_product->sum('total_harga');

    	$pdf = PDF::loadview('receipt.receipt-pdf', compact('data', 'data_prod$data_product', 'total_harga_keseluruhan'));
        // return view('receipt-pdf', compact('data', 'produk_data', 'total_harga_keseluruhan'));
        // return $pdf->stream();
    	return $pdf->download('receipt.pdf');
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
    public function show(detail_sales $detail_sales)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(detail_sales $detail_sales)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, detail_sales $detail_sales)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(detail_sales $detail_sales)
    {
        //
    }
}
