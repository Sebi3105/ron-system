<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Insert a Category</h1>
    <form method ="post" action="{{route('category.store')}}">
    @csrf 
    @method('post')
    <div class = "category_name">
        <label>Category Name</label>
        <input type = "category_name" name = "category_name" placeholder="Category Name" />
    </div>
    <div class = "submit">
        <input type = "submit" value = "Save Category">
    </div>
    </form>
</body>
</html>