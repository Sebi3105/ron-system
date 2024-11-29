<!--nabago -->
<x-app-layout>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <div class="flex flex-col md:flex-row h-screen  bg-gray-200 min-w-full">
        <div class="flex-1 ml-64 mt-0 min-h-screen">
            <!-- Content Section --> 
           <div class="max-w-7xl mx-auto px-4 sm:text-left lg:px-8 mt-4 mb-6">
                <!-- Header Inside Content -->
                <div class="relative pt-16">
                  <h1 class="text-2xl px-10 font-semibold text-gray-500 absolute top-5">Technician Report</h1>
                </div>

                <div class="max-w-7xl mx-auto px-4 sm:text-left lg:px-8 mt-6 mb-6 flex flex-col md:flex-row items-center justify-between">
                    <!-- Search Bar -->
                    <div class="flex-1 flex justify-start mb-4 md:mb-0">
                        <div class="relative w-4/5 md:w-4/5">
                            <input type="text" id="tableSearch" class="border border-gray-300 rounded-md pl-10 pr-4 py-2 w-full" placeholder="Search...">
                            <span class="absolute left-3 top-2.5 text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a7 7 0 100 14 7 7 0 000-14zM18 18l-3.5-3.5" />
                                </svg>
                            </span>
                        </div>
                    </div>

                    <!-- Buttons Section -->
                    <div class="flex items-center space-x-4 mb-4 md:mb-0">
                        <!-- Filter Button -->
                        <div class="relative">
                            <button id="filterButton" class="bg-gray-50 text-black py-2 px-6 rounded flex items-center space-x-2">
                                <!-- Filter Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
                                </svg>
                                <!-- Filter Text -->
                                <span class="font-bold">Filter</span>
                                <!-- Dropdown Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </div>

                    
                <div class="flex space-x-2">
                    <a href="{{ route('techprofile.create') }}" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600">+ Add Technician</a>
                    <a href="{{ route('service.create') }}" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600">+ Add Services</a>
                    <a href="{{ route('techreport.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">+ Add New Report</a>
                </div>
            </>
    <div class="success_pop mb-4">
        @if(session()->has('success'))
            <div class="bg-green-500 text-white p-2 rounded">
                {{ session('success') }}
            </div>
        @endif
    </div>

    <div class="mb-4">

    
                <select id="serviceFilter" class="border rounded p-2">
                    <option value="">Select Service</option>
                    @foreach($service as $srv)
                            <option value="{{ $srv->service_id }}">{{ $srv->service_name }}</option>
                        @endforeach
                </select>

                <select id="paymenttypeFilter" class="border rounded p-2">
                    <option value="">Select Payment Type</option>
                    @foreach($paymenttype as $type)
                            <option value="{{ $type }}">{{ ucfirst(str_replace('_', ' ', $type)) }}</option>
                        @endforeach
                </select>

                <select id="payment_methodFilter" class="border rounded p-2">
                    <option value="">Select Payment Method</option>
                    @foreach($paymentmethod as $method)
                            <option value="{{ $method }}">{{ ucfirst($method) }}</option>
                        @endforeach
                </select>

                <select id="statusFilter" class="border rounded p-2">
                    <option value="">Select Status</option>
                    <option value="in_progress">In Progress</option>
                    <option value="done">Done</option>
                    <option value="backjob">Backjob</option>
                </select>

                <button id="filterButton" class="bg-blue-500 text-white p-2 rounded">Filter</button>
                <button id="resetButton" class="bg-gray-500 text-white p-2 rounded">Reset</button>
            </div>

    





            
    <!-- Insert new report link -->

    <div class="py-4 overflow-auto max-h-[500px] max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="p-4 sm:p-8 bg-gray-200 shadow sm:rounded-lg overflow-y-auto">
        <div class="overflow-x-auto">
            <table id="techreport" class="min-w-full table-fixed bg-gray-200 text-black border border-gray-400">
                <thead class="bg-gray-300 border-b border-gray-400">
                    <tr>
                    <th class="w-12 p-2 border-r border-gray-400">#</th>
                            <th class="w-32 p-2 border-r border-gray-400">Report ID</th>
                            <th class="w-40 p-2 border-r border-gray-400">Technician</th>
                            <th class="w-32 p-2 border-r border-gray-400">Customer</th>
                            <th class="w-32 p-2 border-r border-gray-400">Serial No.</th>
                            <th class="w-32 p-2 border-r border-gray-400">Service</th>
                            <th class="w-32 p-2 border-r border-gray-400">Product</th>
                            <th class="w-24 p-2 border-r border-gray-400">Completion Date</th>
                            <th class="w-24 p-2 border-r border-gray-400">Payment Type</th>
                            <th class="w-24 p-2 border-r border-gray-400">Payment Method</th>
                            <th class="w-24 p-2 border-r border-gray-400">Status</th>
                            <th class="w-40 p-2 border-r border-gray-400 hide-column">Remarks</th>
                            <th class="w-24 p-2 border-r border-gray-400    hide-column">Cost</th>
                            <th class="w-32 p-2 border-r border-gray-400 hide-column">Created At</th>
                            <th class="w-32 p-2 border-r border-gray-400 hide-column">Updated At</th>
                            <th class="w-24 p-2">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-200">
                    <!-- Dynamic content will be injected here by DataTable -->
                </tbody>
            </table>
        </div>
    </div>
</div>


