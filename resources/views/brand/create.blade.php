<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Insert a Brand</h1>
    <form method = "post" action="{{route('brand.store')}}">
    @csrf 
    @method('post')
    <div class = "brand_name">
        <label>Brand Name</label>
        <input type = "brand_name" name = "brand_name" placeholder="Brand Name" />
    </div>
    <div class = "submit">
        <input type = "submit" value = "Save Brand">
    </div>
    </form>
</body>
</html>