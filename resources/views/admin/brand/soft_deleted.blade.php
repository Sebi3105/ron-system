<x-app-layout>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <div class="flex flex-col md:flex-row h-screen">
        <!-- Sidebar -->
        <div class="w-full md:w-64 fixed top-0 left-0 z-10 h-screen bg-gray-900 md:block">
            @include('layouts.navigation') 
        </div>

        <!-- Main Content -->
        <div class="flex-1 md:ml-64 mt-16 md:mt-0 bg-gray-100 text-gray-800">
            <header class="bg-gray-200 py-3 px-3 fixed top-0 md:left-64 right-0 z-20 h-16 flex items-center justify-between text-black shadow-md">
                <h1 class="text-lg font-bold">Soft Deleted Serial Numbers</h1>
            </header>

            <!-- Back Button -->
            <div class="flex justify-start mt-24 md:mt-28 px-4">
                <a href="{{ route('admin.dashboard') }}" class="back-btn flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l-7-7 7-7" />
                    </svg>
                    Back to Admin Dashboard
                </a>
            </div>

            <!-- Success and Error Messages -->
            <div class="mx-4 mt-4">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <!-- Search and Table Layout -->
            <div class="py-4 overflow-auto max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-center mb-4 gap-4">
                    <!-- Search Input -->
                    <div class="relative w-full md:w-1/2">
                        <input type="text" id="tableSearch" class="border border-gray-300 rounded-md pl-10 pr-4 py-2 w-full" placeholder="Search...">
                        <span class="absolute left-3 top-2.5 text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a7 7 0 100 14 7 7 0 000-14zM18 18l-3.5-3.5" />
                            </svg>
                        </span>
                    </div>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table id="softDeletedBrandTable" class="table-auto w-full bg-white shadow-md rounded-lg">
                        <thead class="bg-gray-300">
                            <tr ck>
                                <th class="px-4 py-2 text-left font-bold ">#</th>
                                <th class="px-4 py-2 text-left font-bold ">Brand Name</th>
                                <th class="px-4 py-2 text-left font-bold ">Deleted At</th>
                                <th class="px-4 py-2 text-left font-bold ">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($softDeletedItems as $item)
                                <tr class="border-b hover:bg-gray-100">
                                    <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-2">{{ $item->brand_name }}</td>
                                    <td class="px-4 py-2">{{ $item->deleted_at }}</td>
                                    <td class="px-4 py-2 flex gap-2">
                                        <!-- Restore Button -->
                                        <form action="{{ route('admin.brand.restore', $item->brand_id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white py-1 px-3 rounded">
                                                Restore
                                            </button>
                                        </form>
                                        <!-- Delete Permanently Button -->
                                        <form action="{{ route('admin.brand.forceDelete', $item->brand_id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded">
                                                Delete Permanently
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

    <!-- Include JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#softDeletedBrandTable').DataTable({
                paging: true,
                lengthChange: true,
                searching: false,
                ordering: true,
                info: true,
                autoWidth: false,
                responsive: true
            });
        });
    </script>

    <style>
        /* Table Styling */
        table {
            border-collapse: collapse;
            width: 100%;
            text-align: left;
        }
        th {
    background-color: #4A628A; /* Keep the dark blue background */
    color: white; /* Change text color to white */
    padding: 10px;
    font-weight: bold; /* Ensure headers are bold */
    text-align: left; /* Keep text alignment */
}
        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        tr:hover {
            background-color: #f7fafc;
        }

        /* Button Styling */
        button {
            transition: all 0.3s ease;
        }
        button:hover {
            transform: scale(1.05);
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
                .dataTables_wrapper .dataTables_paginate {
            display: flex;
            justify-content: center; /* Center the pagination horizontally */
            gap: 10px;
            padding: 10px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            display: inline-block;
            padding: 4px 8px;
            font-size: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #f9f9f9;
            transition: transform 0.2s ease, background-color 0.2s ease;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background-color: #ddd;
            transform: scale(1.05);
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background-color: #15803d;
            color: white;
            border-color: #1a73e8;
            font-weight: bold;
            transform: scale(1.1);
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
            color: #bbb;
            cursor: not-allowed;
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
    </style>
</x-app-layout>
