@extends('layouts.layout')

@section('content')
<form action="{{ Route('checkout') }}" method="post">
    @csrf
    <input type="disable" class="hidden" name="receipt_id" value="{{ $receipt->id }}" />
    <select class="form-select" name="product_id" id="" onchange="this.form.submit()">
        <option hidden selected>Tambah Produk</option>
    @foreach ($product as $item)
            <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
        @endforeach
    </select>
</form>

<div>
    @foreach ($sale as $item)
    <div class="card ecommerce-card">

        <div class="item-img">
            <img src="{{ asset('image/' . $item->product->image) }}"
                alt="img-placeholder" style="max-width: 150px; max-height: 150px"/>
        </div>

        <div class="card-body">
            <div class="item-name">
                <h6 class="mb-0"><a href="app-ecommerce-details.html"
                        class="text-body">{{ $item->product->name }}</a></h6>
                <span class="item-company">By <spanclass="manual-space text-primary fw-bold">Apple</spanclass=></span>
            </div>
            <span class="text-success mb-1">
                Stock:<span class="manual-space">{{ $item->product->stock }}</span>
            </span>

            <div class="item-quantity">
                <span class="quantity-title me-1">Quantity:</span>
                <div class="quantity-counter-wrapper">
                    <form action="{{ Route('quantity', [$item->id]) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="input-group quantity-input">
                            <input type="number" class="form-control text-center"
                                name="product_quantity"
                                value="{{ $item->product_quantity }}" min="1" max="{{ $item->product->product_quantity }}"
                                onkeyup="enforceMinMax(this)" onchange="this.form.submit()" />
                        </div>
                    </form>
                </div>
            </div>

                    <div class="item-wrapper">
                        <div class="item-cost">
                            <h4 class="item-price">Rp {{ number_format($item->product->price, 2, ',', '.') }}</h4>
                        </div>
                    </div>
                    <form action="{{ Route('deleteSales', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-light mt-1 w-100">
                            <i data-feather="x" class="align-middle me-25"></i>
                            <span>Remove</span>
                        </button>
                    </form>
        </div>
    </div>
    @endforeach
</div>

<form action="{{ route('transaction',$receipt->id) }}" method="post">
    @csrf
    @method("PATCH")
    <input type="text" name="customer">
    <button type="submit">
        Submit
    </button>
</form>
@endsection