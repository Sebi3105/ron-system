<x-app-layout>
    <div class="flex flex-col md:flex-row h-screen">
        <!-- Sidebar (Navigation) -->
        <div class="w-64 fixed top-0 left-0 z-10 h-screen bg-gray-900">
            @include('layouts.navigation')
        </div>

        <!-- Main Content -->
        <div class="flex-1 md:ml-64 mt-15 bg-gray-100 text-gray-800">
            <!-- Fixed Header -->
            <header class="bg-gray-200 py-3 px-4 fixed top-0 md:left-64 right-0 z-20 h-15 flex items-center justify-between text-black shadow-md">
                <h1 class="text-lg font-bold">Brand List</h1>
            </header>

            <!-- Back to Inventory Button -->
            <div class="flex justify-start mt-20 md:mt-24 px-4">
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
                <h1 class="text-lg font-bold stitle">ADD NEW CATEGORY</h1>

                <!-- Success Message -->
                <div class="success_pop">
                    @if(session()->has('success'))
                        <div class="success">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>

                <form method="POST" action="{{ route('category.store') }}" onsubmit="return confirmAction('Are you sure you want to save these changes?')">
                    @csrf
                    <input type="text" name="category_name" id="category_name" placeholder="Category Name" required>

                    <div class="button-group mt-4">
                        <button type="submit">ADD CATEGORY</button>
                        <a href="{{ route('inventory.index') }}" class="exit-btn" onclick="return confirmAction('Are you sure you want to cancel this?')">CANCEL</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

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
            max-width: 500px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin: 20px auto;
        }

        .stitle {
            font-size: 22px;
            color: #4A628A;
            margin-bottom: 45px;
            font-weight: bold;
            text-align: center;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            gap: 10px; /* Add space between buttons */
        }

        .button-group button,
        .button-group a {
            padding: 10px;
            width: 48%; /* Keep equal width */
            border-radius: 8px;
            font-weight: bold;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            color: white;
            text-align: center;
        }

        .button-group button {
            background-color: #4A628A;
            border: none;
        }

        .button-group button:hover {
            background-color: #3B4D6C;
        }

        .button-group a {
            background-color: #e74c3c;
            border: none;
        }

        .button-group a:hover {
            background-color: #c0392b;
        }

        .back-btn {
            color: #3C3D37;
            padding: 0.3rem 1.2rem;
            font-size: 1rem;
            font-weight: bold;
            border-radius: 0.375rem;
            transition: background-color 0.2s ease-in-out, transform 0.2s ease-in-out;
            text-decoration: none;
            margin-left: 2rem;
        }

        .back-btn:hover {
            left: 0;
        }

        .back-btn svg {
            transition: transform 0.2s ease;
        }

        .back-btn:hover svg {
            transform: translateX(-5px);
        }
    </style>
</x-app-layout>
