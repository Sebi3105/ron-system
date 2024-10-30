<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Update Brands</h1>
    <div class = "error_checking">
        @if($errors->any())
        <ul>
            @foreach($errors->all as $error)
                <li>{{$error}}</li>

            @endforeach
        </ul>



        @endif
    </div>
    <form method = "post" action="{{route('brand.update', ['brand' => $brand])}}">
    @csrf 
    @method('put')
    <div class = "brand_name">
        <label>Update Brand</label>
        <input type = "brand_name" name = "brand_name" placeholder="Brand Name" value = "{{$brand->brand_name}}"/>
    </div>
    <div class = "submit">
        <input type = "submit" value = "Update Brand">
    </div>
    </form>
</body>
</html>