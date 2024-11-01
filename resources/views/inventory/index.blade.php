<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
</head>
<body>
    <h1>Inventory</h1>
    <div class="success_pop">
        @if(session()->has('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif
    </div>
    <div class="create_link">
        <a href="{{ route('inventory.create') }}">Insert New Products</a>
    </div>
    
    <form method="GET" action="{{ route('inventory.index') }}">
        <input type="text" name="search" placeholder="Search by product name" value="{{ request()->input('search') }}">
        <button type="submit">Search</button>
        <a href="{{ route('inventory.index') }}" class="clear-search">Clear Search</a>
    </form>

    <div class="table">
        <table border="1">
            <tr>
                <th>Product ID</th>
                <th>Category Name</th>
                <th>Brand Name</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Released Date</th>
                <th>Status</th>
                <th>Notes</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>View</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            @foreach($inventory as $item)
                <tr>
                    <td>{{ $item->product_id }}</td>
                    <td>{{ $item->category ? $item->category->category_name : 'N/A' }}</td>
                    <td>{{ $item->brand ? $item->brand->brand_name : 'N/A' }}</td>
                    <td>{{ $item->product_name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->released_date }}</td>
                    <td>{{ strtoupper($item->status) }}</td>
                    <td>{{ $item->notes }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->updated_at }}</td>
                    <td>
                        <a href="{{ route('inventoryitem.serials', ['product_id' => $item->product_id]) }}">View Serial Numbers</a>
                    </td>
                    <td>
                        <a href="{{ route('inventory.edit', ['inventory' => $item->product_id]) }}" onclick="return confirmAction('Are you sure you want to edit this item?')">Edit</a>
                    </td>
                    <td>
                        <form method="post" action="{{ route('inventory.delete', ['inventory' => $item->product_id]) }}" onsubmit="return confirmAction('Are you sure you want to delete this item?')">
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
