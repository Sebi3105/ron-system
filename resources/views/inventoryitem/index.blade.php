<x-app-layout>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <div class="flex flex-col md:flex-row h-screen">
        <!-- Sidebar (Navigation) -->
        <div class="w-64 fixed top-0 left-0 z-10 h-screen bg-gray-900">
            @include('layouts.navigation') 
        </div>

        <!-- Main Content -->
        <div class="flex-1 md:ml-64 mt-15 bg-gray-100 text-gray-800"> 
            <!-- Fixed Header -->
            <header class="bg-gray-200 py-3 px-3 fixed top-0 md:left-64 right-0 z-20 h-15 flex items-center justify-between text-black shadow-md">
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

            <style>
        body {
            font-family: 'Poppins';
            background-color: #f3f3f3;
            margin: 0;
        }
        .form-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            height: 40%;
            width: 100%; /* Adjust for responsiveness */
            text-align: center;
            margin: 2rem auto;
        }

        .stitle {
            font-size: 22px;
            color: #4A628A;
            margin-bottom: 20px;
            font-weight: bold;
        }

        label {
            display: block;
            font-size: 16px;
            color: #333;
            margin-bottom: 5px;
            text-align: left;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
            margin-bottom: 5px;
            margin-top: 10px;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .button-group button,
        .button-group .exit-btn {
            padding: 10px;
            width: 48%;
            border-radius: 8px;
            font-weight: bold;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            color: white;
            display: inline-block;
        }

        .button-group button {
            background-color: #4A628A;
            border: none;
        }

        .button-group button:hover {
            background-color: #3B4D6C;
        }

        .button-group .exit-btn {
            background-color: #e74c3c;
            border: none;
        }

        .button-group .exit-btn:hover {
            background-color: #c0392b;
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

    
<div class="w-64 fixed top-0 left-0 z-10 h-screen">
            @include('layouts.navigation') 
        </div>

    <h1>Inventory Items</h1>
    <div class="success_pop">
        @if(session()->has('success'))
        <div class="success">
            {{ session('success') }}
        </div>
        @endif
    </div>
    <div class="create_link">
        <a href="{{ route('inventoryitem.create') }}">Insert New Products</a>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="table overflow-x-auto">
    <div border=""1" id ="inventory_item">
        <thead class = "bg-gray-200">
            <tr>
                <th>SKU ID</th>
                <th>Product Name</th>
                <th>Serial Number</th>
                <th>Condition</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody></tbody>
        </table>
        </div>
            </div>
                  </div>
                      </div>
    <script src="{{ asset('js/confirmation.js') }}"></script>
    <script>
    $(document).ready(function(){
        var table = $('#inventory_item').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('inventoryitem.serials') }}",
            columns: [
                {
                    data: null,
                    orderable: false,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1; 
                    }
                },
                {data: 'sku_id', name: 'sku_id'},
                {data: 'serial_number', name: 'serial_number'},
                {data: 'condition', name: 'condition'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        // Edit button handling with confirmation
        $('#inventory_item tbody').on('click', '.edit-btn', function(e) {
            e.preventDefault();
            var editUrl = $(this).attr('href');
            if (confirm('Are you sure you want to edit this item?')) {
                window.location.href = editUrl;
            }
        });

        // Delete button handling
        $('#inventory_item tbody').on('click', '.delete-btn', function() {
            var deleteUrl = $(this).data('url'); // Get the delete URL from the button
            console.log('Delete URL:', deleteUrl); // Debug log for delete URL
            if (confirm('Are you sure you want to delete this item?')) {
                $.ajax({
                    url: deleteUrl,
                    type: 'DELETE', // Ensure this is DELETE
                    data: {
                        _token: '{{ csrf_token() }}' // CSRF token for security
                    },
                    success: function(response) {
                        alert('Item deleted successfully!'); // Success message
                        table.ajax.reload(); // Reload DataTable to reflect changes
                    },
                    error: function(xhr) {
                        console.log('Error deleting item: ' + (xhr.responseJSON.message || 'An unexpected error occurred.'));
                    }
                });
            }
        });
    });
</script>
</x-app-layout>