box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
<x-app-layout>
    <div class="flex flex-col md:flex-row h-screen">
        <!-- Sidebar (Navigation) -->
        <div class="w-full md:w-64 fixed top-0 left-0 z-10 h-screen bg-gray-900 md:block">
            @include('layouts.navigation') 
        </div>     

        <!-- Main Content -->
        <div class="flex-1 md:ml-64 mt-16 md:mt-0 bg-gray-100 text-gray-800"> 
            <!-- Fixed Header -->
            <header class="bg-gray-200 py-3 px-3 fixed top-0 md:left-64 right-0 z-20 h-15 flex items-center justify-between text-black shadow-md">
                <h1 class="text-lg font-bold">Create A Sale</h1>
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
                    <h1 class="text-lg text-center font-bold stitle">Add Sales Information</h1>
                    <div class="error_checking">
                        @if($errors->any())
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    <form method="post" action="{{ route('sales.store') }}" id="SalesForm">
                        @csrf
                        <div class="form-group">
                <label for="customer">Customer Name</label>
                <select name="customer_id" id="customer_id" required>
                    <option value="" selected>Select Customer</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->customer_id }}">{{ $customer->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="inventories">Product</label>
                <select name="inventory_id" id="inventories" required>
                    <option value="" selected>Select Product</option>
                    @foreach($inventories as $inventory)
                        <option value="{{ $inventory->product_id }}">{{ $inventory->product_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="serials">Serial Number</label>
                <select name="serials" id="serials" required>
                    <option value="" selected>Select Serial Number</option>
                </select>
            </div>

            <div class="form-group">
                <label for="state">State</label>
                <select name="state" id="state" required>
                    <option value="" selected>Select State</option>
                    <option value="reserved">Reserved</option>
                    <option value="for_pickup">For Pickup</option>
                    <option value="for_delivery">For Delivery</option>
                </select>
            </div>

            <div class="form-group">
                <label for="sale_date">Sale Date</label>
                <input type="date" name="sale_date" id="sale_date" required>
            </div>

            <div class="form-group">
                <label for="amount">Amount</label>
                <input type="number" name="amount" id="amount" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="payment_method">Payment Method</label>
                <select name="payment_method" id="payment_method" required>
                    <option value="" selected>Select Payment Method</option>
                    <option value="installment">Installment</option>
                    <option value="full_payment">Full Payment</option>
                </select>
            </div>

            <div class="form-group">
                <label for="payment_type">Payment Type</label>
                <select name="payment_type" id="payment_type" required>
                    <option value="" selected>Select Payment Type</option>
                    <option value="credit_card">Credit Card</option>
                    <option value="cash">Cash</option>
                    <option value="gcash">GCash</option>
                    <option value="paymaya">Paymaya</option>
                </select>
            </div>

            <div class="button-group">
                <input type="submit" value="Save Sale" class="saveSalesButton">
                <a href="{{ route('sales.index') }}" class="cancel-btn">Cancel</a>
            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    
    <!-- Confirmation Modal -->
    <div id="confirmationModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 hidden">
        <div class="bg-white max-w-sm w-full">
            <!-- Modal Header -->
            <h2 class="text-lg font-bold">Confirmation</h2>
            <p id="confirmationMessage">
                Are you sure you want to save this category?
            </p>
            <div class="flex">
                <button id="saveconfirmCancel">Cancel</button>
                <button id="confirmSubmit">Confirm</button>
            </div>
        </div>
    </div>

      <!-- Confirmation Modal -->
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
            font-family: Arial, sans-serif;
            background-color: #f3f3f3;
            margin: 0;
            
        }
        .form-container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 30px;
            width: 750px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .stitle {
            font-size: 1.2em;
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 5px;
        }
        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 1px;
        }
        .form-group label {
            font-weight: bold;
            color: #555;
            margin-bottom: 1px;
        }
        .form-group input[type="number"] {
            margin-top: 0; /* Ensure no extra margin at the top */
            margin-bottom: 0; /* Ensure no extra margin at the bottom */
        }

         .form-group input[type="text"] {
            margin-top: 0; /* Ensure no extra margin at the top */
            margin-bottom: 0; /* Ensure no extra margin at the bottom */
        }
        .form-group select,
        .form-group input {
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 0.9em;
            width: 100%;
        }
        .full-width {
            grid-column: span 2;
        }
        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }
        .button-group input[type="submit"],
        .button-group .cancel-btn {
            text-align: center; /* Center the text */
            display: flex; /* Use flexbox for centering */
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
            padding: 10px;
            width: 48%;
            border-radius: 8px;
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
            background-color: #2c3e50;
        }
        .button-group .cancel-btn {
            background-color: #e74c3c;
        }
        .back-group {
            margin-bottom: 20px;
        }
        .back-group a {
            background-color: #3b5998;
            color: white;
            padding: 8px 15px;
            border-radius: 12px;
            text-decoration: none;
            font-size: 0.9em;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            display: inline-block;
        }
        .back-group a:hover {
            background-color: #314e75;
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
            margin-top: 10px;
        }

        .button-group {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-top: 10px;
        }

        .button-group input,
        .button-group .cancel-btn {
            padding: 10px;
            width: 48%;
            border-radius: 8px;
            font-weight: bold;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            color: white;
            display: inline-block;
            margin-top: 10px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .button-group input{
            background-color: #4A628A;
            border: none;
        }

        .button-group input:hover {
            background-color: #3B4D6C;
            transform: scale(1.05);
        }

        .button-group .cancel-btn {
            background-color: #e74c3c;
            border: none;
        }

        .button-group .cancel-btn:hover {
            background-color: #c0392b;
            transform: scale(1.05);
        }

        .back-btn {
            color: #3C3D37;
            padding: 0.3rem 1.2rem;
            font-size: 1rem;
            font-weight: bold;
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

    <script>
        function confirmAction(message) {
            return confirm(message);
        }
           // Automatically refresh layout adjustments on window resize
           window.addEventListener('resize', function() {
    location.reload(); // Automatic na magre-refresh ang page
});
document.addEventListener('DOMContentLoaded', function () {
    const inventorySelect = document.getElementById('inventories');
    const serialsSelect = document.getElementById('serials');

    inventorySelect.addEventListener('change', function () {
        const inventoryId = this.value;

        // Clear previous serial numbers
        serialsSelect.innerHTML = '<option value="" selected>Select Serial Number</option>';

        if (inventoryId) {
            fetch(`/get-serials/${inventoryId}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(serial => {
                        const option = document.createElement('option');
                        option.value = serial.sku_id; // Assuming sku_id is the identifier
                        option.textContent = serial.serial_number; // Assuming serial_number is the display name
                        serialsSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error fetching serials:', error));
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('confirmationModal');
            const modalMessage = document.getElementById('confirmationMessage');
            const confirmSubmitButton = document.getElementById('confirmSubmit');
            const confirmCancelButton = document.getElementById('saveconfirmCancel');
            const form = document.getElementById('SalesForm');
            const saveCategoryButton = document.getElementById('saveSalesButton');

            // Open modal when clicking the save button
            saveSalesButton.addEventListener('click', function () {
                modalMessage.textContent = 'Are you sure you want to save this sales?';
                modal.classList.remove('hidden');
            });

            // Cancel button in modal
            confirmCancelButton.addEventListener('click', function () {
                modal.classList.add('hidden');
            });

            // Confirm button in modal
            confirmSubmitButton.addEventListener('click', function () {
                modal.classList.add('hidden');
                form.submit();
            });
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
    confirmSubmitButton.addEventListener('click', function () {
        console.log('Submitting form...');
        modal.classList.add('hidden');
        form.submit();
    });


    </script>
</x-app-layout>
