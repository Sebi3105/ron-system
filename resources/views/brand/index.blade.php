<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RON-Sytem:Brand</title>
    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <style>
        /* General styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fc;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }
 /* Container for title and button */

        .create_link a {
            background-color: #4a628a;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .create_link a:hover {
            background-color: #3b5072;
        }


        /* Enhanced Table styling */
        .table {
            width: 200%;
            max-width: 900px;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 14px;
            text-align: left;
            font-size: 14px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4a628a;
            color: #fff;
            font-weight: bold;
        }

        tr:hover {
            background-color: #e0ebf6;
            cursor: pointer;
        }

        /* Stylish Action Button Styling */
        .btn-primary {
            text-decoration: none;
            color: #fff;
            padding: 5px 5px;
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
            text-decoration: none;
            color: #fff;
            padding: 2px 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .delete-btn:hover {
            background-color: darkred;
            color: #fff;
        }

        .dataTables_filter input {
            border: 1px solid #d1d5db;
            padding: 0.8rem 1.2rem;
            border-radius: 0.5rem;
            width: 300px;
            transition: all 0.3s ease-in-out;
            margin-bottom: 1.5rem; /* Adds space below the search input */
            font-size: 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            background-color: #f9fafb;
        }

        /* Search input on hover and focus */
        .dataTables_filter input:hover {
            box-shadow: 0 4px 8px rgba(37, 99, 235, 0.2);
            border-color: #2563eb;
        }

        .dataTables_filter input:focus {
            outline: none;
            box-shadow: 0 0 10px rgba(37, 99, 235, 0.4);
            border-color: #1d4ed8;
        }

        /* Style DataTables pagination */

.dataTables_wrapper .dataTables_paginate .paginate_button {
    display: inline-block;
    padding: 6px 12px;
    margin: 2px;
    font-size: 14px;
    color: #333;
    border: 1px solid #ddd;
    border-radius: 50%;
    background-color: #f9f9f9;
    transition: background-color 0.3s ease, color 0.3s ease, transform 0.2s ease;
}

.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    background-color: #4a628a;
    color: #fff;
    transform: scale(1.1); /* Smooth scaling effect on hover */
}

.dataTables_wrapper .dataTables_paginate .paginate_button.current {
    background-color: #4a628a;
    color: #fff;
    border-color: #4a628a;
    transform: scale(1.1); /* Slightly larger current page button */
}

.dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
    color: #bbb;
    cursor: default;
    background-color: #f9f9f9;
    border: 1px solid #ddd;
}

/* Optional: Center-align pagination */
.dataTables_wrapper .dataTables_paginate {
    display: flex;
    justify-content: center;
    align-items: center;
}

.container {
            max-width: 200%;
            margin: 2rem auto;
            padding: 1.5rem;
            background-color: #ffffff;
            border-radius: 0.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
            font-size: 1.75rem;
            margin-bottom: 3rem;
        }

        .btn {
            padding: 0.6rem 1.2rem;
            font-size: 0.9rem;
            border-radius: 0.375rem;
            font-weight: bold;
            transition: background-color 0.2s ease-in-out, transform 0.2s ease-in-out;
        }
        .insert-btn {
            background-color: #1d4ed8;
            color: #ffffff;
        }
        .insert-btn:hover {
            background-color: #2563eb;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="container mx-auto p-4">
    <h1>Brand List</h1>
        <div class="flex justify-between items-center mb-4 create_link">
        <a href = "{{route('brand.create')}}"> + Insert New Brand</a>
        </div>
<<<<<<< Updated upstream
        @endif
    </div>
    <form method="GET" action="{{ route('brand.index') }}">
        <input type="text" name="search" placeholder="Search by name" value="{{ request()->input('search') }}">
        <button type="submit">Search</button>
        <a href="{{ route('brand.index') }}" class="clear-search">Clear Search</a>
    </form>
    <div class = "create_link">
        <a href = "{{route('brand.create')}}">Insert New Brand</a>
    </div>
    </div>
=======


>>>>>>> Stashed changes
    <div class="table">
        <table id="brand">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Brand ID</th>
                    <th>Brand Name</th>
                    <th>Created at</th>
                    <th>Updated at</th>
                    <th>Actions</th>
                </tr>
            </thead>    
            <tbody>
                <!-- Dynamic rows will be loaded here via DataTables -->
            </tbody>
        </table>
        <div class="mt-6">
            <a href="{{ route('inventory.index') }}" class="text-blue-500 hover:underline">Back to Inventory</a>
        </div>
    </div>

    <script src="{{ asset('js/confirmation.js') }}"></script>
    <script>
        $(document).ready(function(){
            var table = $('#brand').DataTable({
                processing: true,
                serverSide: true,
                searching: true, 
                ajax: "{{ route('brand.index') }}",
                columns: [
                    {
                        data: null, 
                        orderable: false, 
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {data: 'brand_id', name: 'brand_id'},
                    {data: 'brand_name', name: 'brand_name'},
                    {
                        data: 'created_at', 
                        name: 'created_at',
                        render: function(data) {
                            return new Date(data).toLocaleString();
                        }
                    },
                    {
                        data: 'updated_at', 
                        name: 'updated_at',
                        render: function(data) {
                            return new Date(data).toLocaleString();
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

<<<<<<< Updated upstream
=======

            // Edit and delete button handlers
            $('#brand tbody').on('click', '.btn-primary', function(e) {
                e.preventDefault();
                var editUrl = $(this).attr('href');
                if (confirm('Are you sure you want to edit this item?')) {
                    window.location.href = editUrl;
                }
            });
>>>>>>> Stashed changes

            $('#brand tbody').on('click', '.delete-btn', function() {
                var deleteUrl = $(this).data('url');
                console.log('Delete URL:', deleteUrl);
                if (confirm('Are you sure you want to delete this item?')) {
                    $.ajax({
                        url: deleteUrl,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
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
        });
    </script>
</body>
</html>