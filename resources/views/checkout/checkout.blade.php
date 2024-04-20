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

<form action="{{ route('transaction',$receipt->id) }}" method="post">
    @csrf
    @method("PATCH")
    <input type="text" name="customer">
    <button type="submit">
        Submit
    </button>
</form>
@endsection