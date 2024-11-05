<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .low-amount {
            background-color: #ffdddd; /* light red */
        }
        .very-low-amount {
            background-color: #ffcccc; /* darker red */
        }
    </style>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
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
        <table border="1" id="inventory">
            <thead>
                <tr>
                    <th></th>
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
                    <th>Actions</th>
                </tr>
            </thead>
           <tbody></tbody>
        </table>
    </div>
    <script src="{{ asset('js/confirmation.js') }}"></script>

    <script>
        $(document).ready(function(){
            var table = $('#inventory').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('inventory.index') }}",
                columns: [
                    {
                        data: null,         // No data source since we're generating the index ourselves
                        orderable: false,  // disable sorting on this column
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1; // index number increment
                        }
                    },
                    {data: 'product_id', name: 'product_id'},
                    {data: 'category_name', name: 'category_name'},
                    {data: 'brand_name', name: 'brand_name'},
                    {data: 'product_name', name: 'product_name'},
                    {data: 'quantity', name: 'quantity'},
                    {data: 'released_date', name: 'released_date'},
                    {data: 'status', name: 'status'},
                    {data: 'notes', name: 'notes'},
                    {
                        data: 'created_at', 
                        name: 'created_at',
                        render: function(data) {
                            return new Date(data).toLocaleString(); // Formats the date to local string
                        }
                    },
                    {
                        data: 'updated_at', 
                        name: 'updated_at',
                        render: function(data) {
                            return new Date(data).toLocaleString(); // Formats the date to local string
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $('#inventory tbody').on('click', '.delete-btn', function() {
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
