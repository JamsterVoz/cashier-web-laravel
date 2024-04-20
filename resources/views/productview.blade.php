@extends('layouts.layout')

@section('content')
  <a href="{{ route('product') }}">
    create
  </a>
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
          <a href="{{ url('product/delete/'.$item->id) }}" class="btn btn-danger">Delete</a>
        </td>
      </tr>

    </tbody>

  @endforeach
    </table>
  </div>
@endsection