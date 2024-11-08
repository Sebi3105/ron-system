<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serial Numbers for {{ $inventoryitem->product_name }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <h1 class="text-2xl font-bold my-4">Serial Numbers for {{ $inventoryitem->product_name }}</h1>
    <div class="mb-4">
        <a href="{{ route('inventoryitem.create', ['product_id' => $inventoryitem->product_id]) }}" class="text-blue-500 hover:underline">Insert New Product Serial</a>
    </div>
    <form method="GET" action="{{ route('inventoryitem.serials', ['product_id' => $inventoryitem->product_id]) }}" class="mb-4">
        <input type="text" name="search" placeholder="Search Serial Number" value="{{ request('search') }}" class="border border-gray-300 p-2 rounded">
        <input type="submit" value="Search" class="bg-blue-500 text-black p-2 rounded hover:bg-blue-600">
        <a href="{{ route('inventoryitem.serials', ['product_id' => $inventoryitem->product_id]) }}" class="clear-search text-red-500 hover:underline ml-2">Clear Search</a>
    </form>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr class="bg-gray-200 text-gray-700">
                    <th class="py-2 px-4 border-b">SKU ID</th>
                    <th class="py-2 px-4 border-b">Serial Number</th>
                    <th class="py-2 px-4 border-b">Condition</th>
                    <th class="py-2 px-4 border-b">Created At</th>
                    <th class="py-2 px-4 border-b">Updated At</th>
                    <th class="py-2 px-4 border-b">Edit</th>
                    <th class="py-2 px-4 border-b">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($inventoryitem->inventoryItems as $item)
                    <tr class="text-gray-600">
                        <td class="py-2 px-4 border-b">{{ $item->sku_id }}</td>
                        <td class="py-2 px-4 border-b">{{ $item->serial_number }}</td>
                        <td class="py-2 px-4 border-b">{{ ucwords($item->condition) }}</td>
                        <td class="py-2 px-4 border-b">{{ $item->created_at }}</td>
                        <td class="py-2 px-4 border-b">{{ $item->updated_at }}</td>
                        <td class="py-2 px-4 border-b">
                            <a href="{{ route('inventoryitem.edit', ['inventoryitem' => $item->sku_id]) }}" class="text-blue-500 hover:underline" onclick="return confirmAction('Are you sure you want to edit this item?')">Edit</a>
                        </td>
                        <td class="py-2 px-4 border-b">
                            <form method="post" action="{{ route('inventoryitem.delete', ['inventoryitem' => $item->sku_id]) }}" class="text-red-500 hover:underline" onsubmit="return confirmAction('Are you sure you want to delete this item?')">Delete
                                @csrf
                                @method('delete')
                                <input type="submit" value="Delete" class="bg-red-500 text-white p-1 rounded hover:bg-red-600 cursor-pointer"/>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        <a href="{{ route('inventory.index') }}" class="text-blue-500 hover:underline">Back to Inventory</a>
    </div>
    <script src="{{ asset('js/confirmation.js') }}"></script>
</body>
</html>
