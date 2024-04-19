<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    @foreach ($product as $item)
    <form action="{{ route('update',$item->id) }}" method="post">
        @csrf   
        <div>
            <input type="text" name="name" class="form-control" value="{{$item->name}}" required>
        </div>
        <div>
            <input type="number" name="price" class="form-control" value="{{$item->price}}" required>
        </div>
        <div>
            <input type="number" name="stock" class="form-control" value="{{$item->stock}}" required>
        </div>

        <button type="submit">submit</button>
    </form>
    @endforeach

</body>
</html>