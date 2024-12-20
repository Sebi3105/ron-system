<!--nabago -->
<x-app-layout>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>


    <div class="flex flex-col md:flex-row h-screen  bg-gray-200 min-w-full">
        <div class="flex-1 ml-64 mt-0 min-h-screen bg-gray-200">
            <!-- Content Section --> 
           <div class="max-w-7xl mx-auto px-4 sm:text-left lg:px-8 mt-4 mb-6 bg-gray-200">
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
                            <button id="filterButton" class="bg-gray-50 text-black mr-2 py-2 px-6 rounded flex items-center space-x-2">
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
                    <!-- Filter Dropdown -->
                    <div id="filterDropdown" class="hidden absolute bg-white shadow-lg rounded-lg mt-2 p-4 w-64 z-50">
                            <div class="mb-4">
                                <!-- Service Filter-->
                                <label for="serviceFilter" class="block text-sm font-medium text-gray-700">Select Service</label>
                                <select id="serviceFilter" class="w-full border rounded     p-2">
                                    <option value="">Select Service</option>
                                    @foreach($service as $srv)
                                        <option value="{{ $srv->service_id }}">{{ $srv->service_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <!-- Payment Type Filter -->
                                <label for="paymenttypeFilter" class="block text-sm font-medium text-gray-700">Select Payment Type</label>
                                <select id="paymenttypeFilter" class="w-full border rounded p-2">
                                    <option value="">Select Payment Type</option>
                                    @foreach($paymenttype as $type)
                                        <option value="{{ $type }}">{{ ucfirst(str_replace('_', ' ', $type)) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <!-- Status Filter -->
                                <label for="statusFilter" class="block text-sm font-medium text-gray-700">Select Status</label>
                                <select id="statusFilter" class="w-full border rounded p-2">
                                    <option value="">Select Status</option>
                                    <option value="in_progress">In Progress</option>
                                    <option value="done">Done</option>
                                    <option value="backjob">Backjob</option>
                                </select>
                            </div>
                        
                            <div class="flex space-x-2">
                                <button id="applyFilter" class="bg-blue-500 text-white py-2 px-4 rounded">Apply</button>
                                <button id="resetFilter" class="bg-gray-500 text-white py-2 px-4 rounded">Reset</button>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-start space x-4  mb-4 md:mb-0">
                        <!-- Action Buttons -->
                        <a href="{{ route('techprofile.create') }}" class="bg-red-500 text-white py-2 px-4 mr-2 rounded hover:bg-red-600">+ Add Technician</a>
                        <a href="{{ route('service.create') }}" class="bg-custom-green text-white py-2 px-4 mr-2 rounded hover:bg-green-600">+ Add Services</a>
                        <a href="{{ route('techreport.create') }}" class="bg-navy-blue text-white py-2 px-4 rounded hover:bg-navyblue">+ Add New Report</a>
                    </div>
                </div>
            </div>    
            
            
            <div class="success_pop mb-4">
                    @if(session()->has('success'))
                    <div class="bg-green-500 text-white p-2 rounded">
                        {{ session('success') }}
                    </div>
                    @endif
                </div>
            <!-- Tables -->
<div class="table-container py-4  max-w-7xl mx-auto px-4 sm:text-left lg:px-8 bg-gray-200">
    <div class="p-4 sm:text-left bg-gray-200">
        <div>
            <table id="techreport" class="min-w-full tab le-auto bg-gray-200 text-gray-500">
                <thead class="text-gray-500 bg-gray-200">
                    <tr class="text-center">
                        <th class="w-10 p-1 border-r border-gray-200">#</th>
                        <th class="w-20 p-1 border-r border-gray-200">Technician</th>
                        <th class="w-20 p-1 border-r border-gray-200">Customer</th>
                        <th class="w-20 p-1 border-r border-gray-200">Serial No.</th>
                        <th class="w-16 p-1 border-r border-gray-200">Service</th>
                        <th class="w-16 p-1 border-r border-gray-200">Product</th>
                        <th class="w-20 p-1 border-r border-gray-200">Payment Type</th>
                        <th class="w-20 p-1 border-r border-gray-200">Status</th>
                        <th class="w-18 p-1">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-200">
                    <!-- Dynamic content will be injected here by DataTable --> 
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="table-container py-4  max-w-7xl mx-auto px-4 sm:text-left lg:px-8 bg-gray-200">
    <div class="p-4 sm:text-left grid grid-cols-1 md:grid-cols-2 gap-10">
           <!-- Technician -->
           <div class="table-container w-full bg-gray-200">
             <h3 class="text-2xl font-semibold mb-2 text-left text-gray-500">Technician</h3>
             <table id="techprofile" class="min-w-full table-fixed bg-gray-200 text-gray-500">
               <thead class="text-gray-500">
                  <tr>
                    <th class="w-24 p-2 bg-gray-100 border-b text-cent   er  border-gray-300">Name</th>
                    <th class="w-24 p-2 bg-gray-100 white text-center border-b border-gray-300 mt-4">Contact No</th>
                    <th class="w-24 p-2 bg-gray-100 text-center border-b border-gray-300">Actions</th>
                  </tr>
                </thead>
                <tbody class="bg-gray-100">
                  @foreach($techprofile as $technician)          
                    <tr>              
                      <td class="p-2 text-center bg-gray-100 border-b border-gray-300">{{ $technician->name }}</td>
                      <td class="p-2 text-center bg-gray-100 border-b border-gray-300">{{ $technician->contact_no ? '+63 ' . $technician->contact_no : 'N/A' }}</td>
                      <td class="p-2 flex bg-gray-100 items-center justify-center border-b border-gray-300">
                      <button 
    id="editButton" 
    class="bg-navy-blue text-white mr-2 py-1 px-2 rounded edit-techprofile"
    onclick="window.location.href='{{ route('techprofile.edit', $technician) }}'">
    Edit
</button>

                      <button class="bg-red-500 text-white py-1 px-2 rounded delete-techprofile" data-url="{{ route('techprofile.delete', $technician->technician_id) }}">Delete</button>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
             </table>
            </div>

        <div class="table-container w-full bg-gray-200">
             <h3 class="text-2xl font-semibold mb-2 text-left text-gray-500">Services</h3>
             <table id="services" class="min-w-full table-fixed bg-gray-200 text-gray-500">
               <thead class="text-gray-500">
                  <tr>
                    <th class="w-24 p-2 bg-gray-100 text-center border-b border-gray-300 mt-4">Services</th>
                    <th class="w-24 p-2 bg-gray-100 text-center border-b border-gray-300">Actions</th>
                  </tr>
                </thead>
                <tbody class="bg-gray-100">
                  @foreach($service as $services)
                    <tr> 
                      <td class="p-2 text-center bg-gray-100 border-b border-gray-300">{{ $services->service_name }}</td>
                      <td class="p-2 flex bg-gray-100 items-center justify-center border-b border-gray-300">
                        <button class="bg-red-500 text-white py-1 px-2 rounded delete-services" data-url="{{ route('service.delete', $services->service_id) }}">Delete</button>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
             </table>
        </div>   
    </div>    
</div>           
                         
       <!-- Confirmation Modal -->
<div id="confirmationModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
    <div class="bg-white max-w-sm w-full rounded-md shadow-lg">
        <h2 class="text-lg font-bold mb-4 text-white bg-gradient-to-r from-red-500 to-red-700 p-4 rounded-t-lg">
            Confirmation
        </h2>
        <p class="text-gray-700 text-center mb-6">
            Are you sure you want to delete this item?
        </p>
        <div class="flex justify-center gap-4">
            <button id="cancelDelete" class="px-6 py-3 bg-gray-400 text-white rounded-md hover:bg-gray-500 transition">
                Cancel
            </button>
            <button id="confirmDelete" class="px-6 py-3 bg-gradient-to-r from-red-500 to-red-700 text-white rounded-md hover:from-red-600 hover:to-red-800 transition">
                Delete
            </button>
        </div>
    </div>
</div>


<script src="{{ asset('js/confirmation.js') }}"></script>
<script>
    
    $(document).ready(function() {
        var table = $('#techreport').DataTable({
    processing: true,
    serverSide: true,
    paging: true, // Enable pagination
    pageLength: 10, // Number of entries per page
    lengthMenu: [5, 10, 25, 50, 100], // Dropdown options for "Show entries"
    searching: true, // Enable search functionality
    lengthChange: true, // Show the "Show entries" dropdown
    dom: 'lrtip', // Include pagination controls
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
                return meta.row + meta.settings._iDisplayStart + 1; // Row number
            }
        },
        { data: 'technician_name', name: 'technician_name' },
        { data: 'customer_name', name: 'customer_name' },
        { data: 'serial_number', name: 'serial_number' },
        { data: 'service_name', name: 'service_name' },
        { data: 'product_name', name: 'product_name' },
        { data: 'payment_type', name: 'payment_type' },
        { data: 'status', name: 'status' },
        {
            data: null,
            orderable: false,
            searchable: false,
            render: function(data, type, row) {
                return `
                    <div class="flex space-x-2 items-center justify-center">
                        <a href="/techreport/${row.report_id}/view"  class="bg-navy-blue text-white py-1 px-2 rounded">View</a>
                        <a href="/techreport/${row.report_id}/edit" class="bg-custom-green text-white py-1 px-2 rounded">Edit</a>
                        <button class="bg-red-500 text-white py-1 px-2 rounded delete-btn" data-url="/techreport/${row.report_id}/delete">Delete</button>
                    </div>
                `;
            }
        },
    ],

        initComplete: function(settings, json) {
            // Apply Tailwind CSS classes to the table for a minimal design
            $('#inventory').addClass('border-none'); 
            $('.dataTables_wrapper').addClass('border-none'); 
            $('.dataTables_length').addClass('border-none'); 
            $('.dataTables_paginate').addClass('text-right'); 
            $('.dataTables_filter').addClass('border-none'); 
        },
        drawCallback: function(settings) {
        // Adjust layout for category and brand tables when table length changes
        var pageInfo = table.page.info();
        if (pageInfo.recordsDisplay > 0) {
            // Apply some logic to shift or adjust layout, if necessary
            // Example: You can set min-height or adjust margin/padding dynamically
            $('.table-container').css('margin-bottom', '30px');
            }
            
        }
    });

    // Filter and reset functionality
    $('#filterButton').on('click', function() {
        $('#filterDropdown').toggleClass('hidden'); // Toggle filter dropdown visibility
        var rect = $(this)[0].getBoundingClientRect();
        $('#filterDropdown').css({
            'top': rect.bottom + window.scrollY,
            'left': rect.left + window.scrollX
        });
    });

    $(document).on('click', function(e) {
        if (!$(e.target).closest('#filterButton, #filterDropdown').length) {
            $('#filterDropdown').addClass('hidden'); // Close dropdown when clicking outside
        }
    });

    // Apply filter button action
    $('#applyFilter').on('click', function() {
        var payment_type= $('#paymenttypeFilter').val();
        var service = $('#serviceFilter').val();
        var payment_method = $('#payment_methodFilter').val();

        // Reload the table with the applied filters
        table.ajax.url(`{{ route('techreport.index') }}?payment_type=${payment_type}&service=${service}&payment_method=${payment_method}`).load();
        $('#filterDropdown').addClass('hidden'); // Hide the dropdown after applying filter
    });

    // Reset filter button action
    $('#resetFilter').on('click', function() {
        $('#paymenttypeFilter').val('');
        $('#serviceFilter').val('');
        $('#payment_methodFilter').val('');
        
        // Reload the table without any filters
        table.ajax.url('{{ route('techreport.index') }}').load();
        $('#filterDropdown').addClass('hidden'); // Hide the dropdown after resetting
    });




    $('#techreport tbody').on('click', '.delete-btn', function() {
    var deleteUrl = $(this).data('url');
    // Show the confirmation modal
    $('#confirmationModal').removeClass('hidden');

    // Cancel the delete operation
    $('#cancelDelete').on('click', function() {
        $('#confirmationModal').addClass('hidden');
    });

    // Confirm the delete operation
    $('#confirmDelete').on('click', function() {
        $.ajax({
            url: deleteUrl,
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                alert('Item deleted successfully!');
                // Reload the DataTable
                $('#techreport').DataTable().ajax.reload();
            },
            error: function(xhr) {
                console.log('Error deleting item: ' + (xhr.responseJSON.message || 'An unexpected error occurred.'));
            },
            complete: function() {
                $('#confirmationModal').addClass('hidden');
            }
        });
    });
});


    
    $('#techprofile').on('click', '.delete-techprofile', function() {
    var deleteUrl = $(this).data('url');
    // Show the confirmation modal
    $('#confirmationModal').removeClass('hidden');

    // Cancel the delete operation
    $('#cancelDelete').on('click', function() {
        $('#confirmationModal').addClass('hidden');
    });

    // Confirm the delete operation
    $('#confirmDelete').on('click', function() {
        $.ajax({
            url: deleteUrl,
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                alert('Technician deleted successfully!');
                location.reload(); // Reload the page to reflect changes
            },
            error: function(xhr) {
                console.log('Error deleting technician: ' + (xhr.responseJSON.message || 'An unexpected error occurred.'));
            },
            complete: function() {
                $('#confirmationModal').addClass('hidden');
            }
        });
    });
});


    // Delete Services
    $('#services').on('click', '.delete-services', function() {
    var deleteUrl = $(this).data('url');
    // Show the confirmation modal
    $('#confirmationModal').removeClass('hidden');

    // Cancel the delete operation
    $('#cancelDelete').on('click', function() {
        $('#confirmationModal').addClass('hidden');
    });

    // Confirm the delete operation
    $('#confirmDelete').on('click', function() {
        $.ajax({
            url: deleteUrl,
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                alert('Service deleted successfully!');
                location.reload(); // Reload the page to reflect changes
            },
            error: function(xhr) {
                console.log('Error deleting service: ' + (xhr.responseJSON.message || 'An unexpected error occurred.'));
            },
            complete: function() {
                $('#confirmationModal').addClass('hidden');
            }
        });
    });
});

});



