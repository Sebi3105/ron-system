<x-app-layout>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
    .dataTables_wrapper .row .col-sm-12 .dt-buttons {
        display: none !important;
    }

    .table-container {
        min-height: 200px;
        max-height: 100%;
        overflow: hidden;
        flex-grow: 1;
    }

    table {
        width: 100%;
        table-layout: fixed;
        word-wrap: break-word;
    }

    th, td {
        padding: 10px;
        text-align: center;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    body, .parent-container {
        height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        background-size: cover;
        background-color: #E5E7EB;
        font-family: 'Poppins';
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
    .flex-1 {
        flex-grow: 1;
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
      


    <div class="flex flex-col md:flex-row h-screen bg-gray-200 min-w-full ">
        <div class="flex-1 ml-64 mt-0 min-h-screen bg-gray-200">
            <!-- Content Section -->
            <div class="max-w-7xl mx-auto px-4 sm:text-left lg:px-8 mt-4 mb-6 bg-gray-200">
                <!-- Header Inside Content -->
                <div class="relative pt-16">
                  <h1 class="text-2xl px-10 font-semibold text-gray-500 absolute top-5">Products</h1>
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
                                <span>Filter</span>
                                <!-- Dropdown Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </div>

                        <!-- Filter Dropdown -->
                        <div id="filterDropdown" class="hidden absolute bg-white mr-2 shadow-lg rounded-lg mt-2 p-4 w-64 z-50">
                            <div class="mb-4">
                                <!-- Category Filter -->
                                <label for="categoryFilter" class="block text-sm font-medium text-gray-700">Select Category</label>
                                <select id="categoryFilter" class="w-full border rounded     p-2">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <!-- Brand Filter -->
                                <label for="brandFilter" class="block text-sm font-medium text-gray-700">Select Brand</label>
                                <select id="brandFilter" class="w-full border rounded p-2">
                                    <option value="">Select Brand</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->brand_id }}">{{ $brand->brand_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <!-- Status Filter -->
                                <label for="statusFilter" class="block text-sm font-medium text-gray-700">Select Status</label>
                                <select id="statusFilter" class="w-full border rounded p-2">
                                    <option value="">Select Status</option>
                                    <option value="available">Available</option>
                                    <option value="low_stock">Low Stock</option>
                                    <option value="out_of_stock">Out of Stock</option>
                                </select>
                            </div>
                            <div class="flex space-x-1">
                                <button id="applyFilter" class="bg-blue-500 text-white py-2 px-4 rounded">Apply</button>
                                <button id="resetFilter" class="bg-gray-500 text-white py-2 px-4 rounded">Reset</button>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-start space x-4  mb-4 md:mb-0">
                        <!-- Action Buttons -->
                        <a href="{{ route('category.create') }}" class="bg-red-500 text-white py-2 px-4 mr-2 rounded hover:bg-red-600">+ Add Category</a>
                        <a href="{{ route('brand.create') }}" class="bg-custom-green text-white py-2 px-4 mr-2 rounded hover:bg-green-600">+ Add Brand</a>
                        <a href="{{ route('inventory.create') }}" class="bg-navy-blue text-white py-2 px-4 rounded hover:bg-navyblue">+ Add New Product</a>
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
            <!-- MGA TABLES NA HERE -->
            <!-- PRODUCT TABLE-->
<div class="table-container py-4 max-h-[500px] max-w-7xl mx-auto px-4 sm:text-left lg:px-8 bg-gray-200">
    <div class="p-4 sm:text-left bg-gray-200">
        <div>     
        <table id="inventory" class="min-w-full table-fixed bg-gray-200 text-gray-500">
        <thead class="text-gray-500 bg-gray-200">
                    <tr>
                        <th class="w-24 p-1 bg-gray-100 border-b border-gray-300">#</th>
                        <th class="w-24 p-1 bg-gray-100 border-b border-gray-300 text-center">Product Name</th>
                        <th class="w-24 p-1 bg-gray-100 border-b border-gray-300 text-center">Brand</th>
                        <th class="w-24 p-1 bg-gray-100 border-b border-gray-300 text-center">Category</th>
                        <th class="w-16 p-1 bg-gray-100 border-b border-gray-300 text-center">Quantity</th>
                        <th class="w-20 p-1 bg-gray-100 border-b border-gray-300 text-center">Released Date</th>
                        <th class="w-24 p-1 bg-gray-100 border-b border-gray-300 text-center">Status</th>
                        <th class="w-30 p-1 bg-gray-100 border-b border-gray-300 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-200">
                    <!-- Dynamic content will be injected here by DataTable -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Category and Brand Table Section -->
<div class="table-container py-4 max-w-7xl mx-auto px-4 sm:text-left lg:px-8 bg-gray-200">
    <div class="p-4 sm:text-left bg-gray-200 grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Brand Table -->
        <div class="table-container w-full bg-gray-200">
            <h3 class="text-2xl font-semibold text-left text-gray-500 mb-3">Brands</h3> <!-- Removed mb-4 -->
            <table id="brandTable" class="min-w-full table-fixed bg-gray-200 text-gray-500">
                <thead class="text-gray-500 bg-gray-200">
                    <tr>
                        <th class="w-24 p-2 bg-gray-100 border-b border-gray-300">#</th>
                        <th class="w-24 p-2 bg-gray-100 white text-center border-b border-gray-300 mt-4">Brand Name</th>
                        <th class="w-24 p-2 bg-gray-100 text-center border-b border-gray-300">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-100"></tbody>
            </table>
        </div>

        <!-- Category Table -->
        <div class="table-container w-full bg-gray-200">
            <h3 class="text-2xl font-semibold text-left text-gray-500 mb-3">Categories</h3> <!-- Removed mb-4 -->
            <table id="categoryTable" class="min-w-full mt-0 mb-0 table-fixed bg-gray-200 text-gray-500">
                <thead class="text-gray-500 bg-gray-200">
                    <tr>
                        <th class="w-24 p-2 bg-gray-100 border-b border-gray-300">#</th>
                        <th class="w-24 p-2 bg-gray-100 text-center border-b border-gray-300">Category Name</th>
                        <th class="w-24 p-2 bg-gray-100 text-center border-b border-gray-300">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-200"></tbody>
            </table>
        </div>
    </div>
</div>

<!-- Confirmation in inventory Modal -->
<div id="confirmationModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
    <div class="bg-white max-w-sm w-full rounded-md shadow-lg">
        <h2 class="text-lg font-bold mb-4 text-white bg-gradient-to-r from-red-500 to-red-700 p-4 rounded-t-lg">
            Confirmation
        </h2>
        <p id="modalMessage" class="text-gray-700 text-center mb-6">
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

    $('.dt-buttons').css('display', 'none !important');
    
    $(document).ready(function() {

        $('.dt-buttons').css('display', 'none !important');

        var categoryTable = $('#categoryTable').DataTable({
            processing: true,
            serverSide: true,
            lengthChange: false,
            searching: false,
            order: [[1, 'asc']], 
            ajax: "{{ route('category.data') }}",
            columns: [
                {
                    data: null,
                    orderable: false,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1; // Row number
                    }
                },
                { data: 'category_name', name: 'category_name' },
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `
                    <div class="flex space-x-2 items-center justify-center">
                        <button class="bg-red-500 text-white py-1 px-2 rounded delete-category" data-url="/category/${row.category_id}">Delete</button>
                    </div>
                `;
                    }
                },
            ],
        });
        
        var brandTable = $('#brandTable').DataTable({
            processing: true,
            serverSide: true,
            lengthChange: false,
            searching: false,
            order: [[1, 'asc']], 
            ajax: "{{ route('brand.data') }}",
            columns: [
                {
                    data: null,
                    orderable: false,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1; // Row number
                    }
                },
                { data: 'brand_name', name: 'brand_name' },
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `
                    <div class="flex space-x-2 items-center justify-center">
                        <button class="bg-red-500 text-white py-1 px-2 rounded delete-brand" data-url="/brand/${row.brand_id}">Delete</button>
                    </div>
                `;
                    }
                },
            ],
        })

        var table = $('#inventory').DataTable({
        processing: true,
        serverSide: true,
        searching: true, // Enable the search bar globally
        lengthChange: true, // Enable the "Show entries" dropdown
        order: [[1, 'asc']],
        dom: 'lrtip',
        ajax: {
            url: "{{ route('inventory.index') }}",
            data: function(d) {
                d.category = $('#categoryFilter').val();
                d.brand = $('#brandFilter').val();
                d.status = $('#statusFilter').val();
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
            { data: 'product_name', name: 'product_name' },
            { data: 'brand_name', name: 'brand_name' },
            { data: 'category_name', name: 'category_name' },
            { data: 'quantity', name: 'quantity' },
            { data: 'released_date', name: 'released_date' },
            { data: 'status', name: 'status' },
            {
                data: null,
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    return `
                        <div class="flex space-x-2 items-center justify-center">
                           <a href="/inventory/${row.product_id}/serials" class="bg-navy-blue text-white py-1 px-2 rounded">View Serials</a>

                            <a href="/inventory/${row.product_id}/edit" class="bg-custom-green text-white py-1 px-2 rounded">Edit</a>
                            <button class="bg-red-500 text-white py-1 px-2 rounded delete-btn" data-url="/inventory/${row.product_id}">Delete</button>
                        </div>
                    `;
                }
            },
        ],
        rowCallback: function(row, data) {
            if (data.quantity <= 3) {
                $(row).css('background-color', '#fff3cd'); // Light yellow
            }
            if (data.quantity <= 1) {
                $(row).css('background-color', '#f8d7da'); // Light red
            }
        },
        initComplete: function(settings, json) {
            // Apply Tailwind CSS classes to the table for a minimal design
            $('#inventory').addClass('border-none'); 
            $('.dataTables_wrapper').addClass('border-none'); 
            $('.dataTables_length').addClass('border-none'); 
            $('.dataTables_paginate').addClass('text-right'); 
            $('.dataTables_filter').addClass('border-none'); 
        },
        drawCallback: function(settings) {
            var pageInfo = table.page.info();
            if (pageInfo.recordsDisplay > 0) {
                $('.table-container').css('margin-bottom', '30px');
            }
        }
        
    });

    // Custom search functionality linked to the search input field
    $('#tableSearch').on('keyup', function() {
        table.search(this.value).draw();  // Apply search to the DataTable
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
    var category = $('#categoryFilter').val();
    var brand = $('#brandFilter').val();
    var status = $('#statusFilter').val();

    // Reload the table with the applied filters
    var url = "{{ route('inventory.index') }}"; // Get the URL from Blade template
    table.ajax.url(url + '?category=' + category + '&brand=' + brand + '&status=' + status).load();
    $('#filterDropdown').addClass('hidden'); // Hide the dropdown after applying filter
});

