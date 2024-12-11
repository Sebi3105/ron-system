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
                <h1 class="font-bold" style="color: #4a628a;">Edit User</h1>

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
    <div id="confirmationModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 hidden">
        <div class="bg-white max-w-sm w-full">
            <!-- Modal Header -->
            <h2 class="text-lg font-bold">Confirmation</h2>

            <!-- Modal Message -->
            <p id="confirmationMessage">
                Are you sure you want to save these changes?
            </p>
            <div class="flex">
                <button id="confirmCancel">Cancel</button>
                <button id="confirmSubmit">Confirm</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('confirmationModal');
            const modalMessage = document.getElementById('confirmationMessage');
            const confirmSubmitButton = document.getElementById('confirmSubmit');
            const confirmCancelButton = document.getElementById('confirmCancel');
            const form = document.getElementById('editUserForm');
            const saveUserButton = document.getElementById('saveCustomerButton');

            // Open modal when clicking the save button
            saveUserButton.addEventListener('click', function() {
                modalMessage.textContent = 'Are you sure you want to save this User?';
                modal.classList.remove('hidden');
            });

            // Cancel button in modal
            confirmCancelButton.addEventListener('click', function() {
                modal.classList.add('hidden');
            });

            // Confirm button in modal
            confirmSubmitButton.addEventListener('click', function() {
                modal.classList.add('hidden');
                form.submit();
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

        #confirmationModal .bg-white {
            max-width: 350px;
            padding: 2rem;
            border-radius: 0.5rem;
        }

        #confirmationModal button {
            padding: 8px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        #confirmationModal button#confirmSubmit {
            background-color: #4CAF50;
            color: white;
        }

        #confirmationModal button#confirmCancel {
            background-color: #f44336;
            color: white;
        }
    </style>
</x-app-layout>