$(document).ready(function () {
    // Initialize DataTable for Technician table
    $('#techprofile').DataTable({
        paging: true, // Enable pagination
        pageLength: 10, // Default entries per page
        lengthMenu: [5, 10, 25, 50], // Options for "Show entries" dropdown
        searching: true, // Enable search functionality
        lengthChange: false, // Show "Show entries" dropdown
        dom: 'lrtip', // Include pagination controls
        order: [], // Disable initial sorting
        columnDefs: [
            { orderable: false, targets: [2] } // Disable sorting for Actions column
        ]
    });

    // Initialize DataTable for Services table
    $('#services').DataTable({
        paging: true, // Enable pagination
        pageLength: 10, // Default entries per page
        lengthMenu: [5, 10, 25, 50], // Options for "Show entries" dropdown
        searching: true, // Enable search functionality
        lengthChange: false, // Show "Show entries" dropdown
        dom: 'lrtip', // Include pagination controls
        order: [], // Disable initial sorting
        columnDefs: [
            { orderable: false, targets: [1] } // Disable sorting for Actions column
        ]
    });
});

</script>
<style>
    body{
        font-family: 'Poppins';
        background-size: cover;
    background-color: #E5E7EB;
    }

    .dataTables_wrapper {
            margin-top: -0.5rem;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            display: inline-block;
            padding: 4px 10px;
            margin: 4px;
            font-size: 10px;
            color: #333;
            border: 1px solid #ddd;
            border-radius: 6px;
            background-color: #f9f9f9;
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease, transform 0.2s ease;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background-color: #DFDFDE;
            color: #fff;
            transform: scale(1.05);
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background-color: #15803d;
            color: green;
            border-color: #1a73e8;
            font-weight: bold;
            transform: scale(1.1);
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
            color: #bbb;
            cursor: not-allowed;
            background-color: #f1f1f1;
            border: 1px solid #ddd;
            box-shadow: none;
        }

        .dataTables_wrapper .dataTables_paginate {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 6px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.previous,
        .dataTables_wrapper .dataTables_paginate .paginate_button.next {
            font-weight: bold;
            color: #DFDFDE;
            border-radius: 6px;
            padding: 4px 10px;
            background-color: #f1f1f1;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.previous:hover,
        .dataTables_wrapper .dataTables_paginate .paginate_button.next:hover {
            background-color: #DFDFDE;
            color: #fff;
        }

        .dataTables_length {
            display: flex;
            align-items: center;
            font-size: 0.9rem;
            margin-bottom: 1REM;
            margin-left: 1rem;
        }

        .dataTables_length label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .dataTables_length select {
            padding: 0.1rem 0.3rem;
            font-size: 0.9rem;
            border-radius: 0.375rem;
            border: 1px solid #ccc;
            outline: none;
            transition: border-color 0.2s;
            margin-top: -2px;
            width: 60px;
        }
        #confirmationModal{
            z-index: 50;
            backdrop-filter: blur(5px);
            animation: fadeInBackdrop 0.4s ease-out;
        }

        @keyframes fadeInBackdrop {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        #confirmationModal .bg-white {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            animation: modalEntry 0.4s ease-out;
            max-width: 400px;
            margin: 0 auto;
        }

        @keyframes modalEntry {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        #confirmationModal h2 {
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            padding: 12px;
            margin: 0;
        }

        #confirmationModal h2 {
            background: linear-gradient(90deg, #FF4C4C, #C62828);
            color: #fff;
        }

        #confirmationModal p
       {
            font-size: 16px;
            color: #4B5563;
            text-align: center;
            margin: 20px 0;
            line-height: 1.4;
        }

        #confirmationModal .flex {
            justify-content: center;
            gap: 12px;
            padding: 0;
        }

        #confirmationModal button{
            border: none;
            padding: 8px 20px;
            font-size: 14px;
            font-weight: bold;
            border-radius: 3px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.3s ease;
            margin-bottom: 1rem;
        }

        #confirmationModal button:hove {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        #cancelDelete {
            background-color: #E5E7EB;
            color: #374151;
        }

        #cancelDelete:hover {
            background-color: #D1D5DB;
        }


        #editconfirmSubmit {
            background: linear-gradient(90deg, #2196F3, #1976D2);
            color: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }


        #editconfirmSubmit:hover {
            background: linear-gradient(90deg, #1976D2, #1565C0);
        }

    </style>
                        
</x-app-layout> 