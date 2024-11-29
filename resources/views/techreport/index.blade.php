<!--nabago -->
<x-app-layout>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <div class="flex flex-col md:flex-row h-screen  bg-gray-200 min-w-full">
        <div class="flex-1 ml-64 mt-0 min-h-screen">
            <!-- Content Section --> 
           <div class="max-w-7xl mx-auto px-4 sm:text-left lg:px-8 mt-4 mb-6">
                <!-- Header Inside Content -->
                <div class="relative pt-16">
                  <h1 class="text-2xl px-10 font-semibold text-gray-500 absolute top-5">Technician Report</h1>
                </div>

                <div class="max-w-7xl mx-auto px-4 sm:text-left lg:px-8 mt-6 mb-6 flex flex-col md:flex-row items-center justify-between">
                    <!-- Search Bar -->
                    <div class="flex-1 flex justify-start mb-4 md:mb-0">
                        <div class="relative w-4/5 md:w-4/5">
                            <input type="text" id="tableSearch" class="border border-gray-300 rounded-md pl-10 pr-4 py-2 w-full" placeholder="Search...">
                            <span class="absolute left-3 top-2.5 text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a7 7 0 100 14 7 7 0 000-14zM18 18l-3.5-3.5" />
                                </svg>
                            </span>
                        </div>
                    </div>

                    <!-- Buttons Section -->
                    <div class="flex items-center space-x-4 mb-4 md:mb-0">
                        <!-- Filter Button -->
                        <div class="relative">
                            <button id="filterButton" class="bg-gray-50 text-black py-2 px-6 rounded flex items-center space-x-2">
                                <!-- Filter Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
                                </svg>
                                <!-- Filter Text -->
                                <span class="font-bold">Filter</span>
                                <!-- Dropdown Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </div>
                    <!-- Filter Dropdown -->
                    <div id="filterDropdown" class="hidden absolute bg-white shadow-lg rounded-lg mt-2 p-4 w-64 z-50">
                            <div class="mb-4">
                                <!-- Service Filter-->
                                <label for="serviceFilter" class="block text-sm font-medium text-gray-700">Select Service</label>
                                <select id="serviceFilter" class="w-full border rounded     p-2">
                                    <option value="">Select Service</option>
                                    @foreach($service as $srv)
                                        <option value="{{ $srv->service_id }}">{{ $srv->service_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <!-- Payment Type Filter -->
                                <label for="paymenttypeFilter" class="block text-sm font-medium text-gray-700">Select Payment Type</label>
                                <select id="paymenttypeFilter" class="w-full border rounded p-2">
                                    <option value="">Select Payment Type</option>
                                    @foreach($paymenttype as $type)
                                        <option value="{{ $type }}">{{ ucfirst(str_replace('_', ' ', $type)) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <!-- Payment Method Filter -->
                                <label for="payment_methodFilter" class="block text-sm font-medium text-gray-700">Select Payment Method</label>
                                <select id="payment_methodFilter" class="w-full border rounded p-2">
                                    <option value="">Select Payment Method</option>
                                    @foreach($paymentmethod as $method)
                                        <option value="{{ $method }}">{{ ucfirst($method) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <!-- Status Filter -->
                                <label for="statusFilter" class="block text-sm font-medium text-gray-700">Select Status</label>
                                <select id="statusFilter" class="w-full border rounded p-2">
                                    <option value="">Select Status</option>
                                    <option value="in_progress">In Progress</option>
                                    <option value="done">Done</option>
                                    <option value="backjob">Backjob</option>
                                </select>
                            </div>
                        
                            <div class="flex space-x-2">
                                <button id="applyFilter" class="bg-blue-500 text-white py-2 px-4 rounded">Apply</button>
                                <button id="resetFilter" class="bg-gray-500 text-white py-2 px-4 rounded">Reset</button>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-start space x-4  mb-4 md:mb-0">
                        <!-- Action Buttons -->
                        <a href="{{ route('techprofile.create') }}" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600">+ Add Technician</a>
                        <a href="{{ route('service.create') }}" class="bg-custom-green text-white py-2 px-4 rounded hover:bg-green-600">+ Add Services</a>
                        <a href="{{ route('techreport.create') }}" class="bg-navy-blue text-white py-2 px-4 rounded hover:bg-navyblue">+ Add New Report</a>
                    </div>
                </div>
            </div>
            <!-- Tables -->
<div class="py-4 overflow-auto max-h-[500px] max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="p-4 sm:p-8 bg-gray-200 shadow sm:rounded-lg overflow-y-auto">
        <div class="overflow-x-auto">
            <table id="techreport" class="min-w-full table-fixed bg-gray-200">
                <thead class="text-gray-500 overflow-y-auto bg-gray-200">
                    <tr>
                        <th class="w-12 p-2 border-r border-gray-200">#</th>
                        <th class="w-40 p-2 border-r border-gray-200">Technician</th>
                        <th class="w-32 p-2 border-r border-gray-200">Customer</th>
                        <th class="w-32 p-2 border-r border-gray-200">Serial No.</th>
                        <th class="w-32 p-2 border-r border-gray-200">Service</th>
                        <th class="w-24 p-2 border-r border-gray-200">Completion Date</th>
                        <th class="w-24 p-2 border-r border-gray-200">Payment</th>
                        <th class="w-24 p-2 border-r border-gray-200">Status</th>
                        <th class="w-24 p-2">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-200">
                    <!-- Dynamic content will be injected here by DataTable -->
                </tbody>
            </table>
        </div>
    </div>
</div>

             
                         


                        
</x-app-layout>