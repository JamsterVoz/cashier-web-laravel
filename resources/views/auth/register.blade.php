@extends('layouts.layout')

@section('content')
<div class="container w-25 min-vh-100 d-flex justify-content-center align-items-center">
       
    <main class="form-signin w-100 m-auto text-center">
    <form action="{{ route('registerProcess') }}" method="post">
        @csrf
        <div class="form-floating mb-3">
            <input type="text" class="form-control" name="name" id="name" placeholder="asd">
            <label for="name">Name</label>
        </div>

        <div class="form-floating mb-3">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="asd">
        </div>
        
        <div class="form-floating mb-3">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="asd">
        </div>

        <div class="flex">
            <button type="submit" class="btn btn-primary">
                Submit
            </button>
        </div>
        <a href="{{ url('login') }}">
            Login
        </a>
    </form>
    </main>
</div>

@endsection