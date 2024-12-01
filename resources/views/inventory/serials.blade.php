<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serial Numbers for {{ $inventoryitem->product_name }}</title>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fc;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }
        .container {
            width: 75%; /* Increased width */
            max-width: 1100px; /* Max width to avoid the content being too stretched */
            margin: 2rem auto;
            padding: 2rem;
            background-color: #ffffff;
            border-radius: 0.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
            font-size: 2rem; /* Increased font size for readability */
            margin-bottom: 3rem; /* Adjusted margin */
        }
        .create_link a {
            background-color: #4a628a;
            color: #fff;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s;
            width: 100%;
            max-width: 250px; /* Ensured the button doesn't stretch too wide */
            margin: 0 auto;
        }

        .create_link a:hover {
            background-color: #3b5072;
        }

        .table {
            width: 100%;
            margin-top: 2rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 12px; /* Increased padding for more space */
            text-align: left;
            font-size: 16px; /* Increased font size for readability */
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

        .btn-primary {
            text-decoration: none;
            color: #fff;
            padding: 6px 12px;
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
            padding: 6px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .delete-btn:hover {
            background-color: darkred;
            color: #fff;
        }

        /* DataTables search input styling */
        .dataTables_filter input {
            border: 1px solid #d1d5db;
            padding: 0.8rem 1.2rem;
            border-radius: 0.5rem;
            width: 250px;
            background-color: #f9fafb;
            transition: all 0.3s;
            margin-bottom: 1.5rem;
            font-size: 1rem;
        }
        .dataTables_filter input:hover,
        .dataTables_filter input:focus {
            box-shadow: 0 0 10px rgba(37, 99, 235, 0.4);
            border-color: #1d4ed8;
            outline: none;
        }

        /* DataTables pagination styling */
        .dataTables_wrapper .dataTables_paginate .paginate_button {
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
            transform: scale(1.1);
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background-color: #4a628a;
            color: #fff;
            border-color: #4a628a;
            transform: scale(1.1);
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Serials for {{ $inventoryitem->product_name }}</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container mx-auto p-4">
        <h1>Serial Numbers for {{ $inventoryitem->product_name }}</h1>
        <div class=" flex justify-between items-center mb-4 create_link">
        <a href="{{ route('inventoryitem.create', ['product_id' => $inventoryitem->product_id]) }}"> Insert New Product Serial</a>
        </div>
        <div class="flex space-x-4">
        <!-- Product Details in a single column -->
        <div class="bg-white border border-gray-300 p-4 rounded shadow-md">
            <h2 class="text-lg font-semibold mb-2">Product Details</h2>
            <table class="min-w-full">
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
        <div class="flex items-center mb-4">
    <label for="statusFilter" class="mr-2">Filter by Status:</label>
    <select id="statusFilter" class="border rounded p-2">
        <option value="">All</option>
        <option value="working">Working</option>
        <option value="defective">Defective</option>
    </select>
    <button id="filterButton" class="bg-blue-500 text-white p-2 rounded ml-2">Filter</button>
</div>
        <div class="table">
    <table id="serials">
        <thead>
            <tr>
                <th>#</th> <!-- Change SKU ID to # -->
                <th>Serial Number</th>
                <th>Condition</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
<div class="mt-4">
        <a href="{{ route('inventory.index') }}" class="text-blue-500 hover:underline">Back to Inventory</a>
    </div>
</div>

<script>
 $(document).ready(function() {
    var table = $('#serials').DataTable({
        processing: true,
        serverSide: true,
        ajax: function(data, callback, settings) {
            data.status = $('#statusFilter').val(); // Get the selected status filter
            $.ajax({
                url: "{{ route('inventoryitem.serials', $inventoryitem->product_id) }}",
                type: 'GET',
                data: data,
                success: function(response) {
                    callback(response); // Pass the response to DataTables
                }
            });
        },
        columns: [
            { 
                data: null,
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                },
                orderable: false
            },
            { data: 'serial_number', name: 'serial_number' },
            { data: 'condition', name: 'condition' },
            { 
                data: 'action', 
                name: 'action', 
                orderable: false, 
                searchable: false 
            }
        ]
    });

    // Filter button handling
    $('#filterButton').on('click', function() {
        table.ajax.reload(); // Reload the table with the new filter value
    });

    // Delete button handling
    $('#serials tbody').on('click', '.delete-btn', function() {
        var deleteUrl = $(this).data('url');
        if (confirm('Are you sure you want to delete this item?')) {
            $.ajax({
                url: deleteUrl,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
 },
                success: function(response) {
                    table.ajax.reload(); // Reload the table after deletion
                    alert(response.message); // Show success message
                },
                error: function(xhr) {
                    alert('Error deleting item: ' + xhr.responseText); // Show error message
                }
            });
        }
    });
});
</script>
</body>
</html>