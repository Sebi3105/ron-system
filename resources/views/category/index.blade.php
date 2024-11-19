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
                <h1 class="text-lg font-bold">Category List</h1>
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
                /* General styling with Poppins font */
                body {
                    font-family: 'Poppins';
                }
                
                /* Responsive Sidebar */
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
                }

                /* Responsive Container */
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

                /* Table styling */
                /* Table styling */
                .table {
                    width: 80%;
                    color: #4a5568;
                    border-radius: 8px;
                    overflow: hidden;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                    border-collapse: collapse; /* Collapse borders */
                }

                th, td {
                    padding: 14px;
                    font-size: 14px;
                    border-bottom: 1px solid #ddd; /* Line between rows */
                }
                th{
                    background-color: #4A628A;
                    color: #fff;
                }

                tr:hover {
                    background-color: #edf2f7;
                }



                /* Responsive pagination */
                @media (max-width: 768px) {
                    .dataTables_length, .insert-btn, .dataTables_paginate {
                        width: 100%;
                        text-align: center;
                        margin: 0 auto;
                    }
                    .insert-btn {
                        width: 100%; 
                        text-align: center; 
                        margin-left: 0; 
                        padding: 0.6rem; 
                    }
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

                .dataTables_length select:focus {
                    border-color: #4A628A;
                }

                .btn-primary {
                    text-decoration: none;
                    color: #fff;
                    padding: 7px 10px;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                    transition: background-color 0.3s;
                    background-color: #1A9945;
                }

                .btn-primary:hover {
                    background-color: #15803d;
                }

                .delete-btn {
                    background-color: #dc2626;
                    color: #fff;
                    padding: 5px 10px;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                    transition: background-color 0.3s;
                }

                .delete-btn:hover {
                    background-color: darkred;
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
    background-color: #333; /* Changed to blue */
    color: #fff;
    transform: scale(1.05);
}

.dataTables_wrapper .dataTables_paginate .paginate_button.current {
    background-color: #4A628A;
    color: green;
    border-color: #1a73e8;
    font-weight: bold;
    transform: scale(1.1);
    box-shadow: 0 0 5px rgba(0, 0, 0, 1);
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
    background-color: #4A628A; /* Changed to blue */
    color: #fff;
}


                .insert-btn {
                    background-color: #4A628A;
                    color: #ffffff;
                    padding: 0.6rem 1.2rem;
                    font-size: 0.9rem;
                    font-weight: bold;
                    border-radius: 0.375rem;
                    transition: background-color 0.2s ease-in-out, transform 0.2s ease-in-out;
                    text-decoration: none;
                }

              
                .insert-btn:hover {
                    background-color: #3b5374;
                }
                .back-btn {
                    color: #3C3D37;
                    padding: 0.3rem 1.2rem;
                    font-size: 1rem;
                    font-weight: bold;
                    border-radius: 0.375rem;
                    transition: background-color 0.2s ease-in-out, transform 0.2s ease-in-out;
                    text-decoration: none;
                    margin-left: 2rem;

                }
                .back-btn:hover {
                    left: 0;
                }
                .back-btn svg {
                    transition: transform 0.2s ease;
                }

                .back-btn:hover svg {
                    transform: translateX(-5px); /* Move the arrow slightly */
                }

            </style>
            <div class="container mx-auto p-4">
                <div class="flex flex-col md:flex-row justify-between items-center mb-4 gap-4">
                    <div class="dataTables_length"></div>
            <a href="{{ route('category.create') }}" class="insert-btn text-sm">+ Insert New Category</a>
                    <div class="relative w-full md:w-1/2">
                        <input type="text" id="tableSearch" class="border border-gray-300 rounded-md pl-10 pr-4 py-2 w-full" placeholder="Search...">
                        <span class="absolute left-3 top-2.5 text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a7 7 0 100 14 7 7 0 000-14zM18 18l-3.5-3.5" />
                            </svg>
                        </span>
                    </div>
                </div>

                <div class="table-container">
                    <table id="category" class="table mx-auto">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Category Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>    
                        <tbody>
                            <!-- Data will be populated by DataTables -->
                        </tbody>
                    </table>
                </div>
            </div>

            <script src="{{ asset('js/confirmation.js') }}"></script>
            <script>
                $(document).ready(function() {
                    var table = $('#category').DataTable({
                        processing: true,
                        serverSide: true,
                        responsive: true,
                        ajax: "{{ route('category.index') }}",
                        dom: 'lrtip',
                        columns: [
                            { data: null, orderable: false, render: function(data, type, row, meta) {
                                    return meta.row + meta.settings._iDisplayStart + 1;
                                }
                            },
                            { data: 'category_name', name: 'category_name' },
                            {data: 'action',name: 'action',orderable: false, searchable:false}
                        ]
                    });

                    $('#category tbody').on('click', '.delete-btn', function() {
                        var deleteUrl = $(this).data('url');
                        if (confirm('Are you sure you want to delete this item?')) {
                            $.ajax({
                                url: deleteUrl,
                                type: 'DELETE',
                                data: { _token: '{{ csrf_token() }}' },
                                success: function(response) {
                                    alert('Item deleted successfully!');
                                    table.ajax.reload();
                                },
                                error: function(xhr) {
                                    console.log('Error deleting item: ' + (xhr.responseJSON.message || 'An unexpected error occurred.'));
                                }
                            });
                        }
                    });

                    $('#tableSearch').on('keyup', function() {
                        table.search(this.value).draw();
                    });
                });
                // Automatically refresh layout adjustments on window resize
                window.addEventListener('resize', function() {
    location.reload(); // Automatic na magre-refresh ang page
});


            </script>
        </div>
    </div>
</x-app-layout>
