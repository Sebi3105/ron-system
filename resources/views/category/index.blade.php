<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Category</h1>
    <div class = "table">
        <table border = "1">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Created at</th>
                <th>Updated at</th>
            </tr>
            @foreach($categories as $category)
                <tr>
                    <td>{{$category->category_id}}</td>
                    <td>{{$category->category_name}}</td>
                    <td>{{$category->created_at}}</td>
                    <td>{{$category->updated_at}}</td>
                </tr>
            @endforeach
        </table>
</body>
</html>