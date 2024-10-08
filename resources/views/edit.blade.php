@extends('layouts.layout')

@section('content')
    @foreach ($product as $item)
    <form action="{{ route('update',$item->id) }}" method="post" enctype="multipart/form-data">
        @csrf   
    <div class="form-group">
        <div>
            <input type="text" name="name" class="form-control" value="{{$item->name}}" required>
        </div>
        <div>
            <input type="number" name="price" class="form-control" value="{{$item->price}}" required>
        </div>
        <div>
            <input type="number" name="stock" class="form-control" value="{{$item->stock}}" required>
        </div>
        <div>
            <input class="form-control" type="file" name="image" value="{{ asset('image/'.$item->image) }}" />
        </div>

        <button type="submit">submit</button>
    </form>
    </div>
    @endforeach
@endsection