<x-app-layout>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <div class="flex flex-col md:flex-row h-screen bg-gray-200">
        <div class="flex-1 ml-64 mt-0 min-h-screen bg-gray-200">
            <!-- Content Section -->
            <div class="max-w-7xl mx-auto px-4 sm:text-left lg:px-8 mb-6">
                <div class="relative pt-16">
                    <h1 class="text-2xl px-10 font-semibold text-gray-500 absolute top-5">Admin Dashboard</h1>
                </div>

                <div class="container mt-           4">
                    <!-- Welcome Text -->
                    <div class="mb-4 ml-12">
                        <p class="text-xl font-semibold text-gray-800">Welcome, {{ Auth::user()->name }}!</p>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="flex space-x-4 ml-12 mb-4">
                        <button onclick="location.href='{{ route('admin.dashboard') }}'" class="bg-white text-blue-500 py-2 px-3 rounded btn-primary">User Management</button>
                        <button onclick="location.href='{{ route('admin.activitylogs.index') }}'" class="bg-white text-blue-500 py-2 px-3 rounded btn-primary">Activity Logs</button>
                        <button onclick="location.href='{{ route('admin.archives') }}'" class="bg-white text-blue-500 py-2 px-3 rounded btn-primary">Archived</button>
                    </div>

                    <!-- DataTable Section -->
                    <div class="table-container py-4 max-h-[500px] max-w-7xl mx-auto px-4 sm:text-left lg:px-8">
                        <div class="p-4 sm:text-left overflow-y-auto bg-gray-200">
                            <div class="flex justify-between items-center">
                                <h3 class="text-3xl font-semibold mb-2 text-left text -gray-500">User Accounts</h3>
                                <a href="{{ route('admin.create') }}" class="bg-white text-blue-500 py-2 px-4 rounded-md">Create New User</a>
                            </div>

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
                                            <a href="#" class="bg-navy-blue text-white py-1 px-2 rounded" onclick="showEditModal('{{ route('admin.edit', $user->id) }}')">Edit</a>
                                            <form id="deleteForm{{ $user->id }}" action="{{ route('admin.delete', $user->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="bg-red-500 text-white py-1 px-2 rounded" onclick="showDeleteModal({{ $user->id }})">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

             <!-- Confirmation Modal for Deleting -->
<!-- Confirmation Modal for Deleting -->
<div id="confirmationModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden z-50 backdrop-filter backdrop-blur-sm">
    <div class="bg-white rounded-lg shadow-lg max-w-md w-full">
        <h2 class="font-bold text-xl text-white bg-gradient-to-r from-red-500 to-red-700 p-4 text-center rounded-t-lg">
            Confirmation
        </h2>
        <p class="text-gray-700 text-center mb-6">
            Are you sure you want to delete this item?
        </p>
        <div class="flex justify-center gap-6 py-4">
            <button id="cancelDelete" class="px-6 py-3 bg-gray-200 text-black rounded-md hover:bg-gray-300 transition">
                Cancel
            </button>
            <button id="confirmDelete" class="px-6 py-3 bg-gradient-to-r from-red-500 to-red-700 text-white rounded-md hover:bg-gradient-to-r hover:from-red-600 hover:to-red-800 transition">
                Confirm
            </button>
        </div>
    </div>
</div>

<!-- Edit Confirmation Modal -->
<div id="editConfirmationModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden z-50 backdrop-filter backdrop-blur-sm">
    <div class="bg-white rounded-lg shadow-lg max-w-md w-full">
        <h2 class="font-bold text-xl text-white bg-gradient-to-r from-blue-500 to-blue-700 p-4 text-center rounded-t-lg">
            Confirmation
        </h2>
        <p class="text-gray-700 text-center mb-6">
            Are you sure you want to edit this item?
        </p>
        <div class="flex justify-center gap-6 py-4">
            <button id="editcancelEdit" class="px-6 py-3 bg-gray-200 text-black rounded-md hover:bg-gray-300 transition">
                Cancel
            </button>
            <button id="editconfirmEdit" class="px-6 py-3 bg-gradient-to-r from-green-500 to-green-700 text-white rounded-md hover:bg-gradient-to-r hover:from-green-600 hover:to-green-800 transition">
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

                    function showDeleteModal(userId) {
        // Show the delete confirmation modal
        document.getElementById('confirmationModal').classList.remove('hidden');
        
        // Add the user-specific form submit action for delete
        const confirmDeleteButton = document.getElementById('confirmDelete');
        confirmDeleteButton.onclick = function() {
            document.getElementById('deleteForm' + userId).submit();
        };
    }

    function showEditModal(editUrl) {
        // Show the edit confirmation modal
        document.getElementById('editConfirmationModal').classList.remove('hidden');
        
        // Edit confirmation behavior
        const confirmEditButton = document.getElementById('editconfirmEdit');
        confirmEditButton.onclick = function() {
            window.location.href = editUrl; // Redirect to the edit page
        };
    }

    // Close the delete modal if the cancel button is clicked
    document.getElementById('cancelDelete').onclick = function() {
        document.getElementById('confirmationModal').classList.add('hidden');
    };

    // Close the edit modal if the cancel button is clicked
    document.getElementById('editcancelEdit').onclick = function() {
        document.getElementById('editConfirmationModal').classList.add('hidden');
    };
                </script>
            </div>
        </div>
    </div>
    <style>
        body {
            background-color: #E5E7EB;
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
            margin-top: 1REM;
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

      
         /* Confirmation Modal Styling */
    #confirmationModal, #editConfirmationModal {
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

    /* Modal Content Styling */
    #confirmationModal .bg-white, #editConfirmationModal .bg-white {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        animation: modalEntry 0.4s ease-out;
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

    /* Header Style */
    #confirmationModal h2, #editConfirmationModal h2 {
        font-size: 22px;
        font-weight: bold;
        color: #fff;
        text-align: center;
        padding: 12px;
        margin: 0;
    }

    /* Delete Modal Header */
    #confirmationModal h2 {
        background: linear-gradient(90deg, #FF4C4C, #C62828);
    }

    /* Edit Modal Header */
    #editConfirmationModal h2 {
        background: linear-gradient(90deg, #4CAF50, #2E7D32);
    }

    /* Modal Text */
    #confirmationModal p, #editConfirmationModal p {
        font-size: 15px;
        color: #4B5563;
        text-align: center;
        margin: 16px 0 24px;
        line-height: 1.6;
    }

    /* Button Styles */
    #confirmationModal button, #editConfirmationModal button {
        border: none;
        padding: 12px 20px;
        font-size: 14px;
        font-weight: bold;
        border-radius: 3px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.3s ease;
    }

    /* Button Hover Effects */
    #confirmationModal button:hover, #editConfirmationModal button:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    /* Cancel and Confirm Buttons */
    #cancelDelete, #cancelEdit #editconfirmEdit {
        background-color: #E5E7EB;
        color: #374151;
        transition: background-color 0.3s ease;
    }

    #cancelDelete:hover, #cancelEdit:hover,  #editconfirmEdit:hover {
        background-color: #D1D5DB;
    }

    #editconfirmEdit {
        background: linear-gradient(90deg, #4CAF50, #2E7D32);
        color: white;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }

    /* Modal Flex Layout */
    #confirmationModal .flex, #editConfirmationModal .flex {
        justify-content: center;
        gap: 16px;
        padding: 12px 0;
    }
    </style>
</x-app-layout>