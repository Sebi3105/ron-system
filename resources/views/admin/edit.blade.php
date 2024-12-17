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
                <h1 class="text-lg font-bold">Edit User</h1>
            </header>

            <div class="flex justify-start mt-20 md:mt-24 px-4">
                <a href="{{ route('admin.dashboard') }}" class="back-btn flex items-center" aria-label="Back to Admin Dashboard">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l-7-7 7-7" />
                    </svg>
                    Back to Admin Dashboard
                </a>
            </div>

            <!-- Form Container -->
            <div class="form-container mx-auto mt-24 md:mt-32">
                <h1 class="font-bold text-center" style="color: #4a628a;">USER NFORMATION</h1>

                <!-- Error Checking -->
                @if($errors->any())
                <div class="error_checking">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- Form -->
                <form method="post" action="{{ route('admin.update', ['id' => $user->id]) }}" id="editUserForm">
    @csrf
    @method('put')

    <div class="form-grid">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" placeholder="Name" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="form-group relative">
            <label for="email" class="block text-sm ">Email</label>
            <div class="relative">
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            </div>
        </div>
        <div class="form-group relative">
            <label for="is_superadmin">Role</label>
            <select class="form-control" id="is_superadmin" name="is_superadmin" required>
                    <option value="0" {{ $user->is_superadmin == 0 ? 'selected' : '' }}>User </option>
                    <option value="1" {{ $user->is_superadmin == 1 ? 'selected' : '' }}>Super Admin</option>
            </select>
        </div>
    </div>

    <div class="button-group">
        <input id="saveCustomerButton" type="submit" value="Save">
        <a class="exit-btn" href="{{ route('admin.dashboard') }}">Cancel</a>
    </div>
