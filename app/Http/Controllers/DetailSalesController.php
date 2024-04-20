<?php

namespace App\Http\Controllers;

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
        $product = Product::all();

        // Mengambil data barang yang sedang diproses atau belum di beli, baru dimasukan ke keranjang
        $checkout = DetailSales::where('status', 'Undone')->get();
        // Menjumlahkan semua harga produk yang ada di keranjang
        $sub_total = Sale::where('status', 'Undone')->sum('total_price');
        // Mengambil id untuk relasi dari detail penjualan ke penjualan
        $receipt = DetailSales::where('status', 'Undone')->first();

        if($receipt){
            return view('checkout.checkout', compact('product', 'checkout', 'sub_total', 'receipt'));
        }
        else{
            // Membuat data kosong sebagai Relasi dari detail ke penjualan
            DetailSales::create([
                'customer' => null,
                'sub_total' => null,
                'status',
            ]);

            $receipt = DetailSales::where('status', 'Undone')->first();
            return view('sales.sales', compact('product', 'checkout', 'sub_total', 'receipt'));
        }
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
            $value = Product::where('id', $t->produk_id)->get();
            foreach ($value as $v) {
                $hasil = $v->stok_produk - $t->quantity_produk;

                Product::where('id', $t->produk_id)->update([
                    'stock' => $hasil
                ]);
                echo $hasil;
            }
        }
        //
        return redirect()->route('sales', $id);
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
