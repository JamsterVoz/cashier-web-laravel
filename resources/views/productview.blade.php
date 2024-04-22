@extends('layouts.layout')

@section('content')
  <div>
    <a href="{{ route('product') }}">
      create
    </a>
  </div>
  <div>
    <a href="{{ route('sales') }}">
      checkout
    </a>
  </div>
  
  <div class="container d-flex justify-content-center align-items-center">
    <table class="table table-bordered">
      <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Foto</th>
        <th scope="col">Name</th>
        <th scope="col">Price</th>
        <th scope="col">Stock</th>
        <th scope="col">Action</th>
      </tr>
      </thead>

  @foreach ($product as $item)

    <tbody>
      <tr>
        <th scope="row">{{ $item->id }}</th>
        <td><img src="{{ asset('image/'.$item->image) }}" alt="" style="max-width: 150px"></td>
        <td>{{ $item->name }}</td>
        <td>{{ $item->price }}</td>
        <td>{{ $item->stock }}</td>
        <td>
          <a href="{{ url('product/edit/'.$item->id) }}" class="btn btn-primary">Edit Product</a>
          <form action="{{ url('product/delete/'.$item->id) }}"  method="post">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" type="submit">Delete</button>
          </form>
        </td>
      </tr>

    </tbody>

  @endforeach
    </table>
  </div>
@endsection