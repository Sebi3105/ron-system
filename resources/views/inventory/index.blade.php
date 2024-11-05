<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Inventory</title>
</head>
<body>
    {{-- Include the navigation --}}
    @include('layouts.navigation')

    <h1 class="text-2xl font-bold mb-4">Inventory</h1>
    <div class="success_pop mb-4">
        @if(session()->has('success'))
            <div class="bg-green-500 text-white p-2 rounded">
                {{ session('success') }}
            </div>
        @endif
    </div>
    <div class="create_link mb-2">
        <a href="{{ route('inventory.create') }}" class="bg-blue-500 text-blue-500 py-2 px-4 rounded">Insert New Products</a>
    </div>
    
    <form method="GET" action="{{ route('inventory.index') }}" class="mb-4">
        <input type="text" name="search" placeholder="Search by product name" value="{{ request()->input('search') }}" class="border border-gray-300 rounded p-2">
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Search</button>
        <a href="{{ route('inventory.index') }}" class="clear-search text-blue-500">Clear Search</a>
    </form>

    <div class="overflow-x-auto">
        <table class="min-w-full border border-blue-300">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border px-4 py-2">Product ID</th>
                    <th class="border px-4 py-2">Category Name</th>
                    <th class="border px-4 py-2">Brand Name</th>
                    <th class="border px-4 py-2">Product Name</th>
                    <th class="border px-4 py-2">Quantity</th>
                    <th class="border px-4 py-2">Released Date</th>
                    <th class="border px-4 py-2">Status</th>
                    <th class="border px-4 py-2">Notes</th>
                    <th class="border px-4 py-2">Created At</th>
                    <th class="border px-4 py-2">Updated At</th>
                    <th class="border px-4 py-2">View</th>
                    <th class="border px-4 py-2">Edit</th>
                    <th class="border px-4 py-2">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($inventory as $item)
                    <tr class="@if($item->quantity <= 4 && $item->quantity > 1) bg-yellow-100 @elseif($item->quantity <= 1) bg-red-100 @endif">
                        <td class="border px-4 py-2">{{ $item->product_id }}</td>
                        <td class="border px-4 py-2">{{ $item->category ? $item->category->category_name : 'N/A' }}</td>
                        <td class="border px-4 py-2">{{ $item->brand ? $item->brand->brand_name : 'N/A' }}</td>
                        <td class="border px-4 py-2">{{ $item->product_name }}</td>
                        <td class="border px-4 py-2">{{ $item->quantity }}</td>
                        <td class="border px-4 py-2">{{ $item->released_date }}</td>
                        <td class="border px-4 py-2">{{ strtoupper($item->status) }}</td>
                        <td class="border px-4 py-2">{{ $item->notes }}</td>
                        <td class="border px-4 py-2">{{ $item->created_at }}</td>
                        <td class="border px-4 py-2">{{ $item->updated_at }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('inventoryitem.serials', ['product_id' => $item->product_id]) }}" class="text-blue-500">View Serial Numbers</a>
                        </td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('inventory.edit', ['inventory' => $item->product_id]) }}" class="text-blue-500" onclick="return confirmAction('Are you sure you want to edit this item?')">Edit</a>
                        </td>
                        <td class="border px-4 py-2">
                            <form method="post" action="{{ route('inventory.delete', ['inventory' => $item->product_id]) }}" class="text-red-500" onsubmit="return confirmAction('Are you sure you want to delete this item?')">Delete
                                @csrf
                                @method('delete')
                                <input type="submit" value="Delete" class="bg-red-500 text-white">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="{{ asset('js/confirmation.js') }}"></script>
</body>
</html>
