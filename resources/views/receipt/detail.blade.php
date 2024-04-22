@extends('layouts.layout')

@section('content')
<div class="mt-md-0 mt-2">
    <h4 class="invoice-title">
        Invoice
        <span class="invoice-number">#{{ $data->id }}</span>
    </h4>
    <div class="invoice-date-wrapper">
        <p class="invoice-date-title">Created At:</p>
        <p class="invoice-date">{{ $data->created_at }}</p>
    </div>
    <div class="invoice-date-wrapper">
        <p class="invoice-date-title">Updated At:</p>
        <p class="invoice-date">{{  $data->updated_at }}</p>
    </div>
</div>
<div class="row invoice-spacing">
    <div class="col-xl-8 p-0">
        <h6 class="mb-2">Invoice To:</h6>
        <h6 class="mb-25">{{ $data->customer }}</h6>
    </div>
</div>

<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th class="py-1">Produk Name</th>
                <th class="py-1">Price</th>
                <th class="py-1">Quantity</th>
                <th class="py-1">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data_product as $item)
                <tr>
                    <td class="py-1">
                        <p class="card-text fw-bold mb-25">{{ $item->product->name }}</p>
                    </td>
                    <td class="py-1">
                        <span class="fw-bold">Rp {{ number_format($item->product->price, 2, ',', '.') }}</span>
                    </td>
                    <td class="py-1">
                        <span class="fw-bold">{{ $item->stock_quantity}}</span>
                    </td>
                    <td class="py-1">
                        <span class="fw-bold">Rp {{ number_format($item->total_price, 2, ',', '.') }}</span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection