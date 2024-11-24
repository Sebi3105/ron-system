<x-app-layout>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <div class="flex flex-col md:flex-row h-screen bg-gray-200">
        <div class="flex-1 ml-64 mt-0">
            <!-- Content Section -->
            <div class="max-w-7xl mx-auto px-4 sm:text-left lg:px-8 mt-4 mb-6">
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

                        <!-- Filter Dropdown -->
                        <div id="filterDropdown" class="hidden absolute bg-white shadow-lg rounded-lg mt-2 p-4 w-64 z-50">
                            <div class="mb-4">
                                <!-- Category Filter -->
                                <label for="categoryFilter" class="block text-sm font-medium text-gray-700">Select Category</label>
                                <select id="categoryFilter" class="w-full border rounded p-2">
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
                            <div class="flex space-x-2">
                                <button id="applyFilter" class="bg-blue-500 text-white py-2 px-4 rounded">Apply</button>
                                <button id="resetFilter" class="bg-gray-500 text-white py-2 px-4 rounded">Reset</button>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-start space x-4  mb-4 md:mb-0">
                        <!-- Action Buttons -->
                        <a href="{{ route('category.create') }}" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600">+ Add Category</a>
                        <a href="{{ route('brand.create') }}" class="bg-custom-green text-white py-2 px-4 rounded hover:bg-green-600">+ Add Brand</a>
                        <a href="{{ route('inventory.create') }}" class="bg-navy-blue text-white py-2 px-4 rounded hover:bg-navyblue">Add New Product</a>
                    </div>
                </div>
            </div>

            <!-- MGA TABLES NA HERE -->
            <!-- PRODUCT TABLE-->
<div class="py-4 overflow-auto max-h-[500px] max-w-7xl mx-auto px-4 sm:text-left lg:px-8">
    <div class="p-4 sm:text-left overflow-y-auto">
        <div>
            <table id="inventory" class="min-w-full table-fixed bg-gray-200 text-gray-500">
                <thead class="text-gray-500">
                    <tr>
                        <th class="w-8 p-1  bg-gray-100 border-b border-gray-300">#</th>
                        <th class="w-24 p-1 bg-gray-100 border-b border-gray-300">Product Name</th>
                        <th class="w-20 p-1 bg-gray-100 border-b border-gray-300">Brand</th>
                        <th class="w-20 p-1 bg-gray-100 border-b border-gray-300">Category</th>
                        <th class="w-20 p-1 bg-gray-100 border-b border-gray-300">Price</th>
                        <th class="w-12 p-1 bg-gray-100 border-b border-gray-300">Stock</th>
                        <th class="w-12 p-1 bg-gray-100 border-b border-gray-300">Status</th>
                        <th class="w-20 p-1 bg-gray-100 border-b border-gray-300">Released Date</th>
                        <th class="w-16 p-1 bg-gray-100 border-b border-gray-300">Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

