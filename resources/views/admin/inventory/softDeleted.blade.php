<x-app-layout>
    <div class="flex flex-col md:flex-row h-screen">
        <!-- Sidebar (Navigation) -->
        <div class="w-64 md:w-48 lg:w-64 fixed top-0 left-0 z-10 h-screen bg-gray-900">
            @include('layouts.navigation')
        </div>

        <!-- Main Content -->
        <div class="flex-1 md:ml-48 lg:ml-64 mt-0 bg-gray-100 text-gray-800">
            <!-- Fixed Header -->
            <header class="bg-gray-200 py-3 px-3 md:px-6 fixed top-0 md:left-48 lg:left-64 right-0 z-20 h-16 flex items-center justify-between text-black shadow-md">
                <h1 class="text-lg font-bold">Inventory</h1>
            </header>

            <!-- Back to Inventory Button -->
            <div class="flex justify-start mt-20 md:mt-24 px-4">
                <a href="{{ route('admin.archives') }}" class="back-btn flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l-7-7 7-7" />
                    </svg>
                    Back to Archives
                </a>
            </div>

            <!-- Include jQuery and DataTables -->
            <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
            <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
            <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

            <style>
                body {
                    font-family: 'Poppins';
                    background-color: #F3F4F6;
                }

                @media (max-width: 768px) {
                    .fixed {
                        position: static;
                        width: 100%;
                        height: auto;
                    }

                    header {
                        left: 0;
                        padding-left: 1rem;
                    }

                    .insert-btn {
                        width: 100%;
                        text-align: center;
                        margin-left: 0;
                        padding: 0.6rem;
                    }
                }

                .container {
                    width: 95%;
                    max-width: 1000px;
                    margin: 1rem auto 2rem auto;
                    padding: 1rem;
                    background-color: #ffffff;
                    border-radius: 0.5rem;
                    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                    text-align: center;
                }

                .table {
                    width: 100%;
                    color: #4a5568;
                    border-radius: 3px;
                    overflow: hidden;
                    border-collapse: collapse;
                }

                th,
                td {
                    padding: 10px;
                    font-size: 12px;
                    border-bottom: 1px solid #ddd;
                }

                th {
                    background-color: #4A628A;
                    color: #fff;
                }

                tr:hover {
                    background-color: #edf2f7;
                }

                table tbody td {
                    text-align: center;
                    vertical-align: middle;
                    /* Centers vertically */
                }

                table tbody td.flex {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    gap: 0.5rem;
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


                .back-btn {
                    color: #3C3D37;
                    padding: 0.3rem 1.2rem;
                    font-size: 1rem;

                    border-radius: 0.375rem;
                    transition: transform 0.3s ease;
                    text-decoration: none;
                    margin-left: 2rem;
                    margin-top: -1rem;
                    display: inline-flex;
                    align-items: center;
                    gap: 0.5rem;
                }

                .back-btn:hover {
                    transform: translateX(-5px);
                }

                .back-btn svg {
                    transition: transform 0.3s ease;
                }

                .back-btn:hover svg {
                    transform: translateX(-8px);
                }

                .btn-primary {
                    text-decoration: none;
                    color: #fff;
                    padding: 7px 10px;
                    border: none;
                    border-radius: 3px;
                    cursor: pointer;
                    transition: background-color 0.3s;
                    background-color: #1A9945;
                }

                .btn-primary:hover {
                    background-color: #15803d;
                    transform: scale(1.05);
                }

                #confirmationModal {
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

                /* Modal Style */
                #confirmationModal .bg-white {
                    border-radius: 10px;
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

                /* Header with Green Gradient */
                #confirmationModal h2 {
                    font-size: 22px;
                    font-weight: bold;
                    background: linear-gradient(90deg, #4CAF50, #2E7D32);
                    color: #fff;
                    text-align: center;
                    padding: 12px;
                    margin: 0;
                }

                /* Modal Text */
                #confirmationModal p {
                    font-size: 15px;
                    color: #4B5563;
                    text-align: center;
                    margin: 16px 0 24px;
                    line-height: 1.6;
                }

                /* Buttons */
                #confirmationModal button {
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

                #confirmationModal button:hover {
                    transform: translateY(-2px);
                    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
                }

                #saveconfirmCancel {
                    background-color: #E5E7EB;
                    color: #374151;
                }

                #saveconfirmCancel:hover {
                    background-color: #D1D5DB;
                }

                #confirmSubmit {
                    background: linear-gradient(90deg, #4CAF50, #2E7D32);
                    color: white;
                    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
                }

                #confirmSubmit:hover {
                    background: linear-gradient(90deg, #2E7D32, #1B5E20);
                }

                #confirmationModal .flex {
                    justify-content: center;
                    gap: 16px;
                    padding: 12px 0;
                }

                /* Buttons */
                #confirmationModal button {
                    border: none;
                    padding: 10px 20px;
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

                #cancelModal {
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

                #cancelModal .bg-white {
                    border-radius: 12px;
                    overflow: hidden;
                    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
                    animation: modalEntry 0.4s ease-out;
                    width: 100%;
                    max-width: 400px;
                    /* Limit the maximum width */
                    margin: 0 auto;
                    /* Center it horizontally */
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

                /* Header with Red Gradient */
                /* Modal Header */
                #cancelModal h2 {
                    font-size: 22px;
                    /* Slightly smaller font for better fit */
                    font-weight: bold;
                    background: linear-gradient(90deg, #FF4C4C, #C62828);
                    color: #fff;
                    text-align: center;
                    padding: 12px;
                    margin: 0;
                }

                /* Modal Content */
                #cancelModal p {
                    font-size: 16px;
                    /* Adjust text size for better fit */
                    color: #4B5563;
                    text-align: center;
                    margin: 16px 0 28px;
                    line-height: 1.4;
                }

                /* Buttons */
                #cancelModal .flex {
                    justify-content: center;
                    gap: 12px;
                    /* Reduce button spacing */
                    padding: 0;
                    /* Remove extra padding */
                }

                /* Equal-width buttons with max width */
                #cancelModal button,
                #cancelModal a {
                    margin-top: 0.5rem;
                    margin-bottom: 1rem;
                    border: none;
                    padding: 9px 20px;
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

                #cancelModal button:hover,
                #cancelModal a:hover {
                    transform: translateY(-2px);
                    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
                }

                /* Cancel Button */
                #cancelCancel {
                    background-color: #E5E7EB;
                    color: #374151;
                }

                #cancelCancel:hover {
                    background-color: #D1D5DB;
                }
            </style>
            
            <div class="container mx-auto p-4">
                <div class="flex flex-col md:flex-row justify-between items-center mb-4 gap-4">
                    <div class="relative w-full md:w-1/2">
                        <input type="text" id="tableSearch" class="border border-gray-300 rounded-md pl-10 pr-4 py-2 w-full" placeholder="Search...">
                        <span class="absolute left-3 top-2.5 text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a7 7 0 100 14 7 7 0 000-14zM18 18l-3.5-3.5" />
                            </svg>
                        </span>
                    </div>
                    <div class="dataTables_length"></div>


                </div>
                <div class="flex space-x-4">

                    <div class="table">
                        <table id="serials">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Delete At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($softDeletedItems as $item)
                                <tr class="border-b hover:bg-gray-100">
                                    <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-2">{{ $item->product_name }}</td>
                                    <td class="px-4 py-2">{{ $item->deleted_at }}</td>
                                    <td class="px-4 py-2 flex gap-2">
                                        <!-- Restore Button -->
                                        <form action="{{ route('admin.inventory.restore', $item->product_id) }}" id="categorydel" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white py-1 px-3 rounded" id="saveCategoryButton">
                                                Restore
                                            </button>
                                        </form>
                                        <!-- Delete Permanently Button -->
                                        <form action="{{ route('admin.inventory.forceDelete', $item->product_id) }}" id="categorydel" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" id="cancelconfirmationModal" class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded">
                                                Delete
                                            </button>
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

        <!-- Confirmation Modal -->
        <div id="confirmationModal" class="hidden fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
            <div class="bg-white max-w-sm w-full rounded-md shadow-lg">
                <h2 class="text-lg font-bold mb-4 text-white bg-gradient-to-r from-red-500 to-red-700 p-4 rounded-t-lg">
                    Confirmation
                </h2>
                <p class="text-gray-700 text-center mb-6">
                    Are you sure you want to restore this item?
                </p>
                <div class="flex justify-center gap-4">
                    <button id="cancelConfirmationButton" class="px-6 py-3 bg-gray-400 text-white rounded-md hover:bg-gray-500 transition">
                        Cancel
                    </button>
                    <button id="confirmSubmitButton" class="px-6 py-3 bg-gradient-to-r from-green-500 to-green-700 text-white rounded-md hover:from-green-600 hover:to-green-800 transition">
                        Confirm
                    </button>
                </div>
            </div>
        </div>


        <!-- Cancel Modal -->
        <div id="cancelModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
            <div class="bg-white max-w-sm w-full rounded-md shadow-lg">
                <h2 class="text-lg font-bold mb-4 text-white bg-gradient-to-r from-yellow-500 to-yellow-700 p-4 rounded-t-lg">
                    Confirmation
                </h2>
                <p class="text-gray-700 text-center mb-6">
                    Are you sure you want to delete<br> this permanetly?
                </p>
                <div class="flex justify-center gap-4">
                    <button id="cancelModalClose" class="px-6 py-3 bg-gray-200 text-black rounded-md hover:bg-gray-200 transition">
                        Cancel
                    </button>
                    <a href="{{ route('admin.inventory.softDeleted') }}" id="confirmCancel" class="px-6 py-3 bg-gradient-to-r from-red-500 to-red-700 text-white rounded-md hover:from-red-600 hover:to-red-800 transition">
                        Confirm
                    </a>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function() {
                // Initialize DataTable with desired options
                const table = $('#serials').DataTable({
                    paging: true,
                    lengthChange: true,
                    searching: true,
                    ordering: true,
                    info: true,
                    autoWidth: false,
                    responsive: true,
                    dom: 'lrtip',
                    language: {
                        lengthMenu: "Show _MENU_ entries ",
                        search: "Filter records:"
                    }
                });

                // Custom search field functionality
                $('#tableSearch').on('keyup', function() {
                    table.search(this.value).draw();
                });
            });

            document.addEventListener('DOMContentLoaded', function() {
                const saveCategoryButton = document.getElementById('saveCategoryButton');
                const confirmationModal = document.getElementById('confirmationModal');
                const cancelConfirmationButton = document.getElementById('cancelConfirmationButton');
                const confirmSubmitButton = document.getElementById('confirmSubmitButton');
                const createUserForm = document.getElementById('categorydel');

                // Show confirmation modal when save button is clicked
                saveCategoryButton.addEventListener('click', function(event) {
                    event.preventDefault(); // Prevent the default form submission
                    confirmationModal.classList.remove('hidden');
                });

                // Close confirmation modal (cancel)
                cancelConfirmationButton.addEventListener('click', function() {
                    confirmationModal.classList.add('hidden');
                });

                // Submit form on confirm
                confirmSubmitButton.addEventListener('click', function() {
                    createUserForm.submit();
                });

                // Handle cancel modal logic
                const cancelModal = document.getElementById('cancelModal');
                const cancelModalClose = document.getElementById('cancelModalClose');

                cancelModalClose.addEventListener('click', function() {
                    cancelModal.classList.add('hidden');
                });

                document.getElementById('cancelconfirmationModal').addEventListener('click', function(event) {
                    event.preventDefault();
                    cancelModal.classList.remove('hidden');
                });
            });
        </script>

</x-app-layout>