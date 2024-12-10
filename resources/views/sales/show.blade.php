<!-- resources/views/sales/show.blade.php -->
<x-app-layout>
    <div class="flex flex-col md:flex-row h-screen">
        <!-- Left Navbar (if you have one) -->
        <div class="hidden md:block w-64 bg-gray-200">
            <!-- Your navbar content -->
        </div>

        <div class="flex-1 flex items-center justify-center p-4">
            <div class="max-w-2xl w-full">
                <h1 class="text-2xl font-semibold mb-4 text-center">Sale Details</h1>

                <div class="bg-gray-200 p-4 rounded-lg shadow">
                    <p><strong>Customer Name:</strong> {{ $sale->customer->name }}</p>
                    <p><strong>Product Name:</strong> {{ $sale->inventory->product_name }}</p>
                    <p><strong>Serial Number:</strong> {{ $sale->inventoryItem->serial_number }}</p>
                    <p><strong>State:</strong> {{ $sale->state }}</p>
                    <p><strong>Sale Date:</strong> {{ $sale->sale_date->format('Y-m-d') }}</p>
                    <p><strong>Amount:</strong> {{ number_format($sale->amount, 2) }}</p>
                    <p><strong>Payment Method:</strong> {{ ucfirst($sale->payment_method) }}</p>
                    <p><strong>Payment Type:</strong> {{ ucfirst($sale->payment_type) }}</p>
                </div>

        <!-- Technician Reports Section -->
        <div id="techReportsSection" class="mt-6">
            <h2 class="text-xl font-semibold mb-4 text-center">Maintenance Reports for serial ({{ $sale->inventoryItem->serial_number }})</h2>

            @if($techreport->isEmpty())
                <p class="text-center text-gray-500">No technician reports found for this sales.</p>
            @else
            @foreach($techreport as $report)
            <div class="bg-gray-200 p-4 rounded-lg shadow mb-4">
                <p><strong>Technician:</strong> {{ $report->TechProfile->name ?? 'N/A' }}</p>
                <p><strong>Service:</strong> {{ $report->Services->service_name ?? 'N/A' }}</p>
                <p><strong>Date of Completion:</strong> {{ $report->date_of_completion ?? 'N/A' }}</p>
                <p><strong>Cost:</strong> {{ number_format($report->cost, 2) }}</p>
                <p><strong>Status:</strong> {{ ucfirst($report->status) }}</p>
                <p><strong>Remarks:</strong> {{ $report->remarks ?? 'N/A' }}</p>
            </div>
             @endforeach

            @endif
        </div>
                
        
        <div class="mt-4 text-center">
                    <a href="{{ route('sales.index') }}" class="bg-blue-500 text-white py-2 px-4 rounded">Back to Sales</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

