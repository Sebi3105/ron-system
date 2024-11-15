<x-app-layout>
    <div class="flex flex-col md:flex-row h-screen">
        <!-- Sidebar (Navigation) -->
        <div class="w-64 fixed top-0 left-0 z-10 h-screen bg-gray-900">
            @include('layouts.navigation') 
        </div>

        <!-- Main Content -->
        <div class="flex-1 md:ml-64 mt-15 bg-gray-100 text-gray-800"> 
            <!-- Fixed Header -->
            <header class="bg-gray-200 py-3 px-3 fixed top-0 md:left-64 right-0 z-20 h-15 flex items-center justify-between text-black shadow-md">
                <h1 class="text-lg font-bold">Serial Number List</h1>
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

    <style>

        select {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
            transition: border-color 0.3s ease;
            box-sizing: border-box;
            margin-top: 5px;
        }
        select:focus {
            border-color: #4A628A;
            outline: none;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f3f3;
            margin: 0;
        }
        .form-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            height: 50%;
            width: 100%; /* Adjust for responsiveness */
            text-align: center;
            margin: 2rem auto;
        }

        .stitle {
            font-size: 22px;
            color: #4A628A;
            margin-bottom: 20px;
            font-weight: bold;
        }


        input[type="text"] {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
            margin-bottom: 5px;
            margin-top: 10px;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .button-group input,
        .button-group .exit-btn {
            padding: 10px;
            width: 48%;
            border-radius: 8px;
            font-weight: bold;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            color: white;
            display: inline-block;
        }

        .button-group input {
            background-color: #4A628A;
            border: none;
        }

        .button-group input:hover {
            background-color: #3B4D6C;
        }

        .button-group .exit-btn {
            background-color: #e74c3c;
            border: none;
        }

        .button-group .exit-btn:hover {
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
                    transform: translateX(-5px); /* Move the arrow slightly */
                }
        
    </style>
    <div class="form-container mx-auto mt-20">
    <h1 class=" text-lg font-bold stitle">INSERT A SERIAL NUMBER</h1>
        <div class="error_checking">
            @if($errors->any())
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endif
        </div>
        <form method="post" action="{{ route('inventoryitem.store') }}" onsubmit="return confirmAction('Are you sure you want to save this product?')">
            @csrf
            @method('post')
            <input type="hidden" name="product_id" value="{{ $selectedInventory->product_id }}">
            <div class="serial_number">
                <input type="text" name="serial_number" id="serial_number" placeholder="Enter Serial Number" required>
            </div>
            <div class="condition">
                <select name="condition" id="condition">
                    <option value="working">Working</option>
                    <option value="defective">Defective</option>
                </select>
            </div>
            <div class="button-group">
                <input type="submit" value="Save Product">
                <a href="{{ route('inventory.index') }}" class="exit-btn" onclick="return confirmAction('Are you sure you want to cancel this?')">Cancel</a>
            </div>
        </form>
    </div>
    <script src="{{ asset('js/confirmation.js') }}"></script>
    </x-app-layout>
