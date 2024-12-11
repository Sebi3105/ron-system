<x-app-layout>
    <div class="flex flex-col md:flex-row h-screen">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

        <!-- Sidebar -->
        <div class="w-full md:w-48 lg:w-64 fixed top-0 left-0 z-10 h-screen bg-gray-900">
            @include('layouts.navigation')
        </div>

        <!-- Main Content -->
        <div class="flex-1 md:ml-48 lg:ml-64 mt-16 md:mt-0 bg-gray-100 text-gray-800">
            <!-- Fixed Header -->
            <header class="bg-gray-200 py-3 px-3 md:px-6 fixed top-0 md:left-48 lg:left-64 right-0 z-15 h-16 flex items-center justify-between text-black shadow-md">
                <h1 class="text-lg font-bold">Add Product</h1>
            </header>

            <!-- Back to Inventory Button -->
            <div class="flex justify-start mt-24 md:mt-28 px-4">
                <a href="{{ route('inventory.index') }}" class="back-btn flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l-7-7 7-7" />
                    </svg>
                    Back to Inventory
                </a>
            </div>

            <!-- Form Container -->
            <div class="form-container mx-auto px-4">
                <h1 class="text-lg font-bold text-center stitle">NEW PRODUCT INFORMATION</h1>
                <form method="post" action="{{ route('inventory.store') }}" id="inventoryForm">
                    @csrf

                    <div class="form-row">
                        <div class="form-group">
                            <label for="product_name">Product Name</label>
                            <input type="text" name="product_name" id="product_name" placeholder="Product Name" required>
                        </div>
                        <div class="form-group">
                            <label for="category_id">Category</label>
                            <select name="category_id" id="category_id" required>
                                <option value="" selected>Select a Category</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="brand_id">Brand</label>
                            <select name="brand_id" id="brand_id" required>
                                <option value="" selected>Select a Brand</option>
                                @foreach($brands as $brand)
                                <option value="{{ $brand->brand_id }}">{{ $brand->brand_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" name="price" id="price" placeholder="Price" required min="0">
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" name="quantity" id="quantity" placeholder="Quantity" required min="0">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="released_date">Date of Release</label>
                            <input type="date" name="released_date" id="released_date" required>
                        </div>
                        <div class="form-group">
                            <label for="notes">Notes</label>
                            <input type="text" name="notes" id="notes" placeholder="Notes">
                        </div>
                    </div>

                    <div class="button-group">
                        <button type="button" id="saveProductButton">Save</button>
                        <a href="{{ route('inventory.index') }}" class="exit-btn">Cancel</a>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div id="confirmationModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 hidden">
        <div class="bg-white max-w-sm w-full">
            <h2 class="text-lg font-bold">Confirmation</h2>
            <p id="confirmationMessage">Are you sure you want to save this product?</p>
            <div class="flex justify-center gap-4 py-4">
                <button id="confirmCancel" class="bg-gray-300 text-gray-700 hover:bg-gray-400">Cancel</button>
                <button id="confirmSubmit" class="bg-green-600 text-white hover:bg-green-700">Confirm</button>
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
                <a href="{{ route('inventory.index') }}" id="saveconfirmCancel" class="px-6 py-3 bg-gradient-to-r from-red-500 to-red-700 text-white rounded-md hover:from-red-600 hover:to-red-800 transition">
                    Confirm
                </a>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('confirmationModal');
            const confirmSubmitButton = document.getElementById('confirmSubmit');
            const confirmCancelButton = document.getElementById('confirmCancel');
            const saveProductButton = document.getElementById('saveProductButton');
            const form = document.getElementById('inventoryForm');

            // Open modal when Save Product button is clicked
            saveProductButton.addEventListener('click', function() {
                modal.classList.remove('hidden');
            });

            // Close modal on Cancel button click
            confirmCancelButton.addEventListener('click', function() {
                modal.classList.add('hidden');
            });

            // Submit form on Confirm button click
            confirmSubmitButton.addEventListener('click', function() {
                form.submit();
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
            background-color: #f3f3f3;
            margin: 0;
        }

        .form-container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 26px;
            width: 400px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin-top: 10px;
            margin-left: auto;
            margin-right: auto;
            width: 90%;
            max-width: 700px;
        }

        .stitle {
            font-size: 22px;
            color: #4A628A;
            margin-bottom: 20px;
            font-weight: bold;
        }

        label {
            font-size: 15px;
            color: #333;
            margin-bottom: 1px;
            display: block;
        }

        .form-row {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .form-group {
            flex: 1;
            min-width: 190px;
            margin-bottom: 15px;
        }

        select,
        input[type="text"],
        input[type="number"],
        input[type="date"] {
            width: 100%;
            padding: 9px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
            margin-top: 5px;
        }


        .button-group {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            width: 100%;
            gap: 1rem;
            /* Reduced gap for better spacing */
        }

        .button-group button,
        .button-group .exit-btn {
            padding: 8px;
            width: 400px;
            /* Ensures both buttons have the same width */
            border-radius: 3px;
            font-weight: bold;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            color: white;
            display: inline-block;
            text-align: center;
            /* Centers the text */
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .button-group button {
            background-color: #4A628A;
            border: none;
        }

        .button-group button:hover {
            background-color: #3B4D6C;
            transform: scale(1.05);
        }

        .button-group .exit-btn {
            background-color: #e74c3c;
            border: none;
        }

        .button-group .exit-btn:hover {
            background-color: #c0392b;
            transform: scale(1.05);
        }

        .back-btn {
            color: #3C3D37;
            padding: 0.3rem 1.2rem;
            font-size: 1rem;
            border-radius: 0.375rem;
            transition: transform 0.3s ease;
            text-decoration: none;
            margin-left: 2rem;
            margin-top: -2rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .back-btn:hover {
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

    <script>
        function confirmAction(message) {
            return confirm(message);
        }
        // Automatically refresh layout adjustments on window resize
        window.addEventListener('resize', function() {
            location.reload(); // Automatic na magre-refresh ang page
        });
    </script>
</x-app-layout>