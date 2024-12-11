<x-app-layout>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <div class="flex flex-col md:flex-row h-screen  bg-gray-200 min-w-full">
        <div class="flex-1 ml-64 mt-0 min-h-screen bg-gray-200">
            <!-- Content Section -->
            <div class="max-w-7xl mx-auto px-4 sm:text-left lg:px-8 mt-4 mb-6 bg-gray-200">
                <!-- Header Inside Content -->
                <div class="relative pt-16">
                    <h1 class="text-2xl px-10 font-semibold text-gray-500 absolute top-5">Sales</h1>
                </div>

                <div class="max-w-7xl mx-auto px-4 sm:text-left lg:px-8 mt-6 mb-6 flex flex-col md:flex-row items-center justify-between">
                    <!-- Search Bar -->
                    <div class="flex-1 flex justify-start mb-4 md:mb-0">
                        <div class="relative w-1/2 md:w-1/2">
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
                    <div class="flex items-start space x-4  mb-4 md:mb-0">
                        <!-- Action Buttons -->
                        <a href="{{ route('sales.create') }}" class="bg-navy-blue text-white py-2 px-4 rounded hover:bg-navyblue">+ Add New Sale </a>
                    </div>
                </div>
            </div>        
                    @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

            <!-- Tables -->      
<div class="table-container py-4 max-h-[500px] max-w-7xl mx-auto px-4 sm:text-left lg:px-8">
    <div class="p-4 sm:text-left bg-gray-200">
        <div>
            <table id="sales" class="min-w-full table-fixed bg-gray-200 text-gray-500">
                <thead class="text-gray-500 bg-gray-200">
                    <tr>
                        <th class="w-10 p-1 text-center bg-gray-100 border-b border-gray-300">#</th>
                        <th class="w-20 p-1 text-center bg-gray-100 border-b border-gray-300">Customer Name</th>
                        <th class="w-20 p-1 text-center bg-gray-100 border-b border-gray-300">Product Name</th>
                        <th class="w-20 p-1 text-center bg-gray-100 border-b border-gray-300">Serial Number</th>
                        <th class="w-16 p-1 text-center bg-gray-100 border-b border-gray-300">State</th>
                        <th class="w-20 p-1 text-center bg-gray-100 border-b border-gray-300">Sale Date</th>
                        <th class="w-20 p-1 text-center bg-gray-100 border-b border-gray-300">Amount</th>
                        <th class="w-18 p-1 text-center bg-gray-100 border-b border-gray-300"">Actions</th>
                    </tr>
                </thead>
                <tbody class=" bg-gray-200">
                                            @foreach($sales as $key => $sale)
                                    <tr>
                                        <td class="p-2 border-b border-gray-400">{{ $key + 1 }}</td>
                                        <td class="p-2 border-b border-gray-400">{{ $sale->customer->name ?? 'N/A' }}</td>
                                        <td class="p-2 border-b border-gray-400">{{ $sale->inventory->product_name ?? 'N/A' }}</td>
                                        <td class="p-2 border-b border-gray-400">{{ $sale->inventoryItem->serial_number }}</td>
                                        <td class="p-2 border-b border-gray-400">{{ $sale->state }}</td>
                                        <td class="p-2 border-b border-gray-400">{{ $sale->sale_date->format('Y-m-d') }}</td>
                                        <td class="p-2 border-b border-gray-400">{{ number_format($sale->amount, 2) }}</td>
                                        <td class="p-2 border-b border-gray-400">
                                        <a data-url="{{ route('sales.show', $sale->sales_id) }}" class="bg-navy-blue text-white py-1 px-2 rounded view-btn">View</a>
                                            <a href="{{ route('sales.edit', $sale->sales_id) }}" class="bg-green-500 text-white py-1  btn-primary px-2 rounded">Edit</a>

                                            <!-- Delete Form -->
                                            <form action="{{ route('sales.destroy', $sale->sales_id) }}" method="POST" class="inline-flex items-center space-x-2">
                                                @csrf
                                                @method('DELETE')
                                                <select name="delete_type" class="mr-2">
                                                    <option value="soft">Archive</option>
                                                    <option value="hard">Delete</option>
                                                </select>
                                                <button type="submit" class="bg-red-500 text-white py-1 px-2  delete-btn rounded">Delete</button>
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
                        <h2 class="text-lg font-bold mb-4 text-white bg-gradient-to-r from-red-500 to-red-700 p-4 rounded-t-lg text-center">
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
            </div>
        </div>

        <!-- Edit Confirmation Modal -->
        <div id="editConfirmationModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
            <div class="bg-white max-w-sm w-full rounded-md shadow-lg">
                <h2 class="text-lg font-bold mb-4 text-white bg-gradient-to-r from-green-500 to-green-700 p-4 rounded-t-lg text-center">
                    Confirmation
                </h2>
                <p class="text-gray-700 text-center mb-6">
                    Are you sure you want to edit this item?
                </p>
                <div class="flex justify-center gap-4">
                    <button id="editcancelEdit" class="px-6 py-3 bg-gray-400 text-white rounded-md hover:bg-gray-500 transition">
                        Cancel
                    </button>
                    <button id="editconfirmEdit" class="px-6 py-3 bg-gradient-to-r from-green-500 to-green-700 text-white rounded-md hover:from-green-600 hover:to-green-800 transition">
                        Confirm
                    </button>
                </div>
            </div>
        </div>
        
            <!-- view Confirmation Modal -->
    <div id="viewConfirmationModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
        <div class="bg-white max-w-sm w-full rounded-md shadow-lg">
            <h2 class="text-lg font-bold mb-4 text-white bg-gradient-to-r from-blue-500 to-blue-700 p-4 rounded-t-lg">
                Confirmation
            </h2>
            <p class="text-gray-700 text-center mb-6">
                Are you sure you want to view this item?
            </p>
            <div class="flex justify-center gap-4">
                <button id="cancelView" class="px-6 py-3 bg-gray-200 text-black rounded-md hover:bg-gray-300 transition">
                    Cancel
                </button>
                <button id="confirmView" class="px-6 py-3 bg-gradient-to-r from-green-500 to-green-700 text-white rounded-md hover:from-green-600 hover:to-green-800 transition">
                    Confirm
                </button>
            </div>
        </div>
    </div>

        <script src="{{ asset('js/confirmation.js') }}"></script>
        <script>
            $(document).ready(function() {
                // Initialize the DataTable
                var table = $('#sales').DataTable({
                    paging: true,
                    info: true,
                    order: [
                        [0, 'asc']
                    ], // Sorting the table by the first column
                    searching: true, // Enable the search functionality
                    dom: 'lrtip',
                });

                // Custom search functionality linked to the search input field
                $('#tableSearch').on('keyup', function() {
                    table.search(this.value).draw(); // Apply search to the DataTable
                });

                // Edit confirmation modal logic
                $('#sales tbody').on('click', '.btn-primary', function(e) {
                    e.preventDefault();
                    var editUrl = $(this).attr('href');

                    // Show the confirmation modal
                    $('#editConfirmationModal').removeClass('hidden');

                    // Handle confirmation
                    $('#editconfirmEdit').on('click', function() {
                        window.location.href = editUrl;
                    });

                    // Handle cancellation
                    $('#editcancelEdit').on('click', function() {
                        $('#editConfirmationModal').addClass('hidden');
                    });
                });

                // Delete confirmation logic
                $('#sales tbody').on('click', '.delete-btn', function() {
                    var deleteUrl = $(this).data('url');
                    $('#confirmationModal').removeClass('hidden');

                    $('#confirmDelete').off('click').on('click', function() {
                        $.ajax({
                            url: deleteUrl,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function() {
                                alert('Item deleted successfully!');
                                table.ajax.reload(); // Reload the table after deletion
                                $('#confirmationModal').addClass('hidden');
                            },
                            error: function(xhr) {
                                console.error(xhr.responseText);
                                alert('Error deleting item!');
                                $('#confirmationModal').addClass('hidden');
                            }
                        });
                    });

                    $('#cancelDelete').on('click', function() {
                        $('#confirmationModal').addClass('hidden');
                    });
                });
            });
            $('#sales tbody').on('click', '.view-btn', function (event) {
    event.preventDefault(); // Prevent default navigation
    var viewUrl = $(this).data('url'); // Get the URL from the data-url attribute
    $('#viewConfirmationModal').removeClass('hidden'); // Show the modal

    // Handle confirmation
    $('#confirmView').off('click').on('click', function () {
        window.location.href = viewUrl; // Navigate to the URL
    });

    // Handle cancellation
    $('#cancelView').on('click', function () {
        $('#viewConfirmationModal').addClass('hidden'); // Hide the modal
    });
});

        </script>




        <style>
            body {
                background-color: #E5E7EB;
            }

            /* Modal Styles */
            #confirmationModal,
        #editConfirmationModal,
        #viewConfirmationModal {
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

        #confirmationModal .bg-white,
        #editConfirmationModal .bg-white,
        #viewConfirmationModal .bg-white {
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

        #confirmationModal h2,
        #editConfirmationModal h2,
        #viewConfirmationModal h2 {
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

        #editConfirmationModal h2 {
            background: linear-gradient(90deg, #4CAF50, #2E7D32);
            color: #fff;
        }

        #viewConfirmationModal h2 {
            background: linear-gradient(90deg, #2196F3, #1976D2);
            color: white;
        }

        #confirmationModal p,
        #editConfirmationModal p,
        #viewConfirmationModal p {
            font-size: 16px;
            color: #4B5563;
            text-align: center;
            margin: 20px 0;
            line-height: 1.4;
        }

        #confirmationModal .flex,
        #editConfirmationModal .flex,
        #viewConfirmationModal .flex {
            justify-content: center;
            gap: 12px;
            padding: 0;
        }

        #confirmationModal button,
        #editConfirmationModal button,
        #viewConfirmationModal button {
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

        #confirmationModal button:hover,
        #editConfirmationModal button:hover,
        #viewConfirmationModal button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        #cancelDelete,
        #editconfirmCancel,
        #viewConfirmationModal #cancelView {
            background-color: #E5E7EB;
            color: #374151;
        }

        #cancelDelete:hover,
        #editconfirmCancel:hover,
        #viewConfirmationModal #cancelView:hover {
            background-color: #D1D5DB;
        }

      
        #editconfirmSubmit,
        #viewConfirmationModal #confirmView {
            background: linear-gradient(90deg, #2196F3, #1976D2);
            color: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

      
        #editconfirmSubmit:hover,
        #viewConfirmationModal #confirmView:hover {
            background: linear-gradient(90deg, #1976D2, #1565C0);
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
        </style>
</x-app-layout>