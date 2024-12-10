<x-app-layout>
    <div class="flex flex-col md:flex-row h-screen">
        <!-- Sidebar (Navigation) -->
        <div class="w-64 md:w-48 lg:w-64 fixed top-0 left-0 z-10 h-screen bg-gray-900">
            @include('layouts.navigation')
        </div>

        <!-- Main Content -->
        <div class="flex-1 md:ml-48 lg:ml-64 mt-0 bg-gray-100 text-gray-800">
            <!-- Fixed Header -->
            <header class="bg-gray-200 py-3 px-3 md:px-6 fixed top-0 md:left-48 lg:left-64 right-0 z-20 h-15 flex items-center justify-between text-black shadow-md">
                <h1 class="text-lg font-bold">Serial Numbers for {{ $inventoryitem->product_name }}</h1>
            </header>

            <!-- Back to Inventory Button -->
            <div class="flex justify-start mt-20 md:mt-24 px-4">
                <a href="{{ route('inventory.index') }}" class="back-btn flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l-7-7 7-7" />
                    </svg>
                    Back to Inventory
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
                    width: 80%;
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
                    padding: 14px;
                    font-size: 14px;
                    border-bottom: 1px solid #ddd;
                }

                th {
                    background-color: #4A628A;
                    color: #fff;
                }

                tr:hover {
                    background-color: #edf2f7;
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

                .insert-btn {
                    background-color: #4A628A;
                    color: #ffffff;
                    padding: 0.6rem 1.2rem;
                    font-size: 0.9rem;
                    font-weight: bold;
                    border-radius: 3px;
                    transition: background-color 0.2s ease-in-out, transform 0.2s ease-in-out;
                    text-decoration: none;

                }

                .insert-btn:hover {
                    background-color: #3b5374;
                    transform: scale(1.01);
                }

                .back-btn {
                    color: #3C3D37;
                    padding: 0.3rem 1.2rem;
                    font-size: 1rem;
                    font-weight: bold;
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

                .delete-btn {
                    background-color: #dc2626;
                    color: #fff;
                    padding: 5px 10px;
                    border: none;
                    border-radius: 3px;
                    cursor: pointer;
                    transition: background-color 0.3s;
                }

                .delete-btn:hover {
                    background-color: darkred;
                }

                .title {
                    font-size: 2rem;
                    margin: 1rem auto;
                    color: #4A628A;
                }

                #editConfirmationModal {
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
                #editConfirmationModal .bg-white {
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

                /* Header with Green Gradient */
                #editConfirmationModal h2 {
                    font-size: 22px;
                    font-weight: bold;
                    background: linear-gradient(90deg, #4CAF50, #2E7D32);
                    color: #fff;
                    text-align: center;
                    padding: 12px;
                    margin: 0;
                }

                /* Modal Text */
                #editConfirmationModal p {
                    font-size: 15px;
                    color: #4B5563;
                    text-align: center;
                    margin: 16px 0 24px;
                    line-height: 1.6;
                }

                /* Buttons */
                #editConfirmationModal button {
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

                #editConfirmationModal button:hover {
                    transform: translateY(-2px);
                    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
                }

                #editconfirmCancel {
                    background-color: #E5E7EB;
                    color: #374151;
                }

                #editconfirmCancel:hover {
                    background-color: #D1D5DB;
                }

                #editconfirmSubmit {
                    background: linear-gradient(90deg, #4CAF50, #2E7D32);
                    color: white;
                    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
                }

                #editconfirmSubmit:hover {
                    background: linear-gradient(90deg, #2E7D32, #1B5E20);
                }

                /* Icons */
                #editConfirmationModal button svg {
                    height: 18px;
                    width: 18px;
                }

                #editConfirmationModal .flex {
                    justify-content: center;
                    gap: 16px;
                    padding: 12px 0;
                }

                /* Buttons */
                #editConfirmationModal button {
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
                }

                /* Backdrop */
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

                #confirmationModal .bg-white {
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
                #confirmationModal h2 {
                    font-size: 18px;
                    /* Slightly smaller font for better fit */
                    font-weight: bold;
                    background: linear-gradient(90deg, #FF4C4C, #C62828);
                    color: #fff;
                    text-align: center;
                    padding: 12px;
                    margin: 0;
                }

                /* Modal Content */
                #confirmationModal p {
                    font-size: 16px;
                    /* Adjust text size for better fit */
                    color: #4B5563;
                    text-align: center;
                    margin: 20px 0;
                    line-height: 1.4;
                }

                /* Buttons */
                #confirmationModal .flex {
                    justify-content: center;
                    gap: 12px;
                    /* Reduce button spacing */
                    padding: 0;
                    /* Remove extra padding */
                }

                /* Buttons */
                #confirmationModal button {
                    border: none;
                    padding: 8px 20px;
                    font-size: 14px;
                    font-weight: bold;
                    border-radius: 3px;
                    cursor: pointer;
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    transition: all 0.3s ease;
                    margin-bottom: 1rem;
                }

                #confirmationModal button:hover {
                    transform: translateY(-2px);
                    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
                }

                /* Cancel Button */
                #cancelDelete {
                    background-color: #E5E7EB;
                    color: #374151;
                }

                #cancelDelete:hover {
                    background-color: #D1D5DB;
                }

                /* Delete Button with Red Gradient */
                #confirmDelete {
                    background: linear-gradient(90deg, #FF4C4C, #C62828);
                    color: white;
                    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
                }

                #confirmDelete:hover {
                    background: linear-gradient(90deg, #C62828, #B71C1C);
                }


                #custom-pagination button {
                    transition: background-color 0.3s, transform 0.3s;
                }

                #custom-pagination button:hover {
                    background-color: #4A628A;
                    color: white;
                    transform: scale(1.1);
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
                    <a href="{{ route('inventoryitem.create', ['product_id' => $inventoryitem->product_id]) }}" class="insert-btn text-sm"> + Insert New Serial</a>

                </div>
                <div class="flex space-x-4">
                    <!-- Product Details in a single column -->
                    <div class="bg-white border border-gray-300 p-4 rounded shadow-md">
                        <h2 class="text-lg font-semibold mb-2">Product Details</h2>
                        <table id="Serials" class="min-w-full">
                            <tbody>
                                <tr>
                                    <td class="py-2 px-4 border-b font-bold">Product ID:</td>
                                    <td class="py-2 px-4 border-b">{{ $inventoryitem->product_id }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-4 border-b font-bold">Product Name:</td>
                                    <td class="py-2 px-4 border-b">{{ $inventoryitem->product_name }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-4 border-b font-bold">Quantity:</td>
                                    <td class="py-2 px-4 border-b">{{ $inventoryitem->quantity }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-4 border-b font-bold">Status:</td>
                                    <td class="py-2 px-4 border-b">{{ $inventoryitem->status }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="table">
                        <table id="serials">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Serial Number</th>
                                    <th>Condition</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

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

        <div id="editConfirmationModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
            <div class="bg-white max-w-sm w-full rounded-md shadow-lg">
                <h2 class="text-lg font-bold mb-4 text-white bg-gradient-to-r from-blue-500 to-blue-700 p-4 rounded-t-lg">
                    Confirmation
                </h2>
                <p class="text-gray-700 text-center mb-6">
                    Are you sure you want to edit this item?
                </p>
                <div class="flex justify-center gap-4">
                    <button id="editcancelEdit" class="px-6 py-3 bg-gray-200 text-black rounded-md hover:bg-gray-200 transition">
                        Cancel
                    </button>
                    <button id="editconfirmEdit" class="px-6 py-3 bg-gradient-to-r from-green-500 to-green-700 text-white rounded-md hover:from-green-600 hover:to-green-800 transition">
                        Confirm
                    </button>
                </div>
            </div>
        </div>
        <script>
            let table; // Declare the table variable globally
            $(document).ready(function() {
                table = $('#serials').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('inventoryitem.serials', $inventoryitem->product_id) }}",
                    dom: 'lrtip',
                    columns: [{
                            data: null, // Use 'null' to generate row numbers
                            name: null,
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row, meta) {
                                return meta.row + 1; // Row index (starting at 0) + 1 for 1-based numbering
                            },
                        },
                        {
                            data: 'serial_number',
                            name: 'serial_number'
                        },
                        {
                            data: 'condition',
                            name: 'condition'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false,
                        },
                    ],
                });
            });

            $('#tableSearch').on('keyup', function() {
                table.search(this.value).draw();
            });

            ;
            $(document).ready(function() {
                var deleteUrl = '';

                // Show modal when delete button is clicked
                $('#serials tbody').on('click', '.delete-btn', function() {
                    deleteUrl = $(this).data('url'); // Kunin ang URL mula sa button
                    $('#confirmationModal').removeClass('hidden');
                });

                // Handle cancel button
                $('#cancelDelete').on('click', function() {
                    $('#confirmationModal').addClass('hidden');
                });

                // Handle confirm button
                $('#confirmDelete').on('click', function() {
                    $.ajax({
                        url: deleteUrl,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            alert('Item deleted successfully!');
                            $('#serials').DataTable().ajax.reload();
                            $('#confirmationModal').addClass('hidden');
                        },
                        error: function(xhr) {
                            console.log('Error deleting item:', xhr.responseText);
                            alert('An error occurred while deleting the item.');
                            $('#confirmationModal').addClass('hidden');
                        }
                    });
                });
            });


            $('#confirmDelete').on('click', function() {
                $.ajax({
                    url: deleteUrl,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function() {
                        $('#toast-success').removeClass('hidden').delay(3000).fadeOut();
                        table.ajax.reload();
                    },
                    error: function() {
                        alert('An error occurred while deleting the item.');
                    }
                });
            });

            // Handle .btn-primary clicks
            $(document).ready(function() {
                // Event delegation for dynamically added `.btn-primary` buttons
                $('#serials tbody').on('click', '.btn-primary', function(e) {
                    e.preventDefault();
                    var editUrl = $(this).attr('href');

                    // Show the confirmation modal
                    $('#editConfirmationModal').removeClass('hidden');

                    // Store the editUrl temporarily
                    $('#editconfirmEdit').data('edit-url', editUrl);
                });

                // Handle confirmation
                $('#editconfirmEdit').on('click', function() {
                    var editUrl = $(this).data('edit-url');
                    if (editUrl) {
                        window.location.href = editUrl;
                    }
                    $('#editConfirmationModal').addClass('hidden');
                });

                // Handle cancellation
                $('#editcancelEdit').on('click', function() {
                    $('#editConfirmationModal').addClass('hidden');
                });
            });
        </script>
</x-app-layout>