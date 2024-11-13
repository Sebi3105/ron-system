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
        <a href="{{ route('inventoryitem.create', ['product_id' => $inventoryitem->product_id]) }}" class="bg-blue-500 text-black-500 py-2 px-4 rounded hover:underline">Insert New Product Serial</a>
    </div>

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
                    url: "{{ route('inventoryitem.serials', $product_id) }}",
                },
                columns: [
                    {
                        data: null,
                        orderable: false,
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
            // Delete button handling
            $('#serials tbody').on('click', '.delete-btn', function() {
                var deleteUrl = $(this).data('url'); // Get the delete URL from the button
                console.log('Delete URL:', deleteUrl); // Debug log for delete URL
                if (confirm('Are you sure you want to delete this item?')) {
                    $.ajax({
                        url: deleteUrl,
                        type: 'DELETE', // DELETE request
                        data: {
                            _token: '{{ csrf_token() }}' // CSRF token
                        },
                        success: function(response) {
                            alert('Item deleted successfully!');
                            table.ajax.reload(); // Reload DataTable to reflect changes
                        },
                        error: function(xhr) {
                            console.log('Error deleting item: ' + (xhr.responseJSON.message || 'An unexpected error occurred.'));
                        }
                    });
                }
            });
        });

    </script>
</body>
</html>
