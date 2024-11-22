<x-app-layout>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <div class="flex flex-col md:flex-row h-screen font-poppins">
        <!-- Sidebar (Navigation) -->
        <div id="sidebar" class="w-full md:w-64 fixed top-0 left-0 z-10 h-screen bg-gray-900">
            @include('layouts.navigation') 
        </div>

        <!-- Mobile Sidebar Toggle Button -->
        <button id="sidebar-toggle" class="md:hidden fixed top-0 left-0 m-4 bg-gray-900 text-white p-3 rounded">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <!-- Main Content -->
        <div class="flex-1 md:ml-64 mt-15 bg-gray-100 text-gray-800"> 
            <!-- Fixed Header -->
            <header class="bg-gray-200 py-3 px-3 fixed top-0 md:left-64 right-0 z-20 h-15 flex items-center justify-between text-black shadow-md">
                <h1 class="text-lg font-bold">Serial NumberList</h1>
            </header>
            
            <div class="flex justify-start mt-20 md:mt-24 px-4">
                <a href="{{ route('inventoryitem.serials', ['product_id' => $inventoryitem->product_id]) }}" class="back-btn flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l-7-7 7-7" />
                    </svg>
                    Back to Serial List
                </a>
            </div>
            <!-- Form Container -->
                <div class="form-container mx-auto mt-20">
                <h1 class=" text-lg font-bold stitle">SERIAL INFORMATION</h1>
                

                <div class="error_checking">
                    @if($errors->any())
                    <ul>
                        @foreach($errors->all() as $error)
                            <li class="text-red-500">{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif
                </div>

                <form method="post" action="{{ route('inventoryitem.update', ['inventoryitem' => $inventoryitem->sku_id]) }}" 
                      onsubmit="return confirmAction('Are you sure you want to save these changes?')">
                    @csrf
                    @method('put')

                    <div class="productid_dropdown mb-4">
                        <select name="product_id" id="product_id" class="w-full p-3 border border-gray-300 rounded-md">
                            <option value="" selected>Choose Product</option>
                            @foreach($inventories as $inventory)
                                <option value="{{ $inventory->product_id }}" {{ $inventory->product_id == $inventoryitem->product_id ? 'selected' : '' }}>
                                    {{ $inventory->product_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="serial_number mb-4">
                        <input type="text" id="serial_number" name="serial_number" placeholder="Serial Number" value="{{ old('serial_number', $inventoryitem->serial_number) }}" class="w-full p-3 border border-gray-300 rounded-md">
                    </div>

                    <div class="condition mb-4">
                        <select name="condition" id="condition" class="w-full p-3 border border-gray-300 rounded-md">
                            <option value="working" {{ $inventoryitem->condition == 'working' ? 'selected' : '' }}>Working</option>
                            <option value="defective" {{ $inventoryitem->condition == 'defective' ? 'selected' : '' }}>Defective</option>
                        </select>
                    </div>

                    <div class="button-group flex gap-4 justify-center">
                        <input type="submit" value="Save Information" class="px-6 py-2 bg-blue-500 text-white font-semibold rounded-md cursor-pointer hover:bg-blue-600">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function confirmAction(message) {
            return confirm(message);
        }

        // Mobile Sidebar Toggle
        document.getElementById('sidebar-toggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('hidden');
        });
           // Automatically refresh layout adjustments on window resize
           window.addEventListener('resize', function() {
    location.reload(); // Automatic na magre-refresh ang page
});

    </script>

    <style>
        /* Mobile Sidebar */
        @media (max-width: 768px) {
            #sidebar {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                z-index: 10;
                height: 100%;
                width: 250px;
                background-color: #2D3748;
            }
            #sidebar-toggle {
                display: block;
            }
        }

        /* Form Container Styling */
        .form-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 90%;
            margin-top: 1rem;
            text-align: center;
        }

        .error_checking ul {
            color: red;
            list-style-type: none;
            padding: 0;
            margin: 10px 0;
        }

        /* Button Styling */
        .button-group input[type="submit"]{
            padding: 12px 20px;
            font-size: 1rem;
            font-weight: bold;
            border-radius: 5px;
            text-align: center;
            display: inline-block;
            width: 100%;
        }

        .button-group input[type="submit"] {
            background-color: #4A628A;
            color: white;
        }
        .stitle {
            font-size: 22px;
            color: #4A628A;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .button-group input[type="submit"]:hover {
            background-color: #3b5374;
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
</x-app-layout>
