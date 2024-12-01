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
                <h1 class="text-lg font-bold">Add Customer</h1>
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
</x-app-layout>