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
            <header class="bg-gray-200 py-3 px-4 fixed top-0 md:left-64 right-0 z-20 h-16 flex items-center justify-between text-black shadow-md">
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
                <h1 class="font-bold text-2xl mb-6 text-gray-800 text-center " style="color: #4a628a;">NEW CUSTOMER INFORMATION</h1>

                <div class="error_checking mb-4">
                    @if($errors->any())
                    <ul class="text-red-600">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif
                </div>

                <form id="customerForm" action="{{ route('customer.store') }}" method="POST">
                    @csrf
                    @method('post')

                    <div class="form-group mb-4">
                        <label for="contact_no" class="block text-sm ">Customer Name</label>
                        <input type="text" name="name" placeholder="Customer Name" required class="w-full p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                    </div>

                    <div class="form-group mb-4">
                        <label>Address</label>
                        <input type="text" name="address" placeholder="Science City of Munoz" required class="w-full p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                    </div>

                    <div class="form-group mb-4 relative">
                        <label for="contact_no" class="block text-gray-700">
                            Contact Number
                        </label>
                        <div class="relative">
                            <span
                                class="absolute top-1/2 left-3 transform -translate-y-1/2 text-gray-700 text-sm pointer-events-none"
                                aria-hidden="true">+63</span>
                            <input
                            
                                type="tel"
                                name="contact_no"
                                id="contact_no"
                                maxlength="10"
                                inputmode="numeric"
                                pattern="[0-9]{10}"
                                placeholder="e.g., 9123424321"
                                required
                                class="w-full p-3 pl-12 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                        </div>
                    </div>



                    <div class="button-group mt-4">
                        <input id="saveCustomerButton" type="submit" value="Save" class="px-4 py-2 bg-indigo-500 text-white rounded-md hover:bg-indigo-600 cursor-pointer" />
                        <a class="exit-btn px-4 py-2 ml-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 cursor-pointer">Cancel</a>
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
                <a href="{{ route('customer.index') }}" id="saveconfirmCancel" class="px-6 py-3 bg-gradient-to-r from-red-500 to-red-700 text-white rounded-md hover:from-red-600 hover:to-red-800 transition">
                    Confirm
                </a>
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
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('confirmationModal');
            const modalMessage = document.getElementById('confirmationMessage');
            const confirmSubmitButton = document.getElementById('confirmSubmit');
            const confirmCancelButton = document.getElementById('confirmCancel');
            const form = document.getElementById('customerForm');
            const saveCustomerButton = document.getElementById('saveCustomerButton');

            // Open modal when clicking the save button
            saveCustomerButton.addEventListener('click', function(event) {
                event.preventDefault(); // Pigilan ang default na form submission
                modalMessage.textContent = 'Are you sure you want to save this customer?';
                modal.classList.remove('hidden');
            });

            // Cancel button in modal
            confirmCancelButton.addEventListener('click', function() {
                modal.classList.add('hidden');
            });

            // Confirm button in modal
            confirmSubmitButton.addEventListener('click', function() {
                modal.classList.add('hidden');
                form.submit(); // I-submit ang form kapag na-confirm
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const cancelModal = document.getElementById('cancelModal');
            const cancelModalClose = document.getElementById('cancelModalClose');
            const confirmCancel = document.getElementById('saveconfirmCancel');
            const cancelActionButton = document.querySelector('.exit-btn');

            // Open the cancel confirmation modal
            cancelActionButton.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent default link behavior
                cancelModal.classList.remove('hidden');
            });

            // Close the modal when clicking Cancel button
            cancelModalClose.addEventListener('click', function() {
                cancelModal.classList.add('hidden');
            });

            // Add behavior for Confirm Cancel button (redirect to route)
            confirmCancel.addEventListener('click', function() {
                // Optionally, perform any action before confirming cancel
                console.log('Action cancelled');
            });
        });
    </script>

    <style>
        body {
            font-family: 'Poppins';
            background-color: #F3F4F6;
        }

        input#contact_no {
            padding-left: 3rem;
            padding-right: 1rem;
            box-sizing: border-box;
        }

        span[aria-hidden="true"] {
            position: absolute;
            top: 50%;
            left: 0.75rem;
            transform: translateY(-50%);
            font-size: 0.875rem;
            color: #4a5568;
            pointer-events: none;
        }


        .form-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 460px;
            margin: 1rem auto;
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
            border-radius: 3px;
            font-size: 1em;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus {
            border-color: #4a628a;
        }

        .button-group {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            width: 100%;
            gap: 0.5rem;
            /* Reduced gap for better spacing */
        }

        .button-group input[type="submit"],
        .button-group .exit-btn {
            width: 380px;
            padding: 8px;
            border-radius: 3px;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            transition: transform 0.2s, background-color 0.3s;
        }

        .button-group input[type="submit"] {
            background-color: #4A628A;
            color: white;
        }

        .button-group input[type="submit"]:hover {
            background-color: #3B4D6C;
            transform: scale(1.00);
        }

        .button-group .exit-btn {
            background-color: #e74c3c;
            color: white;
        }

        .button-group .exit-btn:hover {
            background-color: #c0392b;
            transform: scale(1.00);
        }

        .back-btn {
            color: #3C3D37;
            padding: 0.3rem 1.2rem;
            font-size: 1rem;
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
            max-width: 400px;
            /* Limit the maximum width */
            margin: 0 auto;
            /* Center it horizontally */
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
            font-size: 22px;
            /* Slightly smaller font for better fit */
            font-weight: bold;
            background: linear-gradient(90deg, #FF4C4C, #C62828);
            color: #fff;
            text-align: center;
            padding: 12px;
            margin: 0;
        }

        /* Modal Content */
        #cancelModal p {
            font-size: 16px;
            /* Adjust text size for better fit */
            color: #4B5563;
            text-align: center;
            margin: 16px 0 28px;
            line-height: 1.4;
        }

        /* Buttons */
        #cancelModal .flex {
            justify-content: center;
            gap: 12px;
            /* Reduce button spacing */
            padding: 0;
            /* Remove extra padding */
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
</x-app-layout>