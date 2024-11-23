<x-app-layout>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <div class="flex flex-col md:flex-row h-screen">
        <div class="flex-1 ml-64 mt-0">
            <header class="bg-gray-200 py-4 px-8 fixed top-0 left-64 right-0 z-20 h-20 flex items-center justify-between shadow-md">
                <h1 class="text-2xl font-semibold text-gray-800">Sales</h1>
            </header>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-24 mb-6 flex items-center space-x-4">
                <div class="flex-1 flex justify-start">
                    <div class="relative w-1/2">
                        <input type="text" id="tableSearch" class="border border-gray-300 rounded-md pl-10 pr-4 py-2 w-full" placeholder="Search...">
                        <span class="absolute left-3 top-2.5 text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a7 7 0 100 14 7 7 0 000-14zM18 18l-3.5-3.5" />
                            </svg>
                        </span>
                    </div>
                </div>

                <div class="flex space-x-2">
                    <a href="{{ route('sales.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">+ Add New Sale</a>
                </div>
            </div>

            <div class="success_pop mb-4">
                @if(session()->has('success'))
                    <div class="bg-green-500 text-white p-2 rounded">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
            <div class="py-4 overflow-auto max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="p-4 sm:p-8 bg-gray-200 shadow sm:rounded-lg">
                    <table id="sales" class="min-w-full table-fixed bg-gray-200 text-black border border-gray-400">
                        <thead class="bg-gray-300 border-b border-gray-400">
                            <tr>
                                <th class="w-12 p-2 border-r border-gray-400">#</th>
                                <th class="w-40 p-2 border-r border-gray-400">Customer Name</th>
                                <th class="w-40 p-2 border-r border-gray-400">Product Name</th>
                                <th class="w-40 p-2 border-r border-gray-400">Serial Number</th>
                                <th class="w-32 p-2 border-r border-gray-400">State</th>
                                <th class="w-32 p-2 border-r border-gray-400">Sale Date</th>
                                <th class="w-32 p-2 border-r border-gray-400">Amount</th>
                                <th class=" w-32 p-2 border-r border-gray-400">Payment type</th>
                                <th class="w-24 p-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-200">
    @foreach($sales as $key => $sale)
        <tr>
            <td class="p-2 border-r border-gray-400">{{ $key + 1 }}</td>
            <td class="p-2 border-r border-gray-400">{{ $sale->customer->name }}</td>
            <td class="p-2 border-r border-gray-400">{{ $sale->inventory->product_name }}</td>
            <td class="p-2 border-r border-gray-400">{{ $sale->inventoryItem->serial_number }}</td> <!-- Access the correct property -->
            <td class="p-2 border-r border-gray-400">{{ $sale->state }}</td>
            <td class="p-2 border-r border-gray-400">{{ $sale->sale_date->format('Y-m-d') }}</td>
            <td class="p-2 border-r border-gray-400">{{ number_format($sale->amount, 2) }}</td>
            <td class="p-2 border-r border-gray-400">{{ ucfirst($sale->payment_type) }}</td>
            <td class="p-2">
                <a href="#" class="text-blue-500">Edit</a> | 
                <a href="#" class="text-red-500">Delete</a>
            </td>
        </tr>
    @endforeach
</tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#sales').DataTable({
                searching: true,
                paging: true,
                info: true,
                order: [[0, 'asc']]
            });
        });
    </script>
</x-app-layout>