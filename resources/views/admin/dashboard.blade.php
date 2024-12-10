<x-app-layout>
    <!-- Include DataTables CSS and Tailwind Fonts -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <div class="flex flex-col md:flex-row h-screen">
        <!-- Sidebar -->
        <div class="hidden md:block md:w-48 lg:w-64 bg-gray-800 text-gray-200">
            <div class="py-6 text-center text-lg font-semibold border-b border-gray-700">
                Admin Panel
            </div>
        </div>
        <header class="bg-gray-200 py-3 px-3 md:px-6 fixed top-0 md:left-48 lg:left-64 right-0 z-20 h-16 flex items-center justify-between text-black shadow-md">
                <h1 class="text-lg font-bold">Welcome, {{ Auth::user()->name }}!</h1>
            </header>

        <!-- Main Content -->
        <div class="flex-1 bg-gray-100">
            <!-- Header -->

            <!-- Content Section -->
            <div class="mt-20 px-4 sm:px-6 lg:px-8">
                <div class="flex flex-wrap lg:flex-nowrap gap-6">
                    <!-- Soft Deleted Records Section -->
                    <div class="w-1/3 bg-white shadow rounded-lg p-4">
                        <h2 class="text-lg font-semibold text-gray-700 mb-4">Soft Deleted Records</h2>
                        <div class="flex flex-wrap gap-4">
                            <a href="{{ route('admin.inventory.softDeleted') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg shadow">
                                View Soft Deleted Inventory
                            </a>
                            <a href="{{ route('admin.inventoryitem.softDeleted') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg shadow">
                                View Soft Deleted Inventory Items
                            </a>
                            <a href="{{ route('admin.customer.soft_deleted') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg shadow">
                                View Soft Deleted Customer
                            </a>
                            <a href="{{ route('admin.sales.soft_deleted') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg shadow">
                                View Soft Deleted Sales
                            </a>
                            <a href="{{ route('admin.brand.soft_deleted') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg shadow">
                                View Soft Deleted Brands
                            </a>
                            <a href="{{ route('admin.category.soft_deleted') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg shadow">
                                View Soft Deleted Categories
                            </a>
                            <a href="{{ route('admin.services.soft_deleted') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg shadow">
                                View Soft Deleted Services
                            </a>
                            <a href="{{ route('admin.techprofile.soft_deleted') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg shadow">
                                View Soft Deleted Technician
                            </a>
                            <a href="{{ route('admin.techreport.soft_deleted') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg shadow">
                                View Soft Deleted Technician Report
                            </a>
                        </div>
                    </div>

                    <!-- User Management Section -->
                    <div class="flex-1 bg-white shadow rounded-lg p-4">
                        <div class="mb-4 flex justify-between items-center">
                            <h2 class="text-lg font-semibold text-gray-700">User Management</h2>
                            <a href="{{ route('admin.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded shadow">
                                Create New User
                            </a>
                        </div>
                        <div class="overflow-x-auto">
                            <table id="usersTable" class="min-w-full bg-white border border-gray-300 text-gray-800">
                                <thead>
                                    <tr class="bg-gray-200">
                                        <th class="py-2 px-4 border">#</th>
                                        <th class="py-2 px-4 border">Name</th>
                                        <th class="py-2 px-4 border">Email</th>
                                        <th class="py-2 px-4 border">Role</th>
                                        <th class="py-2 px-4 border">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr class="hover:bg-gray-100">
                                        <td class="py-2 px-4 border">{{ $loop->iteration }}</td>
                                        <td class="py-2 px-4 border">{{ $user->name }}</td>
                                        <td class="py-2 px-4 border">{{ $user->email }}</td>
                                        <td class="py-2 px-4 border">{{ $user->is_superadmin == 1 ? 'SuperAdmin' : 'User' }}</td>
                                        <td class="py-2 px-4 border flex space-x-2">
                                            <a href="{{ route('admin.edit', $user->id) }}" class="text-yellow-600 hover:underline">Edit</a>
                                            <form action="{{ route('admin.delete', $user->id) }}" method="POST" onsubmit="return confirmDelete();">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#usersTable').DataTable({
                paging: true,
                lengthChange: true,
                searching: true,
                ordering: true,
                info: true,
                autoWidth: false,
                responsive: true
            });
        });

        function confirmDelete() {
            return confirm("Are you sure you want to delete this user?");
        }
    </script>
</x-app-layout>
