@extends('layouts.layout')

@section('content')

    @if (Session::has('success'))
        <h1>{{ Session::get('success') }}</h1>
    @endif
<div class="container w-25 min-vh-100 d-flex justify-content-center align-items-center">
       
    <main class="form-signin w-100 m-auto text-center">
    <form action="{{ route('loginProcess') }}" method="post">
        @csrf
        <div class="form-floating mb-3">
            <input type="text" class="form-control" name="name" id="name" placeholder="asd">
            <label for="name">Name</label>
        </div>
        @error('name')
            <p>{{ $message }}</p>
        @enderror

        <div class="form-floating mb-3">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="asd">
        </div>
        @error('email')
            <p>{{ $message }}</p>
        @enderror
        
        <div class="form-floating mb-3">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="asd">
        </div>
        @error('password')
            <p>{{ $message }}</p>
        @enderror

        <div class="flex">
            <button type="submit" class="btn btn-primary">
                Submit
            </button>
        </div>
    </form>
    </main>
</div>

@endsection