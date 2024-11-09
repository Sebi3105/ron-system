<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
        function confirmAction(message) {
            return confirm(message);
        }
    </script>
</head>
<body>
    <h1>Insert a Category</h1>
    <div class = "error_checking">
        @if($errors->any())
        <ul>
            @foreach($errors->all as $error)
                <li>{{$error}}</li>

            @endforeach
        </ul>



        @endif
    </div>
    <form method ="post" action="{{route('category.update',['category' => $category])}}" onsubmit="return confirmAction('Are you sure you want to save these changes')">
    @csrf 
    @method('put')
    <div class = "category_name">
        <label>Category Name</label>
        <input type = "category_name" name = "category_name" placeholder="Category Name" value = "{{$category->category_name}}"/>
    </div>
    <div class = "submit">
        <input type = "submit" value = "Update Category">
    </div>
    </form>
</body>
</html>