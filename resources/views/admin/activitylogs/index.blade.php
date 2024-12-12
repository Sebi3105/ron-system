<x-app-layout>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <div class="flex flex-col md:flex-row min-h-screen bg-gray-200">
        <div class=  "flex-1 ml-64 mt-0 h-full bg-gray-200">
            <!-- Content Section -->
            <div class="max-w-7xl mx-auto px-4 sm:text-left lg:px-8 mb-6 bg-gray-200">
                <div class="relative pt-16">
                    <h1 class="text-2xl px-10 font-semibold text-gray-500 absolute top-5">Admin Dashboard</h1>
                </div>

                <div class="container mt-4 bg-gray-200">
                    <!-- Welcome Text -->  
                    <div class="mb-4 ml-12">
                        <p class="text-xl font-semibold text-gray-800">Welcome, {{ Auth::user()->name }}!</p>
                    </div>

                    <!-- Navigation Buttons -->                   
                    <div class="flex space-x-4 ml-12 mb-4">
                    <button onclick="location.href='{{ route('admin.dashboard') }}'" class="bg-white text-blue-500 py-2 px-3 rounded btn-primary">User Management</button>
                        <button onclick="location.href='{{ route('admin.activitylogs.index') }}'" class="bg-white text-blue-500 py-2 px-3 rounded btn-primary">Activity Logs</button>
                        <button onclick="location.href='{{ route('admin.archives') }}'" class="bg-white text-blue-500 py-2 px-3 rounded btn-primary">Archived</button>
                    </div>

                    <!-- Filter Section aligned to the right -->
                    <div class="flex justify-end mr-10">
                        <!-- Filter Button -->
                        <div class="relative">
                            <button id="filterToggleButton" class="bg-gray-50 text-black mr-1 py-2 px-6 rounded flex items-center space-x-2">
                                <!-- Filter Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
                                </svg>
                                <!-- Filter Text -->
                                <span>Filter</span>
                                <!-- Dropdown Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>   
                        </div>

                        <!-- Filter Dropdown -->
                        <div id="filterDropdown" class="absolute left-50 mt-12 w-48 bg-white border rounded shadow-lg hidden p-4 z-50">
                            <div class="space-y-4">
                                <select id="userFilter" class="border rounded p-2 w-full">
                                    <option value="">Select User</option>
                                    @foreach($logs->pluck('causer.name')->unique()->filter()->sort() as $user)
                                        <option value="{{ $user }}">{{ $user }}</option>
                                    @endforeach
                                </select>
                                <select id="eventFilter" class="border rounded p-2 w-full">
                                    <option value="">Select Event</option>
                                    @foreach($logs->pluck('event')->unique()->filter()->sort() as $event)
                                        <option value="{{ $event }}">{{ ucfirst($event) }}</option>
                                    @endforeach
                                </select>

                                <select id="dateFilter" class="border rounded p-2 w-full">
                                    <option value="">Select Date Range</option>
                                    <option value="today">Today</option>
                                    <option value="this_week">This Week</option>
                                    <option value="this_month">This Month</option>
                                    <option value="last_30_days">Last 30 Days</option>
                                    <option value="last_7_days">Last 7 Days</option>
                                </select>

                                <div class="flex space-x-4 mt-4">
                                    <button id="applyFilterButton" class="bg-blue-500 text-white p-2 rounded w-full">Apply</button>
                                    <button id="resetButton" class="bg-gray-500 text-white p-2 rounded w-full">Reset</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- DataTable Section -->
                    <div class="table-container py-4 max-h-[500px] h-full max-w-7xl mx-auto px-4 sm:text-left lg:px-8">
                        <div class="p-4 sm:text-left overflow-y-auto bg-gray-200">
                            <h3 class="text-3xl font-semibold mb-2 text-left text-gray-500">Activity Logs</h3>
                            <table id="usersTable" class="min-w-full table-fixed bg-gray-200 text-gray-500 mx-auto">
                                <thead class="text-gray-500 bg-gray-200">
                                    <tr>
                                        <th class="w-20 p-1 bg-green-500 border-b border-gray-300 text-center text-white">Date</th>
                                        <th class="w-20 p-1 bg-green-500 border-b border-gray-300 text-center text-white">Action</th> 
                                    </tr>
                                </thead>
                                <tbody class="bg-gray-100">
                                    @foreach($logs as $log)
                                    <tr data-user="{{ $log->causer->name }}" data-event="{{ $log->event }}">
                                        <td>{{ $log->created_at->format('Y-m-d H:i') }}</td>
                                        <td>{{ $log->causer->name }}
                                            {{ ucfirst($log->description) }} {{$log->customer}}
                                            {{
                                                $log->subject->name ??
                                                $log->subject->brand_name ??  
                                                $log->subject->category_name ??
                                                $log->subject->service_name ??  
                                                $log->subject->product_name ??  

                                                $log->properties['old']['name'] ?? 
                                                $log->properties['old']['brand_name'] ?? 
                                                $log->properties['old']['category_name'] ??
                                                $log->properties['old']['service_name'] ?? 
                                                $log->properties['old']['product_name'] ?? 
                                                $log->properties['old']['brand_name'] ?? 
                                                $log->techNamefound ??
                                                  
                                                $log->properties['attributes']['name'] ?? 
                                                $log->properties['attributes']['category_name'] ?? 
                                                $log->properties['attributes']['service_name'] ?? 
                                                $log->properties['attributes']['product_name'] ?? 
                                                $log->properties['attributes']['brand_name'] ?? 
                                                $log->customerName ?? 
                                                $log->technicianName ?? 
                                                
                                                $log->productName ?? 
                                            ''
                                            }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>  
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#usersTable').DataTable({
                pageLength: 10,
                order: [[0, 'desc']],
                dom: 'lfrtip',
                columnDefs: [
                    { orderable: false, targets: 1 }
                ]
            });

            // Toggle filter dropdown
            $('#filterToggleButton').on('click', function () {
                $('#filterDropdown').toggleClass('hidden');
            });

            // Apply filter logic
            $('#applyFilterButton').on('click', function () {
                var user = $('#userFilter').val();
                var event = $('#eventFilter').val();
                var dateRange = $('#dateFilter').val();

                var filteredRows = $('#usersTable tbody tr').filter(function () {
                    var row = $(this);
                    var matchesUser = user ? row.data('user').includes(user) : true;
                    var matchesEvent = event ? row.data('event').includes(event) : true;
                    var matchesDate = dateRange ? checkDateRange(row, dateRange) : true;
                    return matchesUser && matchesEvent && matchesDate;
                });

                $('#usersTable tbody tr').hide();
                filteredRows.show();
            });

            // Reset filters
            $('#resetButton').on('click', function () {
                $('#userFilter').val('');
                $('#eventFilter').val('');
                $('#dateFilter').val('');
                $('#usersTable tbody tr').show();
            });

            // Date range filter logic
            function checkDateRange(row, range) {
                var date = new Date(row.find('td').first().text());
                var today = new Date();
                var startDate;

                switch (range) {
                    case 'today':
                        startDate = new Date(today.setHours(0, 0, 0, 0));
                        return date >= startDate && date <= new Date();
                    case 'this_week':
                        var weekStart = new Date(today.setDate(today.getDate() - today.getDay()));
                        return date >= weekStart && date <= new Date();
                    case 'this_month':
                        startDate = new Date(today.getFullYear(), today.getMonth(), 1);
                        return date >= startDate && date <= new Date();
                    case 'last_30_days':
                        startDate = new Date(today.setDate(today.getDate() - 30));
                        return date >= startDate && date <= new Date();
                    case 'last_7_days':
                        startDate = new Date(today.setDate(today.getDate() - 7));
                        return date >= startDate && date <= new Date();
                    default:
                        return true;
                }
            }
        });
    </script>
</x-app-layout>
