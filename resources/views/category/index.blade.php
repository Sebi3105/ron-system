<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Index</title>
</head>
<body>
    <h1>Category</h1>
    <div class="success_pop">
        @if(session()->has('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif
    </div>
    
    <form method="GET" action="{{ route('category.index') }}">
        <input type="text" name="search" placeholder="Search by category name" value="{{ request()->input('search') }}">
        <button type="submit">Search</button>
        <a href="{{ route('category.index') }}" class="clear-search">Clear Search</a>
    </form>

    <div class="create_link">
        <a href="{{ route('category.create') }}">Insert New Category</a>
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
            @foreach($categories as $item) <!-- Now using $categories -->
                <tr>
                    <td>{{ $item->category_id }}</td>
                    <td>{{ $item->category_name }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->updated_at }}</td>
                    <td>
                        <a href="{{ route('category.edit', ['category' => $item->category_id]) }}" onclick="return confirmAction('Are you sure you want to edit this item?')">Edit</a>
                    </td>
                    <td>
                        <form method="post" action="{{ route('category.delete', ['category' => $item]) }}" onsubmit="return confirmAction('Are you sure you want to delete this item?')">
                            @csrf
                            @method('delete')
                            <input type="submit" value="Delete" />
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

    <script src="{{ asset('js/confirmation.js') }}"></script>
</body>
</html>
