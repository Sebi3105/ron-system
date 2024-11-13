<x-app-layout>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <div class="flex flex-col md:flex-row h-screen">
        <!-- Sidebar space alignment for inventory view -->
        <div class="flex-1 ml-64 mt-0"> 

            <!-- Header -->
            <header class="bg-gray-200 py-4 px-8 fixed top-0 left-64 right-0 z-20 h-20 flex items-center justify-between shadow-md">
                <h1 class="text-2xl font-semibold text-gray-800">Products</h1>
            </header>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-24 mb-6 flex items-center space-x-4"> 
                <div class="flex-1 flex justify-start">
                    <div class="relative w-1/2">
                        <input type="text" id="tableSearch" class="border border-gray-300 rounded-md pl-10 pr-4 py-2 w-full" placeholder="Search...">
                        <span class="absolute left-3 top-2.5 text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a7 7 0 100 14 7 7 0 000-14zM18 18l-3.5-3.5" />
                            </svg>
                        </span>
                    </div>
                </div>

                <div class="flex space-x-2">
                    <a href="{{ route('category.create') }}" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600">+ Add Category</a>
                    <a href="{{ route('brand.create') }}" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600">+ Add Brand</a>
                    <a href="{{ route('inventory.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">+ Add New Product</a>
                </div>
            </div>

            <!-- Success Notification -->
            <div class="success_pop mb-4 mt-20"> <!-- Adjusted mt-20 to provide space under the absolute header -->
                @if(session()->has('success'))
                    <div class="bg-green-500 text-white p-2 rounded">
                        {{ session('success') }}
                    </div>
                @endif
            </div>

            <!-- Product Table -->
            <div class="py-4 overflow-auto max-h-[500px] max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="p-4 sm:p-8 bg-gray-200 shadow sm:rounded-lg overflow-y-auto">
                    <div class="overflow-x-auto">
                        <table id="inventory" class="min-w-full table-fixed bg-gray-200 text-black border border-gray-400">
                            <thead class="bg-gray-300 border-b border-gray-400">
                                <tr>
                                    <th class="w-12 p-2 border-r border-gray-400">#</th>
                                    <th class="w-32 p-2 border-r border-gray-400">Product ID</th>
                                    <th class="w-40 p-2 border-r border-gray-400">Product Name</th>
                                    <th class="w-32 p-2 border-r border-gray-400">Category</th>
                                    <th class="w-32 p-2 border-r border-gray-400">Brand</th>
                                    <th class="w-24 p-2 border-r border-gray-400">Quantity</th>
                                    <th class="w-32 p-2 border-r border-gray-400">Released Date</th>
                                    <th class="w-24 p-2 border-r border-gray-400">Status</th>
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
        </div>
    </div>

    <script src="{{ asset('js/confirmation.js') }}"></script>
    <script>
        $(document).ready(function() {
            var table = $('#inventory').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('inventory.index') }}",
                columns: [
                    {
                        data: null,
                        orderable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    { data: 'product_id', name: 'product_id' },
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
                        $(row).css('background-color', '#fff3cd');
                    } else if (data.quantity <= 1) {
                        $(row).css('background-color', '#f8d7da');
                    }
                },
                dom: 'rt', // Remove the default search and pagination controls
            });

            $('#tableSearch').on('keyup', function() {
                table.search(this.value).draw();
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
        });
    </script>
</x-app-layout>
