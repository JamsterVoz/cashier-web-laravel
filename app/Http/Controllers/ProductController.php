<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function test()
    {
        return view('test');
    }

    public function productview()
    {
        $product = Product::all();
        return view('productview', compact('product'));
    }

    public function index()
    {
        return view('product');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if (Product::where('name', $request->name)->exists()){
            return redirect()->route('productView');
        }else{
            $photo = $request->image->getClientOriginalName();
            $request->image->move(public_path('image'), $photo);
    
            $data = Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'stock' => $request->stock,
                'image' => $photo,
            ]);
        }

        return redirect()->back()->with('success', 'Success Create Product!');
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
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product, $id)
    {
        $product = Product::select('*')->where('id', $id)->get();

        return view('edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = Product::find($id);

        $data->update([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        if($request->image != ''){
            $path = public_path().'/image/';

            //code for remove old file
            if($data->image != ''  && $data->image != null){
                 $file_old = $path.$data->image;
                 unlink($file_old);
            }

            //upload new file
            $file = $request->image;
            $filename = $file->getClientOriginalName();
            $file->move($path, $filename);

            //for update in table
            $data->update(['image' => $filename]);
       }


        return redirect()->route('productview');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product, $id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect()->route('productview');
    }
}
