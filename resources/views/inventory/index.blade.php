<x-app-layout>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Inventory') }}
        </h2>
    </x-slot>
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

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="table overflow-x-auto">
        <table border="1" id="inventory">
            <thead class="bg-gray-200">
                <tr>
                    <th></th>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>Quantity</th>
                    <th>Released Date</th>
                    <th>Status</th>
                    <th>Actions</th>
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
                    {data: 'product_name', name: 'product_name'},
                    {data: 'category_name', name: 'category_name'},
                    {data: 'brand_name', name: 'brand_name'},
                    {data: 'quantity', name: 'quantity'},
                    {data: 'released_date', name: 'released_date'},
                    {data: 'status', name: 'status'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                rowCallback: function(row, data) {
                    // Apply yellow background if quantity is between 1 and 4
                    if (data.quantity <= 4) {
                        $(row).css('background-color', '#fff3cd');  // Light yellow color
                    }
                    // Apply red background if quantity is 1 or lower
                    else if (data.quantity <= 1) {
                        $(row).css('background-color', '#f8d7da');  // Light red color
                    }
                }
            });
                         // Edit button handling with confirmation
            $('#inventory tbody').on('click', '.btn-primary', function(e) {
                e.preventDefault(); // Prevent immediate redirect
                var editUrl = $(this).attr('href'); // Get the edit URL from the button's href
                if (confirm('Are you sure you want to edit this item?')) {
                    window.location.href = editUrl; // Redirect to the edit page if confirmed
                }
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
</x-app-layout>