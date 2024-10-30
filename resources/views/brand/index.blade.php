<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Brand</h1>
    <div class = "success_pop">
        @if(session()->has('success'))
        <div class = "success">
            {{session('success')}}
        </div>
        @endif
    </div>
    <div class = "create_link">
        <a href = "{{route('brand.create')}}">Insert Brand</a>
    </div>
    </div>
    <div class="table">
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
            @foreach($brands as $brand)
                <tr>
                    <td>{{ $brand->brand_id }}</td> <!-- Use $brand->id for the ID -->
                    <td>{{ $brand->brand_name }}</td>
                    <td>{{ $brand->created_at }}</td>
                    <td>{{ $brand->updated_at }}</td>
                    <td>
                        <a href="{{ route('brand.edit', ['brand' => $brand->brand_id]) }}">Edit</a> <!-- Pass the ID directly -->
                    </td>
                    <td>
                        <form method = "post" action = "{{route('brand.delete',['brand' => $brand])}}">
                            @csrf
                            @method('delete')
                            <input type = "submit" value = "Delete" />
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</body>
</html>