// Reset filter button action
$('#resetFilter').on('click', function() {
    $('#categoryFilter').val('');
    $('#brandFilter').val('');
    $('#statusFilter').val('');
    
    // Reload the table without any filters
    var url = "{{ route('inventory.index') }}"; // Get the URL from Blade template
    table.ajax.url(url).load();
    $('#filterDropdown').addClass('hidden'); // Hide the dropdown after resetting
});

$('#techreport tbody').on('click', '.delete-btn', function() {
    var deleteUrl = $(this).data('url');

    // Show the confirmation modal
    $('#confirmationModal').removeClass('hidden');

    // Handle cancel operation
    $('#cancelDelete').off('click').on('click', function() {
        $('#confirmationModal').addClass('hidden');
    });

    // Handle confirm operation
    $('#confirmDelete').off('click').on('click', function() {
        $.ajax({
            url: deleteUrl,
            type: 'DELETE',
            data: { _token: '{{ csrf_token() }}' },
            success: function(response) {
                alert('Item deleted successfully!');
                // Reload the DataTable
                $('#techreport').DataTable().ajax.reload();
            },
            error: function(xhr) {
                console.log('Error deleting item: ' + (xhr.responseJSON.message || 'An unexpected error occurred.'));
            },
            complete: function() {
                // Hide the confirmation modal
                $('#confirmationModal').addClass('hidden');
            }
        });
    });
});




    // Delete category
    $('#categoryTable').on('click', '.delete-category', function() {
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
                    alert('Category deleted successfully!');
                    location.reload(); // Reload the page to reflect changes
                },
                error: function(xhr) {
                    console.log('Error deleting category: ' + (xhr.responseJSON.message || 'An unexpected error occurred.'));
                },
                complete: function() {
                    $('#confirmationModal').addClass('hidden');
                }
            });
        });
    });


    $('#brandTable').on('click', '.delete-brand', function() {
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
                    alert('Brand deleted successfully!');
                    location.reload(); // Reload the page to reflect changes
                },
                error: function(xhr) {
                    console.log('Error deleting brand: ' + (xhr.responseJSON.message || 'An unexpected error occurred.'));
                },
                complete: function() {
                    $('#confirmationModal').addClass('hidden');
                }
            });
        });
    });

});
  

</script>

</x-app-layout>