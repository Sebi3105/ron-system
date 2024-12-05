<x-app-layout>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

<div class="flex flex-col md:flex-row h-screen bg-gray-200">
    <div class="flex-1 ml-64 mt-0 min-h-screen">
        <!-- Content Section -->
        <div class="max-w-7xl mx-auto px-4 sm:text-left lg:px-8 mt-4 mb-6">
            <div class="relative pt-16">
                <h1 class="text-2xl px-10 font-semibold text-gray-500 absolute top-5">Customer Management</h1>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:text-left lg:px-8 mt-6 mb-6 flex flex-col md:flex-row items-center justify-between">
                <!-- Search Bar -->
                <div class="flex-1 flex justify-start mb-4 md:mb-0 search-container">
                    <div class="relative w-auto">
                        <input type="text" id="tableSearch" class="border border-gray-300 rounded-md pl-10 pr-4 py-2" placeholder="Search...">
                        <span class="absolute left-3 top-2.5 text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a7 7 0 100 14 7 7 0 000-14zM18 18l-3.5-3.5" />
                            </svg>
                        </span>
                    </div>
                </div>

                <div class="flex space-x-2">
                    <a href="{{ route('customer.create') }}" class="text-white py-2 px-4 rounded insert-btn">+ Add New Customer</a>
                </div>
            </div>

            <div class="success_pop mb-4">
                @if(session()->has('success'))
                    <div class="bg-green-500 text-white p-2 rounded">
                        {{ session('success') }}
                    </div>
                @endif
            </div>

            <div class="py-4 overflow-auto max-h-[500px] max-w-7xl mx-auto px-4 sm:text-left lg:px-8">
                <div class="p-4 sm:text-left overflow-y-auto bg-gray-200">
                    <table id="customer" class="min-w-full table-fixed bg-gray-200 text-gray-500">
                        <thead class="text-gray-500 bg-gray-200">
                            <tr>
                                <th class="p-1 bg-gray-100 border-b border-gray-300">#</th>
                                <th class="p-1 bg-gray-100 border-b border-gray-300 text-center">Customer Name</th>
                                <th class="p-1 bg-gray-100 border-b border-gray-300 text-center">Address</th>
                                <th class="p-1 bg-gray-100 border-b border-gray-300 text-center">Contact No.</th>
                                <th class="p-1 bg-gray-100 border-b border-gray-300 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-200">
                            <!-- Dynamic content will be injected here by DataTable -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Confirmation Modal -->
        <div id="confirmationModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
            <div class="bg-white max-w-sm w-full rounded-md shadow-lg">
                <h2 class="text-lg font-bold mb-4 text-white bg-gradient-to-r from-red-500 to-red-700 p-4 rounded-t-lg">
                    Confirmation
                </h2>
                <p class="text-gray-700 text-center mb-6">
                    Are you sure you want to delete this item? 
                </p>
                <div class="flex justify-center gap-4">
                    <button id="cancelDelete" class="px-6 py-3 bg-gray-200 text-white rounded-md hover:bg-gray-200 transition">
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
        <h2 class="text-lg font-bold mb-4 text-white bg-gradient-to-r from-blue-500 to-blue-700 p-4 rounded-t-lg">
            Confirmation
        </h2>
        <p class="text-gray-700 text-center mb-6">
            Are you sure you want to edit this item?
        </p>
        <div class="flex justify-center gap-4">
            <button id="editcancelEdit" class="px-6 py-3 bg-gray-200 text-black rounded-md hover:bg-gray-300 transition">
                Cancel
            </button>
            <button id="editconfirmEdit" class="px-6 py-3 bg-gradient-to-r from-green-500 to-green-700 text-white rounded-md hover:from-green-600 hover:to-green-800 transition">
                Confirm
            </button>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        // Initialize DataTable
        var table = $('#customer').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('customer.index') }}",
            dom: 'lrtip',
            columns: [
                {
                    data: null,
                    orderable: false,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                { data: 'name', name: 'name' },
                { data: 'address', name: 'address' },
                { data: 'contact_no', name: 'contact_no' },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        // Search functionality
        $('#tableSearch').on('keyup', function () {
            table.search(this.value).draw();
        });
// Handle Edit button click
$('#customer tbody').on('click', '.btn-primary', function (e) {
    e.preventDefault();
    var editUrl = $(this).attr('href');

    // Show the confirmation modal
    $('#editConfirmationModal').removeClass('hidden');
    
    // Handle confirmation
    $('#editconfirmEdit').on('click', function () {
        window.location.href = editUrl;
    });

    // Handle cancellation
    $('#editcancelEdit').on('click', function () {
        $('#editConfirmationModal').addClass('hidden');
    });
});


        // Handle Delete button click
        $('#customer tbody').on('click', '.delete-btn', function () {
            var deleteUrl = $(this).data('url');
            $('#confirmationModal').removeClass('hidden');

            $('#confirmDelete').off('click').on('click', function () {
                $.ajax({
                    url: deleteUrl,
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function () {
                        alert('Item deleted successfully!');
                        table.ajax.reload();
                        $('#confirmationModal').addClass('hidden');
                    },
                    error: function (xhr) {
                        console.error(xhr.responseText);
                        alert('Error deleting item!');
                        $('#confirmationModal').addClass('hidden');
                    }
                });
            });

            $('#cancelDelete').on('click', function () {
                $('#confirmationModal').addClass('hidden');
            });
        });
    });
    

</script>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
    body{
        font-family: 'Poppins';
    }
#tableSearch {
        width: 400px; 
        max-width: 100%; 
    }

     table#customer {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
    }

    table#customer th, table#customer td {
        text-align: center; 
        vertical-align: middle; 
        padding: 8px;
        word-wrap: break-word;
    }

    table#customer th {
        background-color: #f3f4f6;
        font-weight: bold;
    }

    table#customer tbody tr {
        background-color: #ffffff;
        border-bottom: 1px solid #e5e7eb;
    }

    table#customer tbody tr:hover {
        background-color: #f9fafb; 
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
                            transform: scale(1.05);
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
            max-width: 400px; /* Limit the maximum width */
            margin: 0 auto; /* Center it horizontally */
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
            font-size: 18px; /* Slightly smaller font for better fit */
            font-weight: bold;
            background: linear-gradient(90deg, #FF4C4C, #C62828);
            color: #fff;
            text-align: center;
            padding: 12px;
            margin: 0;
        }

        /* Modal Content */
        #confirmationModal p {
            font-size: 16px; /* Adjust text size for better fit */
            color: #4B5563;
            text-align: center;
            margin: 20px 0;
            line-height: 1.4;
        }

        /* Buttons */
        #confirmationModal .flex {
            justify-content: center;
            gap: 12px; /* Reduce button spacing */
            padding: 0; /* Remove extra padding */
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

</style>




    <script src="{{ asset('js/confirmation.js') }}"></script>
   
</x-app-layout>