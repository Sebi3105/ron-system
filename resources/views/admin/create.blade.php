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
                <h1 class="text-lg font-bold">Create User</h1>
            </header>

            <!-- Back to Admin Dashboard Button -->
            <div class="flex justify-start mt-24 md:mt-28 px-4">
                <a href="{{ route('admin.dashboard') }}" class="back-btn flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l-7-7 7-7" />
                    </svg>
                    Back to Admin Dashboard
                </a>
            </div>

            <!-- Success and Error Messages -->
            <div class="mx-4 mt-4">
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                

                @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>

            <!-- Form Container -->
            <div class="flex justify-center items-center mt-8">
                <div class="form-container w-full max-w-lg p-6 bg-white shadow-md rounded-md">
                    <h1 class="text-lg text-center font-bold stitle">User Information</h1>

                    <form id="createUserForm" action="{{ route('admin.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-4">
                            <label for="name">Name</label>
                            <input type="text" class="form-control w-full p-2 border border-gray-300 rounded" id="name" name="name" required>
                        </div>

                        <div class="form-group mb-4">
                            <label for="email">Email</label>
                            <input type="email" class="form-control w-full p-2 border border-gray-300 rounded" id="email" name="email" required>
                        </div>

                        <div class="form-group mb-4">
                            <label for="password">Password</label>
                            <input type="password" class="form-control w-full p-2 border border-gray-300 rounded" id="password" name="password" required>
                        </div>

                        <div class="form-group mb-4">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" class="form-control w-full p-2 border border-gray-300 rounded" id="password_confirmation" name="password_confirmation" required>
                        </div>

                        <div class="form-group mb-4">
                            <label for="is_superadmin">Role</label>
                            <select class="form-control w-full p-2 border border-gray-300 rounded" id="is_superadmin" name="is_superadmin" required>
                                <option value="0">User</option>
                                <option value="1">Super Admin</option>
                            </select>
                        </div>

                        <div class="flex justify-between items-center">
                            <button type="button" class="create" id="saveCategoryButton">Create User</button>
                            <a href="{{ route('admin.dashboard') }}" class="btn-cancel" id="cancelconfirmationModal">Cancel</a>
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
            <p id="confirmationMessage">Are you sure you want to create this user?</p>
            <div class="flex justify-center gap-4">
                <button id="cancelConfirmationButton" class="px-6 py-2 bg-gray-200 text-black rounded-md">Cancel</button>
                <button id="confirmSubmitButton" class="px-6 py-2 bg-gradient-to-r from-green-500 to-green-700 text-white rounded-md">Confirm</button>
            </div>
        </div>
    </div>

    <!-- Cancel Modal -->
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
                <a href="{{ route('inventory.index') }}" id="confirmCancel" class="px-6 py-3 bg-gradient-to-r from-red-500 to-red-700 text-white rounded-md hover:from-red-600 hover:to-red-800 transition">
                    Confirm
                </a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const saveCategoryButton = document.getElementById('saveCategoryButton');
            const confirmationModal = document.getElementById('confirmationModal');
            const cancelConfirmationButton = document.getElementById('cancelConfirmationButton');
            const confirmSubmitButton = document.getElementById('confirmSubmitButton');
            const createUserForm = document.getElementById('createUserForm');

            // Show confirmation modal when save button is clicked
            saveCategoryButton.addEventListener('click', function() {
                confirmationModal.classList.remove('hidden');
            });

            // Close confirmation modal (cancel)
            cancelConfirmationButton.addEventListener('click', function() {
                confirmationModal.classList.add('hidden');
            });

            // Submit form on confirm
            confirmSubmitButton.addEventListener('click', function() {
                createUserForm.submit();
            });

            // Handle cancel modal logic
            const cancelModal = document.getElementById('cancelModal');
            const cancelModalClose = document.getElementById('cancelModalClose');

            cancelModalClose.addEventListener('click', function() {
                cancelModal.classList.add('hidden');
            });

            document.getElementById('cancelconfirmationModal').addEventListener('click', function(event) {
                event.preventDefault();
                cancelModal.classList.remove('hidden');
            });
        });
    </script>
    <style>
        body {
            background-color: #f3f3f3;
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }

        .form-container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 30px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .stitle {
            font-size: 1.2em;
            text-align: center;
            margin-bottom: 20px;
            color: #4A628A;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 1rem;
        }

        .form-group label {
            font-size: 0.8rem;
            color: #555;
            margin-bottom: 2px;
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="password"],
        .form-group select {
            padding: 5px;
            border-radius: 3px;
            border: 1px solid #ccc;
            font-size: 0.8em;
            width: 100%;
        }

        .create,
        .btn-cancel {
            padding: 10px 20px;
            flex: 1;
            /* Ensures both buttons take up equal width */
            border-radius: 3px;
            font-weight: bold;
            font-size: 14px;
            /* Increased font size for readability */
            cursor: pointer;
            color: white;
            text-align: center;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .flex {

            gap: 10px;
        }

        .create {
            background-color: #4A628A;
        }

        .create:hover {
            background-color: #3B4D6C;
            transform: scale(1.00);
        }

        .btn-cancel {
            background-color: #e74c3c;
        }

        .btn-cancel:hover {
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
            border-radius: 10px;
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

        #saveconfirmCancel {
            background-color: #E5E7EB;
            color: #374151;
        }

        #saveconfirmCancel:hover {
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