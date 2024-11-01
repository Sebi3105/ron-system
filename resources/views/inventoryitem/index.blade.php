<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Inventory Items</h1>
    <div class="success_pop">
        @if(session()->has('success'))
        <div class="success">
            {{ session('success') }}
        </div>
        @endif
    </div>
    <div class="create_link">
        <a href="{{ route('inventoryitem.create') }}">Insert New Products</a>
    </div>
    <div class="table">
        <table border="1">
            <tr>
                <th>SKU ID</th>
                <th>Product Name</th>
                <th>Serial Number</th>
                <th>Condition</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->sku_id }}</td>
                    <td>{{ $product->inventory->product_name }}</td> <!-- Correctly access product name through the relationship -->
                    <td>{{ $product->serial_number }}</td>
                    <td>{{ ucwords($product->condition)}}</td>
                    <td>{{ $product->created_at }}</td>
                    <td>{{ $product->updated_at }}</td>
                    <td>
                        <a href="{{ route('inventoryitem.edit', ['products' => $product->sku_id]) }}" onclick="return confirmAction('Are you sure you want to edit this item?')">Edit</a> <!-- Use $product here -->
                    </td>
                    <td>
                        <form method="post" action="{{ route('inventoryitem.delete', ['products' => $product->sku_id])}}" onsubmit="return confirmAction('Are you sure you want to delete this item?')"> <!-- Use $product here -->
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
