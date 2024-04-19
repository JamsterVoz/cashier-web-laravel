@extends('layouts.layout')

@section('content')
<>
    
    @if(session()->has('success'))
    <p>
        {{ session()->get('success') }}
    </p>
@endif

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

    <form action="{{ route('productCreate') }}" method="post">
        @csrf
        <div>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div>
            <input type="number" name="price" class="form-control" required>
        </div>
        <div>
            <input type="number" name="stock" class="form-control" required>
        </div>

        <button type="submit">submit</button>
        <a href="{{ route('productview') }}">back</a>
    </form>
@endsection