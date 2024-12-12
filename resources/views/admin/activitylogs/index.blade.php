
<style>
   
    .container {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    h1 {
        text-align: center;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    th, td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    th {
        background-color: #4CAF50;
        color: white;
    }
</style>
<x-app-layout>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

    <header class="bg-gray-200 py-4 px-8 fixed top-0 left-64 right-0 z-20 h-20 flex items-center justify-between shadow-md">
        <h1 class="text-2xl font-semibold text-gray-800">Activity Logs</h1>
    </header>

    <div class="flex flex-col md:flex-row h-screen">
        <div class="flex-1 ml-64 mt-5">
            <div class="container my-5">
                <h1 class="text-center mb-4">Activity Logs</h1>

                <!-- Filter Section -->
                <div class="mb-4">
                    <select id="userFilter" class="border rounded p-2">
                        <option value="">Select User</option>
                        @foreach($logs->pluck('causer.name')->unique()->filter()->sort() as $user)
                            <option value="{{ $user }}">{{ $user }}</option>
                        @endforeach
                    </select>
                    <select id="eventFilter" class="border rounded p-2">
                        <option value="">Select Event</option>
                        @foreach($logs->pluck('event')->unique()->filter()->sort() as $event)
                            <option value="{{ $event }}">{{ ucfirst($event) }}</option>
                        @endforeach
                    </select>
<!-- 
                    <select id="logNameFilter" class="border rounded p-2">
    <option value="">Select Log Name</option>
    @foreach($logs->pluck('log_name')->unique()->filter()->sort() as $logName)
        <option value="{{ $logName }}">{{ ucfirst($logName) }}</option>
    @endforeach
</select> -->

                    <select id="dateFilter" class="border rounded p-2">
        <option value="">Select Date Range</option>
        <option value="today">Today</option>
        <option value="this_week">This Week</option>
        <option value="this_month">This Month</option>
        <option value="last_30_days">Last 30 Days</option>
        <option value="last_7_days">Last 7 Days</option>
    </select>

                    <button id="filterButton" class="bg-blue-500 text-white p-2 rounded">Filter</button>
                    <button id="resetButton" class="bg-gray-500 text-white p-2 rounded">Reset</button>
                
                </div>

                <!-- Activity Logs Table -->
                <div class="table-responsive">
                    <table id="activityLogsTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Action</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($logs as $log)
                            <tr data-user="{{ $log->causer->name }}" data-event="{{ $log->event }}">
                                    <td>{{ $log->created_at->format('Y-m-d H:i') }}</td>
                                    <td>{{ $log->causer->name }}
                                        {{ ucfirst($log->description) }} <span>{{ $log->customer}}</span>
                                        {{
                                          
            $log->subject->name ??
            $log->subject->brand_name ??  
            $log->subject->category_name ??
            $log->subject->service_name ??  
            $log->subject->product_name ??  
           

              
            $log->properties['attributes']['name'] ??
            $log->properties['attributes']['category_name'] ??
            $log->properties['attributes']['service_name'] ??
            $log->properties['attributes']['product_name'] ??
            $log->properties['attributes']['brand_name'] ??
           
           
            $log->properties['old']['name'] ?? 
            $log->properties['old']['brand_name'] ?? 
            $log->properties['old']['category_name'] ??
            $log->properties['old']['service_name'] ??
            $log->properties['old']['product_name'] ??
            $log->properties['old']['brand_name'] ??
            $log->properties['attributes']['serial_number'] ??
            $log->properties['old']['serial_number'] ??
            $log->techNamefound ??
           
            $log->technicianName ?? 
          
        
            ''
        }}

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Controls -->
                <div id="paginationControls" class="mt-4 text-center"></div>
            </div>
        </div>
    </div>
</x-app-layout>
<!-- <script>
    
    $(document).ready(function () {
    // Initialize DataTable
    const table = $('#activityLogsTable').DataTable({
        pageLength: 10, // Number of rows per page
        order: [[0, 'desc']], // Default sorting (by date column descending)
        dom: 'lfrtip', // Default layout
        columnDefs: [
            { orderable: false, targets: 1 }, // Disable ordering for the Action column
        ],
    });

    // Apply filters when dropdowns change
    $('#userFilter, #eventFilter').on('change', function () {
        const user = $('#userFilter').val(); // Selected User
        const event = $('#eventFilter').val(); // Selected Event

        // Custom filtering logic
        table.rows().every(function (rowIdx, tableLoop, rowLoop) {
            const dataUser = this.node().dataset.user.toLowerCase();
            const dataEvent = this.node().dataset.event.toLowerCase();

            // Check if row matches the filters
            const matchesUser = user ? dataUser.includes(user.toLowerCase()) : true;
            const matchesEvent = event ? dataEvent.includes(event.toLowerCase()) : true;

            // Show/hide rows based on match results
            $(this.node()).toggle(matchesUser && matchesEvent);
        });
    });

    // Reset filters
    $('#resetButton').on('click', function () {
        $('#userFilter').val('');
        $('#eventFilter').val('');
        table.search('').columns().search('').draw(); // Reset global and column searches
    });
});

</script>


 -->

 <script>
$(document).ready(function () {
    const table = $('#activityLogsTable').DataTable({
        pageLength: 10,
        order: [[0, 'desc']],
        dom: 'lfrtip',
        columnDefs: [
            { orderable: false, targets: 1 },
        ],
    });

    function getDateRange(range) {
        const today = new Date();
        let startDate = null;
        let endDate = new Date(today); // Default to today

        if (range === "today") {
            startDate = new Date(today.setHours(0, 0, 0, 0));
        } else if (range === "this_week") {
            const firstDayOfWeek = new Date(today.setDate(today.getDate() - today.getDay()));
            startDate = new Date(firstDayOfWeek.setHours(0, 0, 0, 0));
        } else if (range === "this_month") {
            startDate = new Date(today.getFullYear(), today.getMonth(), 1);
        } else if (range === "last_30_days") {
            startDate = new Date(today.setDate(today.getDate() - 30));
        } else if (range === "last_7_days") {
            startDate = new Date(today.setDate(today.getDate() - 7));
        }

        return { startDate, endDate };
    }

    $('#userFilter, #eventFilter, #dateFilter').on('change', function () {
        const user = $('#userFilter').val();
        const event = $('#eventFilter').val();
        const dateRange = $('#dateFilter').val();
        const { startDate, endDate } = getDateRange(dateRange);

        table.rows().every(function () {
            const rowData = this.data();
            const rowDate = new Date(rowData[0]); // Ensure first column contains a valid date string

            const matchesUser = user ? this.node().dataset.user.toLowerCase().includes(user.toLowerCase()) : true;
            const matchesEvent = event ? this.node().dataset.event.toLowerCase().includes(event.toLowerCase()) : true;
            const matchesDate = startDate && endDate
                ? rowDate >= startDate && rowDate <= endDate
                : true;

            $(this.node()).toggle(matchesUser && matchesEvent && matchesDate);
        });
    });

    $('#resetButton').on('click', function () {
        $('#userFilter, #eventFilter, #dateFilter').val('');
        table.rows().every(function () {
            $(this.node()).show();
        });
        table.draw();
    });
});


 </script>

 
