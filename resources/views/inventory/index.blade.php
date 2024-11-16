<x-app-layout>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <!-- Sidebar (Navigation) -->
    <div class="w-64 fixed top-0 left-0 z-10 h-screen">
        @include('layouts.navigation') 
    </div>

    <div class="flex flex-col h-screen bg-gray-200 pl-64 w-full">

        <!-- 1st Row: Products Header -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8 mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">Products</h1>
        </div>

        <!-- 2nd Row: Search Bar, Filter & Buttons -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 mb-6 flex flex-wrap items-center space-x-4 space-y-4">
            <!-- Search Bar -->
            <div class="relative w-full md:w-1/2">
                <input type="text" id="tableSearch" class="border border-gray-300 rounded-md pl-10 pr-4 py-2 w-full" placeholder="Search...">
                <span class="absolute left-3 top-2.5 text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a7 7 0 100 14 7 7 0 000-14zM18 18l-3.5-3.5" />
                    </svg>
                </span>
            </div>

            <!-- Filter Dropdowns -->
            <div class="flex space-x-4">
                <select id="categoryFilter" class="border rounded p-2">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>

                <select id="brandFilter" class="border rounded p-2">
                    <option value="">Select Brand</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->brand_id }}">{{ $brand->brand_name }}</option>
                    @endforeach
                </select>

                <select id="statusFilter" class="border rounded p-2">
                    <option value="">Select Status</option>
                    <option value="available">Available</option>
                    <option value="low_stock">Low Stock</option>
                    <option value="out_of_stock">Out of Stock</option>
                </select>

                <button id="filterButton" class="bg-blue-500 text-white p-2 rounded">Filter</button>
                <button id="resetButton" class="bg-gray-500 text-white p-2 rounded">Reset</button>
            </div>

            <!-- Action Buttons -->
            <div class="flex space-x-2">
                <a href="{{ route('category.create') }}" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600">+ Add Category</a>
                <a href="{{ route('brand.create') }}" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600">+ Add Brand</a>
                <a href="{{ route('inventory.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">+ Add New Product</a>
            </div>

            <!-- Notification Icon (No functionality yet) -->
            <div class="ml-auto">
                <button class="bg-gray-300 p-2 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 22c1.104 0 2-.896 2-2s-.896-2-2-2-2 .896-2 2 .896 2 2 2zm0-2c-.552 0-1-.448-1-1s.448-1 1-1 1 .448 1 1-.448 1-1 1zm-1-6h2V7H11v9zm0 0h2l-2 9h-2l2-9zm0 0h-2V7h2v9z" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- 3rd Row: Product Table (Width between Search Bar and Notification Icon) -->
        <div class="py-4 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-gray-200 shadow sm:rounded-lg">
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

        <!-- 4th Row: Brands and Categories Table Side by Side -->
        <div class="flex space-x-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <!-- Brands Table -->
            <div class="flex-1 bg-gray-200 shadow sm:rounded-lg">
                <h2 class="text-xl font-semibold mb-2">Brands</h2>
                <table id="brandTable" class="min-w-full table-fixed bg-gray-200 text-black border border-gray-400">
                    <thead class="bg-gray-300 border-b border-gray-400">
                        <tr>
                            <th class="w-40 p-2 border-r border-gray-400">Brand Name</th>
                            <th class="w-24 p-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-200">
                        @foreach($brands as $brand)
                            <tr>
                                <td class="p-2 border-r border-gray-400">{{ $brand->brand_name }}</td>
                                <td class="p-2">
                                    <button class="bg-red-500 text-white py-1 px-2 rounded delete-brand" data-url="{{ route('brand.delete', $brand->brand_id) }}">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Categories Table -->
            <div class="flex-1 bg-gray-200 shadow sm:rounded-lg">
                <h2 class="text-xl font-semibold mb-2">Categories</h2>
                <table id="categoryTable" class="min-w-full table-fixed bg-gray-200 text-black border border-gray-400">
                    <thead class="bg-gray-300 border-b border-gray-400">
                        <tr>
                            <th class="w-40 p-2 border-r border-gray-400">Category Name</th>
                            <th class="w-24 p-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-200">
                        @foreach($categories as $category)
                            <tr>
                                <td class="p-2 border-r border-gray-400">{{ $category->category_name }}</td>
                                <td class="p-2">
                                    <button class="bg-red-500 text-white py-1 px-2 rounded delete-category" data-url="{{ route('category.delete', $category->category_id) }}">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
