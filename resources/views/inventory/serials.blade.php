<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serial Numbers for {{ $inventoryitem->product_name }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

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
        <table id="serials" class="min-w-full bg-white border border-gray-300">
            <thead class="bg-gray-200 text-gray-700">
                <tr>

                    <th class="py-2 px-4 border-b">SKU ID</th>
                    <th class="py-2 px-4 border-b">Serial Number</th>
                    <th class="py-2 px-4 border-b">Condition</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    <div class="mt-4">
        <a href="{{ route('inventory.index') }}" class="text-blue-500 hover:underline">Back to Inventory</a>
    </div>
    <script src="{{ asset('js/confirmation.js') }}"></script>

    <script>
        $(document).ready(function(){
            var productId = "{{ $product_id }}";
            
            var table = $('#serials').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('/inventory') }}/" + productId + "/serials",
                    
                },
                columns: [
                    {
                        data: null,         // No data source since we're generating the index ourselves
                        orderable: false,  // disable sorting on this column
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1; // index number increment
                    }
                    },
                    {data: 'serial_number', name: 'serial_number'},
                    {data: 'condition', name: 'condition'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                
            });

            $('#serials tbody').on('click', '.delete-btn', function() {
                var deleteUrl = $(this).data('url'); // Get the delete URL from the button
                console.log('Delete URL:', deleteUrl); // Debug log for delete URL
                if (confirm('Are you sure you want to delete this item?')) {
                    $.ajax({
                        url: deleteUrl,
                        type: 'DELETE', // Ensure this is DELETE
                        data: {
                            _token: '{{ csrf_token() }}' // CSRF token for security
                        },
                        success: function(response) {
                            alert('Item deleted successfully!'); // Success message
                            table.ajax.reload(); // Reload DataTable to reflect changes
                        },
                        error: function(xhr) {
                            console.log('Error deleting item: ' + (xhr.responseJSON.message || 'An unexpected error occurred.'));
                        }
                    });
                }
            });
        })
    </script>
</body>
</html>
