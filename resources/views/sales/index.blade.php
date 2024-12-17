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
                                                <a href="{{ route('sales.show', $sale->sales_id) }}" class="bg-navy-blue text-white py-1 px-2 rounded btn">View</a>
                                                <a href="{{ route('sales.edit', $sale->sales_id) }}" class="bg-green-500 text-white py-1 px-2 btn rounded">Edit</a>

                                                <!-- Delete/Archive Trigger -->
                                                <button
                                                    type="button"
                                                    onclick="openModal('{{ $sale->sales_id }}')"
                                                    class="bg-red-500 text-white py-1 px-2 delete-btn rounded">
                                                    Action
                                                </button>
                                            </td>



                                        </tr>
                                        @endforeach
                                        </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                    <!-- Modal Popup -->
                    <div id="actionModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
                        <div class="bg-white rounded-lg shadow-lg p-6 w-1/3 relative">
                            <!-- Close Button ("X") -->
                            <button
                                type="button"
                                onclick="closeModal()"
                                class="absolute top-3 right-3 text-gray-600 hover:text-gray-800 bg-gray-200 hover:bg-gray-300 rounded-full w-8 h-8 flex items-center justify-center">
                                <span class="text-xl">&times;</span>
                            </button>

                            <!-- Header -->
                            <h3 class="text-2xl font-semibold text-gray-800 mb-4">Action</h3>

                            <!-- Form -->
                            <form id="actionForm" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="sale_id" id="saleId" />

                                <div class="flex flex-col space-y-4">
                                    <button
                                        type="submit"
                                        name="delete_type"
                                        value="soft"
                                        class="bg-blue-500 text-white py-2 px-4 rounded-lg shadow hover:bg-blue-600">
                                        Archive
                                    </button>
                                    <button
                                        type="submit"
                                        name="delete_type"
                                        value="hard"
                                        class="bg-red-500 text-white py-2 px-4 rounded-lg shadow hover:bg-red-600">
                                        Delete
                                    </button>
                                </div>
                            </form>
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

                        function openModal(salesId) {
                            // Show the modal
                            document.getElementById('actionModal').classList.remove('hidden');
                            // Set the sale ID in the form
                            document.getElementById('saleId').value = salesId;
                            // Update the form action URL dynamically
                            document.getElementById('actionForm').action = `/sales/${salesId}`;
                        }

                        function closeModal() {
                            // Hide the modal
                            document.getElementById('actionModal').classList.add('hidden');
                        }
                    </script>




                    <style>
                        body {
                            background-color: #E5E7EB;
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