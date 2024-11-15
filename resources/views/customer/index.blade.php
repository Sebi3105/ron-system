<x-app-layout>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Customers') }}
        </h2>
    </x-slot>

    <div class="success_pop mb-4">
        @if(session()->has('success'))
            <div class="bg-green-500 text-white p-2 rounded">
                {{ session('success') }}
            </div>
        @endif
    </div>

    <!-- Insert new customer link -->
    <div class="create_link mb-2">
        <a href="{{ route('customer.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded">Create New Customer Profile</a>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="table overflow-x-auto">
                    <table border="1" id="customer">
                        <thead class="bg-gray-200">
                            <tr>
                                <th>#</th>
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
            </div>
        </div>
    </div>

    <script src="{{ asset('js/confirmation.js') }}"></script>

    <script>
        $(document).ready(function() {
            var table = $('#customer').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('customer.index') }}", // Ensure this is the correct route
                columns: [
                    {
                        data: null,
                        orderable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
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
                e.preventDefault();
                var editUrl = $(this).attr('href');
                if (confirm('Are you sure you want to edit this item?')) {
                    window.location.href = editUrl;
                }
            });

            // Delete button handling with confirmation
            $('#customer tbody').on('click', '.delete-btn', function() {
                var deleteUrl = $(this).data('url');
                if (confirm('Are you sure you want to delete this item?')) {
                    $.ajax({
                        url: deleteUrl,
                        type: 'DELETE',
                        data: { _token: '{{ csrf_token() }}' },
                        success: function(response) {
                            alert('Item deleted successfully!');
                            table.ajax.reload();
                        },
                        error: function(xhr) {
                            console.log('Error deleting item: ' + (xhr.responseJSON.message || 'An unexpected error occurred.'));
                        }
                    });
                }
            });
        });
    </script>
</x-app-layout>
