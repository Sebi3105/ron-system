<x-app-layout>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <div class="flex flex-col md:flex-row h-screen bg-gray-200">
        <div class="flex-1 ml-64 mt-0 min-h-screen bg-gray-200">
            <!-- Content Section -->
            <div class="max-w-7xl mx-auto px-4 sm:text-left lg:px-8 mb-6">
                <div class="relative pt-16">
                    <h1 class="text-2xl px-10 font-semibold text-gray-500 absolute top-5">Admin Dashboard</h1>
                </div>

                <div class="container mt-4">
                    <!-- Welcome Text -->  
                    <div class="mb-4 ml-12">
                        <p class="text-xl font-semibold text-gray-800">Welcome, {{ Auth::user()->name }}!</p>
                    </div>

                    <!-- Navigation Buttons -->                   
                    <div class="flex space-x-4 ml-12 mb-4">
                        <button onclick="location.href='{{ route('admin.dashboard') }}'" class="bg-gray-400 text-white py-1 px-2 rounded btn-primary">User Management</button>
                        <button onclick="location.href='{{ route('admin.activitylogs.index') }}'" class="bg-gray-400 text-white py-1 px-2 rounded btn-primary">Activity Logs</button>
                        <button onclick="location.href='{{ route('admin.archives') }}'" class="bg-gray-400 text-white py-1 px-2 rounded btn-primary">Archived</button>
                    </div>

                    <!-- Success Message -->
                    <div class="success_pop mb-4">
                        @if(session()->has('success'))
                            <div class="bg-green-500 text-white p-2 rounded">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>

                    <!-- DataTable Section -->
                    <div class="table-container py-4 max-h-[500px] max-w-7xl mx-auto px-4 sm:text-left lg:px-8">
                        <div class="p-4 sm:text-left overflow-y-auto bg-gray-200">
                            <h3 class="text-3xl font-semibold mb-2 text-left text-gray-500">Existing Users</h3>
                            <table id="usersTable" class="min-w-full table-fixed bg-gray-200 text-gray-500 mx-auto">
                                <thead class="text-gray-500 bg-gray-200">
                                    <tr>
                                        <th class="w-20 p-1 bg-navy-blue border-b border-gray-300 text-center text-white">#</th>
                                        <th class="w-20 p-1 bg-navy-blue border-b border-gray-300 text-center text-white">Name</th>
                                        <th class="w-20 p-1 bg-navy-blue border-b border-gray-300 text-center text-white">Email</th>
                                        <th class="w-20 p-1 bg-navy-blue border-b border-gray-300 text-center text-white">Role</th>
                                        <th class="w-24 p-1 bg-navy-blue border-b border-gray-300 text-center text-white">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-gray-200 text-center">
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->is_superadmin == 1 ? 'SuperAdmin' : 'User' }}</td>
                                            <td>
                                                <a href="{{ route('admin.edit', $user->id) }}" class="bg-navy-blue text-white py-1 px-2 rounded" onclick="return confirmEdit();">Edit</a>
                                                <form action="{{ route('admin.delete', $user->id) }}" method="POST" style="display:inline;" onsubmit="return confirmDelete();">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-red-500 text-white py-1 px-2 rounded">Delete</button>
                                                </form>
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
                            <button id="cancelDelete" class="px-6 py-3 bg-gray-200 text-white rounded-md hover:bg-gray-200 transition">
                                Cancel
                            </button>
                            <button id="confirmDelete" class="px-6 py-3 bg-gradient-to-r from-red-500 to-red-700 text-white rounded-md hover:from-red-600 hover:to-red-800 transition">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Edit Confirmation Modal -->
                <div id="editConfirmationModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
                    <div class="bg-white max-w-sm w-full rounded-md shadow-lg">
                        <h2 class="text-lg font-bold mb-4 text-white bg-gradient-to-r from-blue-500 to-blue-700 p-4 rounded-t-lg">
                            Confirmation
                        </h2>
                        <p class="text-gray-700 text-center mb-6">
                            Are you sure you want to edit this item?
                        </p>
                        <div class="flex justify-center gap-4">
                            <button id="editcancelEdit" class="px-6 py-3 bg-gray-200 text-black rounded-md hover:bg-gray-300 transition">
                                Cancel
                            </button>
                            <button id="editconfirmEdit" class="px-6 py-3 bg-gradient-to-r from-green-500 to-green-700 text-white rounded-md hover:from-green-600 hover:to-green-800 transition">
                                Confirm
                            </button>
                        </div>
                    </div>
                </div>

                <script src="{{ asset('js/app.js') }}"></script>
                <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
                <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
                <script>
                    $(document).ready(function() {
                        $('#usersTable').DataTable({
                            "paging": true,
                            "lengthChange": true,
                            "searching": true,
                            "ordering": true,
                            "info": true,
                            "autoWidth": false,
                            "responsive": true,
                            "scrollY": false
                        });
                    });

                    function confirmEdit() {
                        return confirm("Are you sure you want to edit this user?");
                    }

                    function confirmDelete() {
                        return confirm("Are you sure you want to delete this user?");
                    }
                </script>
            </div>
        </div>
    </div>
</x-app-layout>
