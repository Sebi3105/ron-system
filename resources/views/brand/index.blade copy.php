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
    <form method="GET" action="{{ route('brand.index') }}">
        <input type="text" name="search" placeholder="Search by name" value="{{ request()->input('search') }}">
        <button type="submit">Search</button>
        <a href="{{ route('brand.index') }}" class="clear-search">Clear Search</a>
    </form>
    <div class = "create_link">
        <a href = "{{route('brand.create')}}">Insert New Brand</a>
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
                        <a href="{{ route('brand.edit', ['brand' => $brand->brand_id]) }}" onclick="return confirmAction('Are you sure you want to edit this item?')">Edit</a> <!-- Pass the ID directly -->
                    </td>
                    <td>
                        <form method = "post" action = "{{route('brand.delete',['brand' => $brand])}}" onsubmit="return confirmAction('Are you sure you want to delete this item?')">
                            @csrf
                            @method('delete')
                            <input type = "submit" value = "Delete" />
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <script src="{{ asset('js/confirmation.js') }}"></script>
</body>
</html>
