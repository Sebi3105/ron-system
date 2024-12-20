<x-app-layout>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <div class="flex flex-col md:flex-row h-screen">
        <!-- Sidebar (Navigation) -->
        <div class="w-full md:w-64 fixed top-0 left-0 z-10 h-screen bg-gray-900 md:block">
            @include('layouts.navigation') 
        </div>

        <!-- Main Content -->
        <div class="flex-1 md:ml-64 mt-16 md:mt-0 bg-gray-100 text-gray-800"> 
            <!-- Fixed Header -->
            <header class="bg-gray-200 py-3 px-3 fixed top-0 md:left-64 right-0 z-20 h-16 flex items-center justify-between text-black shadow-md">
                <h1 class="text-lg font-bold">Technician Report</h1>
            </header>
             
            <!-- Back to Technician View Button -->
            <div class="flex justify-start mt-24 md:mt-28 px-4">
                <a href="{{ route('techreport.index') }}" class="back-btn flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l-7-7 7-7" />
                    </svg>
                    Back to Technician
                </a>
            </div>
            
            <div class="flex justify-center items-center h-full">
                <div class="form-container mx-auto my-10 p-6 bg-white rounded-lg shadow-md">
                    <h1 class="text-lg text-center font-bold stitle"style="color:#4A628A; font-size:22px;">Update Technician Report</h1>
                    
                    @if($errors->any())
                        <div class="error_checking">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="post" action="{{ route('techreport.update', ['techreport' => $techreport]) }}" id="ServiceForm">
                        @csrf
                        @method('put')

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <!-- Row 1 -->
                            <div class="form-group">
                                <label for="technician_id">Technician</label>
                                <select name="technician_id" id="technician_id" required>
                                    <option value="" selected>Select Technician</option>
                                    @foreach($techprofile as $technician)
                                        <option value="{{ $technician->technician_id }}" {{ $technician->technician_id == $techreport->technician_id ? 'selected' : '' }}>
                                            {{ $technician->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="customer_id">Customer</label>
                                <select name="customer_id" id="customer_id" required>
                                    <option value="" selected>Select Customer</option>
                                    @foreach($customer as $cust)
                                        <option value="{{ $cust->customer_id }}" {{ $cust->customer_id == $techreport->customer_id ? 'selected' : '' }}>
                                            {{ $cust->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Row 2 -->
                            <div class="form-group">
                                <label for="sku_id">Serial No.</label>
                                <select name="sku_id" id="sku_id">
                                    <option value="" selected>Select Serial</option>
                                    @foreach($inventoryitem as $item)
                                        <option value="{{ $item->sku_id }}" {{ $item->sku_id == $techreport->sku_id ? 'selected' : '' }}>
                                            {{ $item->serial_number }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="service_id">Service</label>
                                <select name="service_id" id="service_id" required>
                                    <option value="" selected>Select Service</option>
                                    @foreach($service as $srv)
                                        <option value="{{ $srv->service_id }}" {{ $srv->service_id == $techreport->service_id ? 'selected' : '' }}>
                                            {{ $srv->service_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Row 3 -->
                            <div class="form-group">
                                <label for="date_of_completion">Date of Completion</label>
                                <input type="date" name="date_of_completion" value="{{ old('date_of_completion', $techreport->date_of_completion) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="payment_type">Payment Type</label>
                                <select name="payment_type" id="payment_type" required>
                                    <option value="" selected>Select Payment Type</option>
                                    @foreach($paymenttype as $type)
                                        <option value="{{ $type }}" {{ $type == $techreport->payment_type ? 'selected' : '' }}>
                                            {{ ucfirst(str_replace('_', ' ', $type)) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Row 4 -->
                            <div class="form-group">
                                <label for="payment_method">Payment Method</label>
                                <select name="payment_method" id="payment_method" required>
                                    <option value="" selected>Select Payment Method</option>
                                    @foreach($paymentmethod as $method)
                                        <option value="{{ $method }}" {{ $method == $techreport->payment_method ? 'selected' : '' }}>
                                          
                                            {{ ucfirst(str_replace('_', ' ', $method)) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div> 
                    
                            
                         <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" required>
                            <option value="" {{ old('status') == '' ? 'selected' : '' }}>Select Status</option>
                            
                            @foreach($statuses as $status)
                                <option value="{{ $status }}" 
                                    {{ (old('status') == $status || $status == $techreport->status) ? 'selected' : '' }}>
                                    {{ ucfirst(str_replace('_', ' ', $status)) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                                                                <!-- Row 5 -->
              <div class="form-group">
                    <label>Remarks</label>
                    <input type="text" name="remarks" placeholder="Remarks" value="{{ old('remarks', $techreport->remarks ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="cost">Cost</label>
                    <input type="number" step="0.01" name="cost" id="cost" placeholder="Cost" required
                        value="{{ old('cost', $techreport->cost ?? '') }}">
                </div>

                        </div>
                        <div class="button-group col-span sm:col-span-2">
                            <input type="submit" value="Save" id="saveTechnicianButton">
                            <a href="{{ route('techreport.index') }}" class="exit-btn">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="confirmationModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 hidden">
    <div class="bg-white max-w-sm w-full">
        <!-- Modal Header -->
        <h2 class="text-lg font-bold">Confirmation</h2>
        <p id="confirmationMessage">
            Are you sure you want to save this Technician?
        </p>
        <div class="flex">     
            <button id="confirmCancel">
                Cancel
            </button>
            <button id="confirmSubmit">
                Confirm
            </button>
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
            <a href="{{ route('techreport.index') }}" id="saveconfirmCancel" class="px-6 py-3 bg-gradient-to-r from-red-500 to-red-700 text-white rounded-md hover:from-red-600 hover:to-red-800 transition">
                Confirm
            </a>
        </div>
    </div>
</div>
    <style>

        body {
            font-family: 'Poppins';
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
            padding: 8px;
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
        .button-group .exit-btn {
            text-align: center;
            display: flex; 
            justify-content: center; 
            align-items: center; 
            padding: 8px;
            width: 48%;
            border-radius: 3px;
            font-weight: bold;
            font-size: 16px;
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
        .button-group .exit-btn {
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
        
        .back-group .exit-btn:hover{
            background-color: #c0392b;
            transform: scale(1.00);
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
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
            margin-top: 10px;
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
    $(document).ready(function() {
        // Make sure Select2 is applied to the correct selectors
        $('#technician_id').select2();
        $('#customer_id').select2();
        $('#sku_id').select2();
        $('#service_id').select2();
        $('#payment_type').select2();
        $('#payment_method').select2();
        $('#status').select2();
    });
</script>
    <script>
        function confirmAction(message) {
            return confirm(message);
        }
           // Automatically refresh layout adjustments on window resize
           window.addEventListener('resize', function() {
    location.reload(); // Automatic na magre-refresh ang page
});
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('confirmationModal');
    const modalMessage = document.getElementById('confirmationMessage');
    const confirmSubmitButton = document.getElementById('confirmSubmit');
    const confirmCancelButton = document.getElementById('confirmCancel');
    const form = document.getElementById('ServiceForm');
    const saveTechnicianButton = document.getElementById('saveTechnicianButton');

    // Open modal when clicking the save button
    saveTechnicianButton.addEventListener('click', function (event) {
        console.log('Opening modal...');
        event.preventDefault(); // Prevent form submission
        modalMessage.textContent = 'Are you sure you want to save this Technician?';
        modal.classList.remove('hidden');
    });

    // Cancel button in modal
    confirmCancelButton.addEventListener('click', function () {
        console.log('Closing modal...');
        modal.classList.add('hidden');
    });

    // Confirm button in modal
    confirmSubmitButton.addEventListener('click', function () {
        console.log('Submitting form...');
        modal.classList.add('hidden');
        form.submit(); // Submit the form manually
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const cancelModal = document.getElementById('cancelModal');
    const cancelModalClose = document.getElementById('cancelModalClose');
    const confirmCancel = document.getElementById('saveconfirmCancel');
    const cancelActionButton = document.querySelector('.exit-btn');

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

    </script>
</x-app-layout>