<!-- Category and Brand Table Section -->
<div class="py-4 overflow-auto max-w-7xl mx-auto px-4 sm:text-left lg:px-8">
    <div class="p-4 sm:text-left bg-gray-200  grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Brand Table -->
        <div class="w-full bg-gray-200">
            <h3 class="text-2xl font-semibold mb-2 text-left text-gray-500">Brands</h3>
            <table id="brandTable" class="min-w-full table-fixed bg-gray-200 text-gray-500">
                <thead class="text-gray-500">
                    <tr">
                    
                        <th class="w-24 p-2 bg-gray-100 border-b border-gray-300">#</th>
                        <th class="w-24 p-2 bg-gray-100 white text-left border-b border-gray-300 mt-4">Brand Name</th>
                        <th class="w-24 p-2 bg-gray-100 text-center border-b border-gray-300">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-100">
                @foreach($brands as $index => $brand)
                        <tr>
                            <td class="p-2 text-left bg-gray-100 border-b border-gray-300">{{ $index + 1 }}</td>
                            <td class="p-2 text-left bg-gray-100 border-b border-gray-300">{{ $brand->brand_name }}</td>
                            <td class="p-2 flex bg-gray-100 items-center justify-center border-b border-gray-300">
                                <button class="bg-red-500 text-white py-1 px-2 rounded delete-brand" data-url="{{ route('brand.delete', $brand->brand_id) }}">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Category Table -->
        <div class="w-full bg-gray-200">
            <h3 class="text-2xl font-semibold mb-2 text-left text-gray-500">Categories</h3>
            <table id="categoryTable" class="min-w-full table-fixed bg-gray-200 text-gray-500">
                <thead class="text-gray-500">
                    <tr>
                        <th class="w-24 p-2 bg-gray-100 border-b border-gray-300">#</th>
                        <th class="w-24 p-2 bg-gray-100 text-left border-b border-gray-300">Category Name</th>
                        <th class="w-24 p-2 bg-gray-100 text-center border-b border-gray-300">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-100">
                @foreach($categories as $index => $category)
                    
                        <tr>
                            <td class="p-2 text-left bg-gray-100 border-b border-gray-300">{{ $index + 1 }}</td>
                            <td class="p-2 bg-gray-100 text-left border-b border-gray-300">{{ $category->category_name }}</td>
                            <td class="p-2 bg-gray-100 flex items-center justify-center border-b border-gray-300">
                                <button class="bg-red-500 text-white py-1 px-2 rounded delete-category" data-url="{{ route('category.delete', $category->category_id) }}">Delete</button>
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
    var table = $('#inventory').DataTable({
        processing: true,
        serverSide: true,
        searching: true, // Disable the default search bar
        lengthChange: true, // Disable the "Show entries" dropdown
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
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { data: 'product_name', name: 'product_name' },
            { data: 'category_name', name: 'category_name' },
            { data: 'brand_name', name: 'brand_name' },
            { data: 'quantity', name: 'quantity' },
            { data: 'released_date', name: 'released_date' },
            { data: 'status', name: 'status' },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
        ],

        rowCallback: function(row, data) {
            if (data.quantity <= 4) {
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
        var category = $('#categoryFilter').val();
        var brand = $('#brandFilter').val();
        var status = $('#statusFilter').val();

        // Reload the table with the applied filters
        table.ajax.url(`{{ route('inventory.index') }}?category=${category}&brand=${brand}&status=${status}`).load();
        $('#filterDropdown').addClass('hidden'); // Hide the dropdown after applying filter
    });

    // Reset filter button action
    $('#resetFilter').on('click', function() {
        $('#categoryFilter').val('');
        $('#brandFilter').val('');
        $('#statusFilter').val('');
        
        // Reload the table without any filters
        table.ajax.url('{{ route('inventory.index') }}').load();
        $('#filterDropdown').addClass('hidden'); // Hide the dropdown after resetting
    });

    $('#inventory tbody').on('click', '.btn-primary', function(e) {
        e.preventDefault();
        var editUrl = $(this).attr('href');
        if (confirm('Are you sure you want to edit this item?')) {
            window.location.href = editUrl;
        }
    });

    $('#inventory tbody').on('click', '.delete-btn', function() {
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
                    table.ajax.reload();
                },
                error: function(xhr) {
                    console.log('Error deleting item: ' + (xhr.responseJSON.message || 'An unexpected error occurred.'));
                }
            });
        }
    });

    // Delete category
    $('#categoryTable').on('click', '.delete-category', function() {
        var deleteUrl = $(this).data('url');
        if (confirm('Are you sure you want to delete this category?')) {
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
                }
            });
        }
    });

    // Delete brand
    $('#brandTable').on('click', '.delete-brand', function() {
        var deleteUrl = $(this).data('url');
        if (confirm('Are you sure you want to delete this brand?')) {
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
                }
            });
        }
    });
});


</script>

</x-app-layout>