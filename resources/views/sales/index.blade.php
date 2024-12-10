<!--nabago -->
<x-app-layout>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

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
                <tbody class="bg-gray-200 text-center">
                            @foreach($sales as $key => $sale)            
                                    <tr>
                                        <td class="p-2 border-b border-gray-400">{{ $key + 1 }}</td>
                                    <td class="p-2 text-center border-b border-gray-400">{{ $sale->customer ? $sale->customer->name : 'No customer' }}</td>
                                    <td class="p-2 text-center border-b border-gray-400">{{ $sale->inventory->product_name }}</td>
                                    <td class="p-2 text-center border-b border-gray-400">{{ $sale->inventoryItem->serial_number }}</td>         
                                    <td class="p-2 text-center border-b border-gray-400">{{ $sale->state }}</td>
                                    <td class="p-2 text-center border-b border-gray-400">{{ $sale->sale_date->format('Y-m-d') }}</td>
                                    <td class="p-2 text-center border-b border-gray-400">{{ number_format($sale->amount, 2) }}</td>
                                    <td class="p-2 text-center border-b border-gray-400 text-center">
    <div class="inline-flex items-center space-x-2">
        <!-- View Button -->
        <a href="{{ route('sales.show', $sale->sales_id) }}" class="bg-navy-blue text-white py-1 px-3 rounded">
            View
        </a>

        <!-- Edit Button -->
        <a href="{{ route('sales.edit', $sale->sales_id) }}" class="bg-green-500 text-white py-1 px-3 rounded">
            Edit
        </a>

        <!-- Delete Form -->
        <form action="{{ route('sales.destroy', $sale->sales_id) }}" method="POST" class="inline-flex items-center space-x-2">
            @csrf
            @method('DELETE')
            <select name="delete_type" class="mr-2">
                <option value="soft">Archive</option>
                <option value="hard">Delete</option>
            </select>
            <button type="submit" class="bg-red-500 text-white py-1 px-3 rounded">
                Delete
            </button>
        </form>
    </div>
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
                <h2 class="text-lg font-bold mb-4 text-white bg-gradient-to-r from-red-500 to-red-700 p-4 rounded-t-lg">
                    Confirm Delete
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
        <h2 class="text-lg font-bold mb-4 text-white bg-gradient-to-r from-blue-500 to-blue-700 p-4 rounded-t-lg">
            Confirm Edit
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
                         

<script src="{{ asset('js/confirmation.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#sales').DataTable({
            searching: false,
            paging: true,
            info: true,
            order: [[0, 'asc']]
        });

        $('#sales tbody').on('click', '.btn-primary', function (e) {
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
        $('#sales tbody').on('click', '.delete-btn', function () {
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

<style>
    
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

   

    /* Buttons */
    #confirmationModal button {
        border: none;
        padding: 12px 20px;
        font-size: 14px;
        font-weight: bold;
        border-radius: 8px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.3s ease;
    }

    #confirmationModal button:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    #confirmCancel {
        background-color: #E5E7EB;
        color: #374151;
    }

    #confirmCancel:hover {
        background-color: #D1D5DB;
    }

    #confirmSubmit {
        background: linear-gradient(90deg, #4CAF50, #2E7D32);
        color: white;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }

    #confirmSubmit:hover {
        background: linear-gradient(90deg, #2E7D32, #1B5E20);
    }

    /* Icons */
    #confirmationModal button svg {
        height: 18px;
        width: 18px;
    }
    #confirmationModal .flex {
    justify-content: center; 
    gap: 16px;
    padding: 12px 0;
}

/* Buttons */
#confirmationModal button {
    border: none;
    padding: 10px 20px; 
    font-size: 14px;
    font-weight: bold;
    border-radius: 8px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    transition: all 0.3s ease;
}

#cancelModal {
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

#cancelModal .bg-white {
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
#cancelModal h2 {
    font-size: 22px; /* Slightly smaller font for better fit */
    font-weight: bold;
    background: linear-gradient(90deg, #FF4C4C, #C62828);
    color: #fff;
    text-align: center;
    padding: 12px;
    margin: 0;
}

/* Modal Content */
#cancelModal p {
    font-size: 16px; /* Adjust text size for better fit */
    color: #4B5563;
    text-align: center;
    margin: 16px 0 28px;
    line-height: 1.4;
}

/* Buttons */
#cancelModal .flex {
    justify-content: center;
    gap: 12px; /* Reduce button spacing */
    padding: 0; /* Remove extra padding */
}

/* Equal-width buttons with max width */
#cancelModal button,
#cancelModal a {
    margin-top: 0.5rem;
    margin-bottom: 1rem;
    border: none;
        padding: 9px 20px;
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

#cancelModal a{
    color: white;
}

#cancelModal button:hover,
#cancelModal a:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

/* Cancel Button */
#cancelCancel {
    background-color: #E5E7EB;
    color: #374151;
}

#cancelCancel:hover {
    background-color: #D1D5DB;
}


</style>                    
</x-app-layout>