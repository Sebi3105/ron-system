<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
</head>
<body>
    <h1>Customers</h1>
    <div class = "success_pop">
        @if(session()->has('success'))
        <div class = "success">
            {{session('sucess')}}
        </div>
        @endif
    </div>
    <div class = "create_link">
        <a href = "{{route('customer.create')}}">Create new Customer Profile</a>
    </div>
    <div class = "table">
        <table border = "1" id="customer">
            <thead>
                <tr>
                    <th></th>
                    <th>Customer ID</th>
                    <th>Customer Name</th>
                    <th>Address</th>
                    <th>Contact No.</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody></tbody>
    </table>
    </div>
    <script src="{{ asset('js/confirmation.js') }}"></script>
    <script>
        $(document).ready(function() {
            var table = $('#customer').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('customer.index') }}",  // Ensure this is the correct route
                columns: [
                    {
                        data: null,         // No data source since we're generating the index ourselves
                        orderable: false,  // Disable sorting on this column
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1; // Index number increment
                        }
                    },
                    { data: 'customer_id', name: 'customer_id' },
                    { data: 'name', name: 'name' },
                    { data: 'address', name: 'address' },
                    { data: 'contact_no', name: 'contact_no' },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            // Edit button handling with confirmation
            $('#customer tbody').on('click', '.btn-primary', function(e) {
                e.preventDefault(); // Prevent immediate redirect
                var editUrl = $(this).attr('href'); // Get the edit URL from the button's href
                if (confirm('Are you sure you want to edit this item?')) {
                    window.location.href = editUrl; // Redirect to the edit page if confirmed
                }
            });

            // Delete button handling with confirmation
            $('#customer tbody').on('click', '.delete-btn', function() {
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