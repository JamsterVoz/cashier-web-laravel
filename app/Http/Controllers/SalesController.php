<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\sales;
use App\Models\Product;
use App\Models\DetailSales;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::all();

        // Mengambil data barang yang sedang diproses atau belum di beli, baru dimasukan ke keranjang
        $checkout = DetailSales::where('status', 'Undone')->get();

        $sale = Sale::where('status', 'Undone')->get();
        // Menjumlahkan semua harga produk yang ada di keranjang
        $sub_total = Sale::where('status', 'Undone')->sum('total_price');
        // Mengambil id untuk relasi dari detail penjualan ke penjualan
        $receipt = DetailSales::where('status', 'Undone')->first();

        if($receipt){
            return view('checkout.checkout', compact('product', 'checkout', 'sub_total', 'receipt', 'sale'));
        }
        else{
            // Membuat data kosong sebagai Relasi dari detail ke penjualan
            DetailSales::create([
                'customer' => null,
                'sub_total' => null,
                'status',
            ]);

            $receipt = DetailSales::where('status', 'Undone')->first();
            return view('receipt.detail', compact('product', 'checkout', 'sub_total', 'receipt' , 'sale'));
        }
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
    public function store(Request $request, $id)
    {
        $max_stock = Sale::where('id', $id)->first();
        // dd($max_stok->produk->stok_produk, $request->quantity_produk);

        $data = [
            'stock_quantity' => 'required|numeric|max:'.$max_stock->product->stock,
        ];

        $rules = [
            'stock_quantity.max' => 'Stok yang tersedia hanya '.$max_stock->product->stock
        ];
        // dd($request->all());
        $validate = $request->validate($data, $rules);
        $quantity = $request->stock_quantity;
        $harga = Product::select('id', 'price')->where('id','=', $max_stock->product_id)->first();
        // dd($harga, $id);
        $total_price = $harga->price *  $quantity;
        // dd($total_harga);

        Sale::where('id', $id)->update([
            'stock_quantity' => $quantity,
            'total_price' => $total_price,
        ]);


        return redirect()->route('sales');
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
    public function destroy($id)
    {
        $item = Sale::findOrFail($id);

        //delete post
        $item->delete();

        //redirect to checkout
        return redirect()->route('sales');
    }
}
