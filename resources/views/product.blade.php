<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
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

    <form action="/productCreate" method="post">
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
    </form>
</body>
</html>