</form>
            </div>
        </div>
    </div>

     <!-- Confirmation Modal -->
     <div id="confirmationModal" class="hidden fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
            <div class="bg-white max-w-sm w-full rounded-md shadow-lg">
                <h2 class="text-lg font-bold mb-4 text-white bg-gradient-to-r from-red-500 to-red-700 p-4 rounded-t-lg">
                    Confirmation
                </h2>
                <p class="text-gray-700 text-center mb-6">
                    Are you sure you want to save this ?
                </p>
                <div class="flex justify-center gap-4">
                    <button id="cancelConfirmationButton" class="px-6 py-3 bg-gray-400 text-white rounded-md hover:bg-gray-500 transition">
                        Cancel
                    </button>
                    <button id="confirmSubmitButton" class="px-6 py-3 bg-gradient-to-r from-green-500 to-green-700 text-white rounded-md hover:from-green-600 hover:to-green-800 transition">
                        Confirm
                    </button>
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
                    Are you sure you want to delete<br> this permanently?
                </p>
                <div class="flex justify-center gap-4">
                    <button id="cancelModalClose" class="px-6 py-3 bg-gray-200 text-black rounded-md hover:bg-gray-300 transition">
                        Cancel
                    </button>
                    <button id="confirmCancel" class="px-6 py-3 bg-gradient-to-r from-red-500 to-red-700 text-white rounded-md hover:from-red-600 hover:to-red-800 transition">
                        Confirm
                    </button>
                </div>
            </div>
        </div>


        <script>
       document.addEventListener('DOMContentLoaded', function () {
        // Save Confirmation Modal
        const saveModal = document.getElementById('confirmationModal');
        const saveButton = document.getElementById('saveCustomerButton');
        const confirmSaveButton = document.getElementById('confirmSubmitButton');
        const cancelSaveButton = document.getElementById('cancelConfirmationButton');
        const form = document.getElementById('editUserForm');

        // Open Save Modal
        saveButton.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent immediate form submission
            saveModal.classList.remove('hidden'); // Show modal
        });

        // Confirm Save
        confirmSaveButton.addEventListener('click', function () {
            form.submit(); // Submit the form
        });

        // Cancel Save Modal
        cancelSaveButton.addEventListener('click', function () {
            saveModal.classList.add('hidden'); // Hide modal
        });

        // Cancel Confirmation Modal
        const cancelModal = document.getElementById('cancelModal');
        const exitButton = document.querySelector('.exit-btn');
        const confirmCancel = document.getElementById('confirmCancel');
        const cancelModalClose = document.getElementById('cancelModalClose');

        // Open Cancel Modal
        exitButton.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent immediate navigation
            cancelModal.classList.remove('hidden'); // Show cancel modal
        });

        // Confirm Cancel (Redirect to Dashboard)
        confirmCancel.addEventListener('click', function () {
            window.location.href = exitButton.href; // Redirect to dashboard
        });

        // Close Cancel Modal
        cancelModalClose.addEventListener('click', function () {
            cancelModal.classList.add('hidden'); // Hide modal
        });
    });
    </script>

    <style>
        /* Apply Poppins font */
        body {
            font-family: 'Poppins';
        }

        input#contact_no {
            padding-left: 3rem; /* Leaves space for +63 */
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
        }

        .form-group label .text-sm {
            font-size: 0.875rem;
            color: #6b7280;
            margin-left: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-size: 1em;
        }

        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 2rem;
        }

        .button-group input[type="submit"],
        .button-group a {
            padding: 10px;
            width: 50%; /* Keep equal width */
            border-radius: 3px;
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

        .button-group a {
            background-color: #d9534f;
        }

        .button-group input[type="submit"]:hover {
            background-color: #3b5374;
            transform: scale(1.02);
        }

        .button-group a:hover {
            background-color: #c9302c;
            transform: scale(1.02);
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

        /* Modal Style */
    /* Confirmation Modal Styling */
    #confirmationModal, #cancelModal {
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

    /* Modal Content Styling */
     #confirmationModal, #cancelModal {
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

    /* Modal Content Styling */
    #confirmationModal .bg-white, #cancelModal .bg-white {
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

    /* Header Style */
    #confirmationModal h2, #cancelModal h2 {
        font-size: 22px;
        font-weight: bold;
        color: #fff;
        text-align: center;
        padding: 12px;
        margin: 0;
    }

    /* Confirmation Modal Header (Green) */
    #confirmationModal h2 {
        background: linear-gradient(90deg, #4CAF50, #2E7D32); /* Green Gradient */
    }

    /* Cancel Modal Header (Red) */
    #cancelModal h2 {
        background: linear-gradient(90deg, #FF4C4C, #C62828); /* Red Gradient */
    }

    /* Modal Text */
    #confirmationModal p, #cancelModal p {
        font-size: 15px;
        color: #4B5563;
        text-align: center;
        margin: 16px 0 24px;
        line-height: 1.6;
    }

    /* Button Styles */
    #confirmationModal button, #cancelModal button {
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

    /* Button Hover Effects */
    #confirmationModal button:hover, #cancelModal button:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    /* Cancel and Confirm Buttons (Gray for Cancel, Green for Confirm in Confirmation Modal) */
    #cancelDelete, #cancelModalClose {
        background-color: #E5E7EB;
        color: #374151;
        transition: background-color 0.3s ease;
    }

    #cancelDelete:hover, #cancelModalClose:hover {
        background-color: #D1D5DB;
    }

    /* Confirm Button (Green for Confirmation Modal) */
    #confirmSubmitButton {
        background: linear-gradient(90deg, #4CAF50, #2E7D32); /* Green Gradient */
        color: white;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }

    #confirmSubmitButton:hover {
        background-color: #388E3C;
    }

    /* Confirm Button (Red for Cancel Modal) */
    #confirmCancel {
        background: linear-gradient(90deg, #FF4C4C, #C62828); /* Red Gradient */
        color: white;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }

    #confirmCancel:hover {
        background-color: #D32F2F;
    }

    /* Modal Flex Layout */
    #confirmationModal .flex, #cancelModal .flex {
        justify-content: center;
        gap: 16px;
        padding: 12px 0;
    }

    </style>
</x-app-layout>