<div class="py-4 overflow-auto max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h2 class="text-xl font-semibold mb-2">Technician</h2>
    <div class="p-4 sm:p-8 bg-gray-200 shadow sm:rounded-lg">
        <table id="techprofile" class="min-w-full table-fixed bg-gray-200 text-black border border-gray-400">
            <thead class="bg-gray-300 border-b border-gray-400">
                <tr>
                    <th class="w-40 p-2 border-r border-gray-400">Technician Name</th>
                    <th class="w-40 p-2 border-r border-gray-400">Contact No</th> <!-- New column added -->
                    <th class="w-24 p-2">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-gray-200">
                @foreach($techprofile as $technician)
                    <tr>
                        <td class="p-2 border-r border-gray-400">{{ $technician->name }} </td>
                        <td class="p-2 border-r border-gray-400"> {{ $technician->contact_no ? '+63 ' . $technician->contact_no : 'N/A' }}</td> 
                        <td class="p-2">
                        <button class="bg-blue-500 text-white py-1 px-2 rounded edit-techprofile" data-url="{{ route('techprofile.edit', $technician) }}">Edit</button>
                            <button class="bg-red-500 text-white py-1 px-2 rounded delete-techprofile" data-url="{{ route('techprofile.delete', $technician->technician_id) }}">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

            



            <div class="py-4 overflow-auto max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-xl font-semibold mb-2">Services</h2>
                <div class="p-4 sm:p-8 bg-gray-200 shadow sm:rounded-lg">
                    <table id="service" class="min-w-full table-fixed bg-gray-200 text-black border border-gray-400">
                        <thead class="bg-gray-300 border-b border-gray-400">
                            <tr>
                                <th class="w-40 p-2 border-r border-gray-400">Services</th>
                                <th class="w-24 p-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-200">
                        @foreach($service as $services)
                                <tr>
                                    <td class="p-2 border-r border-gray-400">{{ $services->service_name }} </td>
                                    <td class="p-2">
                                        <button class="bg-red-500 text-white py-1 px-2 rounded delete-service" data-url="{{ route('service.delete', $services->service_id) }}">Delete</button>
                                    </td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>


    <script src="{{ asset('js/confirmation.js') }}"></script>

    <script>
        $(document).ready(function() {
            var table = $('#techreport').DataTable({
                processing: true,
                serverSide: true,
                // ajax: "{{ route('techreport.index') }}",
                ajax: {
                url: "{{ route('techreport.index') }}",
                data: function(d) {
                    d.status = $('#statusFilter').val();
                    d.paymenttype = $('#paymenttypeFilter').val();
                    d.service = $('#serviceFilter').val();  
                    d.paymentmethod = $('#payment_methodFilter').val(); 
                  
                }
            },
                columns: [
                    {
                        data: null,
                        orderable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    { data: 'report_id', 
                        name: 'report_id',
                         visible: false  },

                    { data: 'technician_name', name: 'technician_name' },
                    { data: 'customer_name', name: 'customer_name' },
                    { data: 'serial_number', name: 'serial_number' },
                    { data: 'service_name', name: 'service_name' },
                    { data: 'product_name', name: 'product_name' },
                    { data: 'date_of_completion', name: 'date_of_completion' },
                    { data: 'payment_type', name: 'payment_type' },
                    { data: 'payment_method',
                        name: 'payment_method',
                      
                    },

                    { data: 'status', 
                        name: 'status',
                     },

                    { data: 'remarks', 
                        name: 'remarks',
                            visible: false },
                    { data: 'cost', 
                        name: 'cost',
                         visible: false },
                    // { data: 'created_at', name: 'created_at' },
                    // { data: 'updated_at', name: 'updated_at' },

                    {
                        data: 'created_at', 
                        name: 'created_at',
                        visible: false,
                        render: function(data) {
                            return new Date(data).toLocaleString(); // Formats the date to local string
                        }
                    },
                    {
                        data: 'updated_at', 
                        name: 'updated_at',
                        visible: false,
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

            $('#filterButton').on('click', function() {
            table.ajax.reload(); // Reload the table with the new filter values
        });

        $('#resetButton').on('click', function() {
            $('#paymenttypeFilter').val('');
            $('#serviceFilter').val('');
            $('#statusFilter').val('');
            $('#payment_methodFilter').val('');
            table.ajax.reload(); // Reload the table without filters
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
      


            $('#techprofile').on('click', '.edit-techprofile', function() {
    var editUrl = $(this).data('url');
    window.location.href = editUrl; // Redirect to the edit page
});

            

        $('#techprofile').on('click', '.delete-techprofile', function() {
                var deleteUrl = $(this).data('url');
                if (confirm('Are you sure you want to delete this technician profile?')) {
                    $.ajax({
                        url: deleteUrl,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            alert('Item deleted successfully!');
                            window.location.href = "{{ route('techreport.index') }}";
                            table.ajax.reload();
                          

                        
                        },
                        error: function(xhr) {
                            console.log('Error deleting technician profile: ' + (xhr.responseJSON.message || 'An unexpected error occurred.'));
                        }
                    });
                }
            });

            $('#service').on('click', '.delete-service', function() {
        var deleteUrl = $(this).data('url');
        if (confirm('Are you sure you want to delete this item?')) {
            $.ajax({
                url: deleteUrl,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert('Item deleted successfully!');
                    window.location.href = "{{ route('techreport.index') }}";
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
