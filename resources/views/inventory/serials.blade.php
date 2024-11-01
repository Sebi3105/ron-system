<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serial Numbers for {{ $inventoryitem->product_name }}</title>
</head>
<body>
    <h1>Serial Numbers for {{ $inventoryitem->product_name }}</h1>
    <div class="create_link">
        <a href="{{ route('inventoryitem.create') }}">Insert New Products</a>
    </div>
    <form method="GET" action="{{ route('inventoryitem.serials', ['product_id' => $inventoryitem->product_id]) }}">
        <input type="text" name="search" placeholder="Search Serial Number" value="{{ request('search') }}">
        <input type="submit" value="Search">
        <a href="{{ route('inventoryitem.serials', ['product_id' => $inventoryitem->product_id]) }}" class="clear-search">Clear Search</a>
    </form>

    <div class="table">
        <table border="1">
            <tr>
                <th>SKU ID</th>
                <th>Serial Number</th>
                <th>Condition</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            @foreach($inventoryitem->inventoryItems as $item)
                <tr>
                    <td>{{ $item->sku_id }}</td>
                    <td>{{ $item->serial_number }}</td>
                    <td>{{ ucwords($item->condition) }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->updated_at }}</td>
                    <td>
                        <a href="{{ route('inventoryitem.edit', ['inventoryitem' => $item->sku_id]) }}" onclick="return confirmAction('Are you sure you want to edit this item?')">Edit</a>
                    </td>
                    <td>
                        <form method="post" action="{{ route('inventoryitem.delete', ['inventoryitem' => $item->sku_id]) }}" onsubmit="return confirmAction('Are you sure you want to delete this item?')">
                            @csrf
                            @method('delete')
                            <input type="submit" value="Delete" />
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

    <div>
        <a href="{{ route('inventoryitem.index') }}">Back to Inventory</a>
    </div>
    <script src="{{ asset('js/confirmation.js') }}"></script>
</body>
</html>
