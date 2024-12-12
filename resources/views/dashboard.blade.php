<x-app-layout>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <div class="flex flex-col md:flex-row h-screen">
        <!-- Sidebar (Navigation) -->   
        <div class="w-64 fixed top-0 left-0 z-10 h-screen">
            @include('layouts.navigation') 
        </div>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
        

        <!-- Main Content -->
        <div class="flex-1 ml-64 mt-0 bg-gray-200"> 
            <!-- Header -->
            <header class="bg-white py-4 px-8 fixed top-0 left-64 right-0 z-20 h-20 flex items-center justify-between">
                <!-- You can add the header content here -->
            </header>

            <!-- Main Content Below Header -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-20"> <!-- Added margin-top of 20 to avoid overlapping -->
                <div class="relative">
                    <input type="text" class="border border-gray-300 rounded-md pl-10 pr-4 py-2 w-64" placeholder="Search...">
                    <span class="absolute left-3 top-2.5 text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a7 7 0 100 14 7 7 0 000-14zM18 18l-3.5-3.5" />
                        </svg>
                    </span>
                </div>
            </div>

                    <!-- Dashboard Content -->
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Box 1 -->
                    <div class="bg-white shadow-lg rounded-md p-6 h-48 flex items-center justify-center">
                        <div class="flex flex-col items-center">
                            <i class="fas fa-shopping-bag text-4xl text-gray-500 mb-2"></i>
                            <h3 class="text-xl font-semibold">Total Inventory: {{ $inventoryCount }}</h3>
                        </div>
                    </div>

                    <!-- Box 2 -->
                    <div class="bg-white shadow-lg rounded-md p-6 h-48 flex items-center justify-center">
                        <div class="flex flex-col items-center">
                            <i class="fas fa-users text-4xl text-gray-500 mb-2"></i>
                            <h3 class="text-xl font-semibold">Total Customers: {{ $customerCount }}</h3>
                        </div>
                    </div>

                    <!-- Box 3 -->
                    <div class="bg-white shadow-lg rounded-md p-6 h-48 flex items-center justify-center">
                        <div class="flex flex-col items-center">
                            <i class="fas fa-dollar-sign text-4xl text-blue-500 mb-2"></i>
                            <h3 class="text-xl font-semibold">Total Sales: {{ $totalSales }}</h3>
                        </div>
                    </div>
                    <!-- Box 4 -->
                <div class="bg-white shadow-lg rounded-md p-6 h-48 flex items-center justify-center">
                    <div class="flex flex-col items-center">
                        <div class="flex items-center">
                            <i class="fas fa-hard-hat text-4xl text-gray-500 mr-2"></i>
                            <i class="fas fa-wrench text-4xl text-gray-500"></i>
                        </div>
                        <h3 class="text-xl font-semibold">Total Reports: {{ $technicianReportCount }}</h3>
                    </div>
                </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
