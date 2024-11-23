<!-- resources/views/customer/history.blade.php -->

<x-app-layout>
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Sales History for {{ $customer->name }}</h1>

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
                            </tr>
                        </thead>
                        <tbody class="bg-gray-200">
    @if ($sales->isEmpty())
        <tr>
            <td colspan="9" class="p-2 border-r border-gray-400 text-center">No sales data available for this customer.</td>
        </tr>
    @else
        @foreach($sales as $key => $sale)
            <tr>
                <td class="p-2 border-r border-gray-400">{{ $key + 1 }}</td>
                <td class="p-2 border-r border-gray-400">{{ $sale->customer->name }}</td>
                <td class="p-2 border-r border-gray-400">{{ $sale->inventory->product_name }}</td>
                <td class="p-2 border-r border-gray-400">{{ $sale->inventoryItem->serial_number }}</td>
                <td class="p-2 border-r border-gray-400">{{ $sale->state }}</td>
                <td class="p-2 border-r border-gray-400">{{ $sale->sale_date->format('Y-m-d') }}</td>
                <td class="p-2 border-r border-gray-400">{{ number_format($sale->amount, 2) }}</td>
                <td class="p-2 border-r border-gray-400">{{ ucfirst($sale->payment_type) }}</td>

            </tr>
        @endforeach
    @endif
</tbody>

    </div>
</x-app-layout>