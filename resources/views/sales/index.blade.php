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


                <div class="success_pop mb-4">
                    @if(session()->has('success'))
                    <div class="bg-green-500 text-white p-2 rounded">
                        {{ session('success') }}
                    </div>
                    @endif
                </div>

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
                                <tbody class="bg-gray-200">
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
                                            <a href="{{ route('sales.show', $sale->sales_id) }}" class="bg-navy-blue text-white py-1 px-2 rounded btn view-btn">View</a>
                                            <a href="{{ route('sales.edit', $sale->sales_id) }}" class="bg-green-500 text-white py-1  btn-primary px-2 btn rounded">Edit</a>

                                            <!-- Delete Form -->
                                            <form id="deleteForm" action="{{ route('sales.destroy', $sale->sales_id) }}" method="POST" class="inline-flex items-center space-x-2">
                                                @csrf
                                                @method('DELETE')
                                                <select name="delete_type" class="mr-2">
                                                    <option value="soft">Archive</option>
                                                    <option value="hard">Delete</option>
                                                </select>
                                                <button type="submit" id="triggerDeleteModal" class="bg-red-500 text-white py-1 px-2 delete-btn rounded">Submit</button>
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


                    });
                    // Delete confirmation logic
                    $(document).ready(function() {
                        // Show modal when delete is triggered
                        $('#triggerDeleteModal').on('click', function(e) {
                            e.preventDefault(); // Prevent default button behavior
                            $('#confirmationModal').removeClass('hidden'); // Show modal
                        });

                        // Confirm delete
                        $('#confirmDelete').off('click').on('click', function() {
                            $('#deleteForm').submit(); // Submit form manually
                        });

                        // Cancel delete
                        $('#cancelDelete').on('click', function() {
                            $('#confirmationModal').addClass('hidden'); // Hide modal
                        });
                    });
                </script>




                <style>
                    body {
                        background-color: #E5E7EB;
                    }

                    #confirmationModal,
                    #editConfirmationModal,
                    #viewConfirmationModal {
                        z-index: 1000;
                        backdrop-filter: blur(8px);
                        /* Enhanced blur effect */
                        animation: fadeInBackdrop 0.4s ease-out;
                        display: none;
                        /* Hidden by default */
                        position: fixed;
                        inset: 0;
                        flex-direction: column;
                        align-items: center;
                        justify-content: center;
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
                        background-color: #fff;
                        border-radius: 12px;
                        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
                        animation: modalEntry 0.4s ease-out;
                        max-width: 450px;
                        margin: 0 20px;
                        padding: 20px;
                    }

                    @keyframes modalEntry {
                        from {
                            opacity: 0;
                            transform: translateY(-20px);
                        }

                        to {
                            opacity: 1;
                            transform: translateY(0);
                        }
                    }

                    #confirmationModal h2,
                    #editConfirmationModal h2,
                    #viewConfirmationModal h2 {
                        font-size: 20px;
                        font-weight: 600;
                        text-align: center;
                        padding: 15px;
                        color: #fff;
                        border-radius: 8px 8px 0 0;
                        margin: 0;
                    }

                    #confirmationModal h2 {
                        background: linear-gradient(90deg, #FF4C4C, #C62828);
                    }

                    #editConfirmationModal h2 {
                        background: linear-gradient(90deg, #4CAF50, #2E7D32);
                    }

                    #viewConfirmationModal h2 {
                        background: linear-gradient(90deg, #2196F3, #1976D2);
                    }

                    #confirmationModal p,
                    #editConfirmationModal p,
                    #viewConfirmationModal p {
                        font-size: 16px;
                        color: #4B5563;
                        text-align: center;
                        margin: 20px 0;
                        line-height: 1.4;
                        font-weight: 400;
                    }

                    #confirmationModal .flex,
                    #editConfirmationModal .flex,
                    #viewConfirmationModal .flex {
                        justify-content: center;
                        gap: 16px;
                        padding: 0;
                    }

                    #confirmationModal button,
                    #editConfirmationModal button,
                    #viewConfirmationModal button {
                        border: none;
                        padding: 10px 20px;
                        font-size: 16px;
                        font-weight: bold;
                        border-radius: 5px;
                        cursor: pointer;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        gap: 8px;
                        transition: all 0.3s ease;
                        margin-top: 12px;
                    }

                    #confirmationModal button:hover,
                    #editConfirmationModal button:hover,
                    #viewConfirmationModal button:hover {
                        transform: translateY(-2px);
                        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
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
                        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
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