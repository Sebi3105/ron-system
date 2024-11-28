<x-app-layout>
<div class="flex flex-col md:flex-row h-screen">
<div class="flex-1 ml-64 mt-0"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Include Bootstrap CSS for styling -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Include DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
</head>

<body>
    <div class="container">
        <h1 class="text-2xl font-semibold text-white-800">Admin Dashboard</h1>
        <p class="text-2xl font-semibold text-white-800">Welcome, {{ Auth::user()->name }}!</p>

        <h2 class="text-2xl font-semibold text-white-800">Existing Users</h2>
        <div class="py-4 overflow-auto max-h-[500px] max-w-7xl mx-auto px- ```blade
            4 sm:px-6 lg:px-8">
                <div class="p-4 sm:p-8 bg-gray-200 shadow sm:rounded-lg overflow-y-auto">
                    <div class="overflow-x-auto"></div>
        <table id="usersTable" class="min-w-full table-fixed bg-gray-200 text-black border border-gray-400">
            <thead class="bg-gray-300 border-b border-gray-400">
                <tr>
                    <th class="w-12 p-2 border-r border-gray-400">#</th>
                    <th class="w-40 p-2 border-r border-gray-400">Name</th>
                    <th class="w-40 p-2 border-r border-gray-400">Email</th>
                    <th class="w-40 p-2 border-r border-gray-400">Role</th>
                    <th class="w-40 p-2 border-r border-gray-400">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->is_superadmin == 1 ? 'SuperAdmin' : 'User  ' }}</td>
                        <td>
                            <a href="{{ route('admin.edit', $user->id) }}" class="btn btn-warning btn-sm" onclick="return confirmEdit();">Edit</a>
                            <form action="{{ route('admin.delete', $user->id) }}" method="POST" style="display:inline;" onsubmit="return confirmDelete();">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
       
        <!-- Button to create a new user -->
        <a href="{{ route('admin.create') }}" class="btn btn-primary">Create New User</a>
        </div>
                </div>
            </div>

    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Include DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#usersTable').DataTable({
                "paging": true,        // Enable pagination
                "lengthChange": true,  // Allow changing the number of records per page
                "searching": true,     // Enable searching
                "ordering": true,      // Enable sorting
                "info": true,          // Show table information
                "autoWidth": false,    // Disable auto width calculation
                "responsive": true      // Make the table responsive
            });
        });

        function confirmEdit() {
            return confirm("Are you sure you want to edit this user?");
        }

        function confirmDelete() {
            return confirm("Are you sure you want to delete this user?");
        }
    </script>
</body>
    </div>
    </div>
    </x-app-layout>