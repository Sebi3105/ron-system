<x-app-layout>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tech Reports') }}
        </h2>
    </x-slot>

    <div class="success_pop mb-4">
        @if(session()->has('success'))
            <div class="bg-green-500 text-white p-2 rounded">
                {{ session('success') }}
            </div>
        @endif
    </div>

    <!-- Search form -->
    <form method="GET" action="{{ route('techreport.index') }}" class="mb-4">
        <input type="text" name="search" placeholder="Search by technician name or customer" value="{{ request()->input('search') }}" class="border rounded p-2">
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Search</button>
        <a href="{{ route('techreport.index') }}" class="bg-gray-200 text-black py-2 px-4 rounded">Clear Search</a>
    </form>

    <!-- Insert new report link -->
    <div class="create_link mb-2">
        <a href="{{ route('techreport.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded">Insert New Report</a>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="table overflow-x-auto">
                    <table border="1" id="techreport">
                        <thead class="bg-gray-200">
                            <tr>
                                <th>#</th>
                                <th>Report ID</th>
                                <th>Technician</th>
                                <th>Customer</th>
                                <th>Serial No.</th>
                                <th>Service ID</th>
                                <th>Completion Date</th>
                                <th>Payment Type</th>
                                <th>Payment Method</th>
                                <th>Status</th>
                                <th>Remarks</th>
                                <th>Cost</th>
                                <th>Created At</th>
                                <th>Updated At</th>
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
            var table = $('#techreport').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('techreport.index') }}",
                columns: [
                    {
                        data: null,
                        orderable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    { data: 'report_id', name: 'report_id' },
                    { data: 'technician_name', name: 'technician_name' },
                    { data: 'customer_name', name: 'customer_name' },
                    { data: 'serial_number', name: 'serial_number' },
                    { data: 'service_name', name: 'service_name' },
                    { data: 'date_of_completion', name: 'date_of_completion' },
                    { data: 'payment_type', name: 'payment_type' },
                    { data: 'payment_method', name: 'payment_method' },
                    { data: 'status', name: 'status' },
                    { data: 'remarks', name: 'remarks' },
                    { data: 'cost', name: 'cost' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'updated_at', name: 'updated_at' },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $('#techreport tbody').on('click', '.delete-btn', function() {
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
