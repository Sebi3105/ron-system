<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="w-64 fixed top-0 left-0 z-10 h-screen">
            @include('layouts.navigation') 
        </div>

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
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="table overflow-x-auto">
    <div border=""1" id ="inventory_item">
        <thead class = "bg-gray-200">
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
            </thead>
            <tbody></tbody>
        </table>
        </div>
            </div>
                  </div>
                      </div>
    <script src="{{ asset('js/confirmation.js') }}"></script>
    <script>
    $(document).ready(function(){
        var table = $('#inventory_item').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('inventoryitem.serials') }}",
            columns: [
                {
                    data: null,
                    orderable: false,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1; // index number increment
                    }
                },
                {data: 'sku_id', name: 'sku_id'},
                {data: 'serial_number', name: 'serial_number'},
                {data: 'condition', name: 'condition'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        // Edit button handling with confirmation
        $('#inventory_item tbody').on('click', '.edit-btn', function(e) {
            e.preventDefault();
            var editUrl = $(this).attr('href');
            if (confirm('Are you sure you want to edit this item?')) {
                window.location.href = editUrl;
            }
        });

        // Delete button handling
        $('#inventory_item tbody').on('click', '.delete-btn', function() {
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
    });
</script>
</body>
</html>