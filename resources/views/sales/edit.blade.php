<x-app-layout>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <div class="flex flex-col md:flex-row h-screen">
        
        <!-- Sidebar (Navigation) -->
        <div class="w-full md:w-64 fixed top-0 left-0 z-10 h-screen bg-gray-900 md:block">
            @include('layouts.navigation') 
        </div>     

        <!-- Main Content -->
        <div class="flex-1 md:ml-64 mt-16 md:mt-0 bg-gray-100 text-gray-800"> 
            <!-- Fixed Header -->
            <header class="bg-gray-200 py-3 px-3 fixed top-0 md:left-64 right-0 z-20 h-16 flex items-center justify-between text-black shadow-md">
                <h1 class="text-lg font-bold">Edit Sale</h1>
            </header>
              
            <!-- Back to Sales View Button -->
            <div class="flex justify-start mt-24 md:mt-28 px-4">
                <a href="{{ route('sales.index') }}" class="back-btn flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l-7-7 7-7" />
                    </svg>
                    Back to Sales
                </a>
            </div>
            
            <div class="flex justify-center items-center h-full">
                <div class="form-container">
                    <h1 class="text-lg text-center font-bold stitle">SALES INFORMATION</h1>
                    <div class="error_checking">
                        @if($errors->any())
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    
                    <form method="post" action="{{ route('sales.update', $sale->sales_id) }}" id="saleForm">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-2 gap-4">
                            <div class="form-group">
                                <label for="customer">Customer Name</label>
                                <select name="customer_id" id="customer_id" required>
                                    <option value="" selected>Select Customer</option>
                                    @foreach($customers as $customer)
                                        <option value="{{ $customer->customer_id }}" {{ $customer->customer_id == $sale->customer_id ? 'selected' : '' }}>{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="inventories">Product</label>
                                <select name="inventory_id" id="inventories" required>
                                    <option value="" selected>Select Product</option>
                                    @foreach($inventories as $inventory)
                                        <option value="{{ $inventory->product_id }}" {{ $inventory->product_id == $sale->product_id ? 'selected' : '' }}>{{ $inventory->product_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="serials">Serial Number</label>
                                <select name="serials" id="serials" required>
                                    <option value="" selected>Select Serial Number</option>
                                    @foreach($serials as $serial)
                                        <option value="{{ $serial->sku_id }}" {{ $serial->sku_id == $sale->serial_number ? 'selected' : '' }}>{{ $serial->serial_number }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="state">State</label>
                                <select name="state" id="state" required>
                                    <option value="" selected>Select State</option>
                                    <option value="reserved" {{ $sale->state == 'reserved' ? 'selected' : '' }}>Reserved</option>
                                    <option value="for_pickup" {{ $sale->state == 'for_pickup' ? 'selected' : '' }}>For Pickup</option>
                                    <option value="for_delivery" {{ $sale->state == 'for_delivery' ? 'selected' : '' }}>For Delivery</option>
                                </select>
                            </div>

                            <!-- since hindi nababasa or same ng format para maidisplay -->
                            <div class="form-group">
                                <label for="sale_date">Sale Date</label>
                                <input 
                                    type="date" 
                                    name="sale_date" 
                                    id="sale_date" 
                                    value="{{ \Carbon\Carbon::parse($sale->sale_date)->format('Y-m-d') }}" 
                                    required
                                >
                            </div>

                            <div class="form-group">
                                <label for="amount">Amount</label>
                                <input type="number" name="amount" id="amount" step="0.01" value="{{ $sale->amount }}" required>
                            </div>

                            <div class="form-group">
                                <label for="payment_method">Payment Method</label>
                                <select name="payment_method" id="payment_method" required>
                                    <option value="" selected>Select Payment Method</option>
                                    <option value="installment" {{ $sale->payment_method == 'installment' ? 'selected' : '' }}>Installment</option>
                                    <option value="full_payment" {{ $sale->payment_method == 'full_payment' ? 'selected' : '' }}>Full Payment</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="payment_type">Payment Type</label>
                                <select name="payment_type" id="payment_type" required>
                                    <option value="" selected>Select Payment Type</option>
                                    <option value="credit_card" {{ $sale->payment_type == 'credit_card' ? 'selected' : '' }}>Credit Card</option>
                                    <option value="cash" {{ $sale->payment_type == 'cash' ? 'selected' : '' }}>Cash</option>
                                    <option value="gcash" {{ $sale->payment_type == 'gcash' ? 'selected' : '' }}>GCash</option>
                                    <option value="paymaya" {{ $sale->payment_type == 'paymaya' ? 'selected' : '' }}>Paymaya</option>
                                </select>
                            </div>
                        </div>

                        <div class="button-group">
                            <input type="submit" value="Save">
                            <a href="{{ route('sales.index') }}" class="cancel-btn">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="confirmationModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 hidden">
        <div class="bg-white max-w-sm w-full rounded-lg">
            <!-- Modal Header -->
            <h2 class="text-lg font-bold">Confirmation</h2>
            <p id="confirmationMessage">
                Are you sure you want to save these changes?
            </p>
            <div class="flex justify-center gap-16 py-3">
                <button id="confirmCancel" class="px-4 py-2 bg-gray-300 rounded">Cancel</button>
                <button id="confirmSubmit" class="px-4 py-2 bg-green-500 text-white rounded">Confirm</button>
            </div>
        </div>
    </div>

    <div id="cancelModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
        <div class="bg-white max-w-sm w-full rounded-md shadow-lg">
            <h2 class="text-lg font-bold mb-4 text-white bg-gradient-to-r from-yellow-500 to-yellow-700 p-4 rounded-t-lg">
                Confirmation
            </h2>
            <p class="text-gray-700 text-center mb-6">
                Are you sure you want to cancel?
            </p>
            <div class="flex justify-center gap-4">
                <button id="cancelModalClose" class="px-6 py-3 bg-gray-200 text-black rounded-md hover:bg-gray-200 transition">
                    Cancel
                </button>
                <a href="{{ route('sales.index') }}" id="confirmCancel" class="px-6 py-3 bg-gradient-to-r from-red-500 to-red-700 text-white rounded-md hover:from-red-600 hover:to-red-800 transition">
                    Confirm
                </a>
            </div>
        </div>
    </div>

    <style>
        body {
            background-color: #f3f3f3;
            margin: 0;
        }

        .form-container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 30px;
            width: 800px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin-top: -4rem;
        }

        .stitle {
            font-size: 1.5em;
            text-align: center;
            margin-bottom: 20px;
            color: #4A628A;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-weight: bold;
            color: #555;
            margin-bottom: 5px;
        }

        .form-group select,
        .form-group input {
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 0.9em;
            width: 100%;
        }
        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        .button-group input[type="submit"],
        .button-group .cancel-btn {
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px;
            width: 49%;
            border-radius: 3px;
            font-weight: bold;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            color: white;
            display: inline-block;
            margin-top: 10px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .button-group input[type="submit"] {
                    background-color: #4A628A;
        }

        .button-group .cancel-btn {
            background-color: #e74c3c;
        }

        .back-btn {
            color: #3C3D37;
            padding: 0.3rem 1.2rem;
            font-size: 1rem;
            
            border-radius: 0.375rem;
            transition:transform 0.3s ease;
            text-decoration: none;
            margin-left: 2rem;
            margin-top: -2rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem; 
        }

        .back-btn:hover {
            background-color: #F5F5F5;
            transform: translateX(-5px);
        }

        .back-btn svg {
            transition: transform 0.3s ease; 
        }
        .back-btn:hover svg {
            transform: translateX(-8px); 
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

    /* Modal Style */
    #confirmationModal .bg-white {
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
    #confirmationModal h2 {
        font-size: 22px;
        font-weight: bold;
        background: linear-gradient(90deg, #4CAF50, #2E7D32);
        color: #fff;
        text-align: center;
        padding: 12px;
        margin: 0;
    }

    /* Modal Text */
    #confirmationModal p {
        font-size: 15px;
        color: #4B5563;
        text-align: center;
        margin: 16px 0 24px;
        line-height: 1.6;
    }

    /* Buttons */
    #confirmationModal button {
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
    border-radius: 3px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    transition: all 0.3s ease;
}

@media (max-width: 768px) {
            .form-row {
                flex-direction: column;
                gap: 10px;
            }

            .button-group {
                flex-direction: column;
            }

            header {
                padding: 10px;
            }
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

        .select2-container .select2-selection{
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 0.9em;
            width: 100%;
            height: calc(2.75rem + 2px);
        }

        .select2-results__option{
            font-size: 0.9em;
        }

    </style>

    <script>
        function confirmAction(message) {
            return confirm(message);
        }
           // Automatically refresh layout adjustments on window resize
           window.addEventListener('resize', function() {
    location.reload(); // Automatic na magre-refresh ang page
});
document.addEventListener('DOMContentLoaded', function () {
    const cancelModal = document.getElementById('cancelModal');
    const cancelModalClose = document.getElementById('cancelModalClose');
    const confirmCancel = document.getElementById('confirmCancel');
    const cancelActionButton = document.querySelector('.cancel-btn');

    // Open the cancel confirmation modal
    cancelActionButton.addEventListener('click', function (event) {
        event.preventDefault(); // Prevent default link behavior
        cancelModal.classList.remove('hidden');
    });

    // Close the modal when clicking Cancel button
    cancelModalClose.addEventListener('click', function () {
        cancelModal.classList.add('hidden');
    });

    // Add behavior for Confirm Cancel button (redirect to route)
    confirmCancel.addEventListener('click', function () {
        // Optionally, perform any action before confirming cancel
        console.log('Action cancelled');
    });
});

    // Confirm button in modal
    const form = document.getElementById('saleForm');
    const modal = document.getElementById('confirmationModal');
    const cancelButton = document.getElementById('confirmCancel');
    const submitButton = document.getElementById('confirmSubmit');

    // Handle form submission
    form.addEventListener('submit', function(event) {
        event.preventDefault();  // Prevent form from submitting immediately
        modal.classList.remove('hidden');  // Show the modal
    });

    // Cancel button - hide modal
    cancelButton.addEventListener('click', function() {
        modal.classList.add('hidden');  // Hide the modal
    });

    // Confirm button - submit the form
    submitButton.addEventListener('click', function() {
        modal.classList.add('hidden');  // Hide the modal
        form.submit();  // Submit the form
    });

    </script>

<script>
        $(document).ready(function () {
            $('#inventories').select2({});
            $('#customer_id').select2({});
            $('#serials').select2({});

            $('#inventories').on('change', function () {
                    const inventoryId = $(this).val(); // Get selected inventory ID
                    const serialsSelect = $('#serials'); // jQuery object for #serials

            // Clear previous options
            serialsSelect.empty().append('<option value="" selected>Select Serial Number</option>');

                if (inventoryId) {
                    // Fetch serials for the selected inventory
                    $.ajax({
                        url: `/get-serials/${inventoryId}`,
                        method: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            console.log('Fetched serials:', data); // Debugging API response
                            if (data.length > 0) {
                                data.forEach(serial => {
                                    console.log(`Adding serial: ${serial.serial_number} (ID: ${serial.sku_id})`);
                                    serialsSelect.append(
                                        $('<option>', {
                                            value: serial.sku_id, // Assuming sku_id is the identifier
                                            text: serial.serial_number // Assuming serial_number is the display name
                                        })
                                    );
                                });
                            } else {
                                console.warn('No serials found for this inventory ID.');
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error('Error fetching serials:', error);
                            alert('Failed to load serial numbers. Please try again later.');
                        }
                    });
                }
            });
            $('#serials').select2({});
        });

    </script>
</x-app-layout>