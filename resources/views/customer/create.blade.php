<x-app-layout>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <div class="flex flex-col md:flex-row h-screen font-poppins">
        <!-- Sidebar (Navigation) -->
        <div class="w-full md:w-64 fixed top-0 left-0 z-10 h-screen bg-gray-900">
            @include('layouts.navigation')
        </div>

        <!-- Main Content -->
        <div class="flex-1 md:ml-64 mt-15 bg-gray-100 text-gray-800">
            <!-- Fixed Header -->
            <header class="bg-gray-200 py-3 px-4 fixed top-0 md:left-64 right-0 z-20 flex items-center justify-between text-black shadow-md">
                <h1 class="text-lg font-bold">Customer Information</h1>
            </header>

            <div class="flex justify-start mt-20 md:mt-24 px-4">
                <a href="{{ route('customer.index') }}" class="back-btn flex items-center" aria-label="Back to Customer List">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l-7-7 7-7" />
                    </svg>
                    Back to Customer
                </a>
            </div>

            <!-- Form Container -->
            <div class="form-container mx-auto mt-24 md:mt-32 p-6 bg-white shadow-lg rounded-lg">
                <h1 class="font-bold text-2xl mb-6 text-gray-800 text-center "  style="color: #4a628a;">NEW CUSTOMER INFORMATION</h1>

                <div class="error_checking mb-4">
                    @if($errors->any())
                        <ul class="text-red-600">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                <form  id="customerForm" action="{{ route('customer.store') }}">
                    @csrf 
                    @method('post')
                    
                    <div class="form-group mb-4">
                        <label class="block text-gray-700 mb-2">Customer Name</label>
                        <input type="text" name="name" placeholder="Customer Name" required class="w-full p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"/>
                    </div>
                    
                    <div class="form-group mb-4">
                        <label class="block text-gray-700 mb-2">Address</label>
                        <input type="text" name="address" placeholder="Science City of Munoz" required class="w-full p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"/>
                    </div>
                    
                    <div class="form-group mb-4">
                        <label class="block text-gray-700 mb-2">Contact Number
                        <span class="text-sm text-gray-500"><i> 10 digits only (e.g., 9123424321)</i></span>
                        </label>
                        <input type="tel" name="contact_no" maxlength="10" inputmode="numeric" pattern="[0-9]{10}" placeholder="e.g., 9123424321" required class="w-full p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"/>
                    </div>
                    
                    <div class="button-group mt-4">
                        <input id="saveCustomerButton" type="submit" value="Save Customer Profile"/>
                    </div>
                </form>
            </div>
        </div>
    </div>

      <!-- Confirmation Modal -->
      <div id="confirmationModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 hidden">
        <div class="bg-white max-w-sm w-full">
            <!-- Modal Header -->
            <h2 class="text-lg font-bold">Confirmation</h2>

            <!-- Modal Message -->
            <p id="confirmationMessage">
                Are you sure you want to save this customer?
            </p>

            <!-- Centered Modal Buttons -->
            <div class="flex">
                <!-- Cancel Button -->
                <button id="confirmCancel">
                    Cancel
                </button>

                <!-- Confirm Button -->
                <button id="confirmSubmit">
                    Confirm
                </button>
            </div>
        </div>
    </div>

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
            const form = document.getElementById('customerForm');
            const saveCategoryButton = document.getElementById('saveCustomerButton');

            // Open modal when clicking the save button
            saveCustomerButton.addEventListener('click', function () {
                modalMessage.textContent = 'Are you sure you want to save this customer?';
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
    </script>

    <style>
        body {
            font-family: 'Poppins';
        }

        .form-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 480px;
            margin: 2rem auto;
        }

        .form-container h1 {
            font-size: 1.5em;
            margin-bottom: 20px;
            color: #4a4a4a;
        }

        .form-group label {
            display: block;
            margin-top: 15px;
            font-size: 14px;
            color: #333;
        }

        .form-group label .text-sm {
            font-size: 0.875rem; 
            color: #6b7280; 
            margin-left: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 7px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1em;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus {
            border-color: #4a628a;
        }

        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 2rem;
        }

        .button-group input[type="submit"] {
            padding: 10px;
            width: 100%;
            border-radius: 8px;
            font-weight: bold;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            color: white;
            text-align: center;
            margin-top: -11px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .button-group input[type="submit"] {
            background-color: #4a628a;
        }

        .button-group input[type="submit"]:hover {
            background-color: #3b5374;
            transform: scale(1.02);
        }

        .back-btn {
            color: #3C3D37;
            padding: 0.3rem 1.2rem;
            font-size: 1rem;
            font-weight: bold;
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
            background-color: #F5F5F5;
            transform: translateX(-5px);
        }

        .back-btn svg {
            transition: transform 0.3s ease; 
        }

        .back-btn:hover svg {
            transform: translateX(-8px); 
        }

        .error_checking ul {
            color: red;
            list-style: none;
            padding: 0;
        }

        @media (max-width: 768px) {
            .form-container {
                margin-top: 14rem;
            }
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

    </style>
</x-app-layout>
