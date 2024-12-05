<x-app-layout>
    <!-- Include jQuery and DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <div class="flex flex-col md:flex-row h-screen">
        <div class="flex-1 md:ml-48 lg:ml-64 mt-0 bg-gray-100 text-gray-800">
            <!-- Fixed Header -->
            <header class="bg-gray-200 py-3 px-3 md:px-6 fixed top-0 md:left-48 lg:left-64 right-0 z-20 h-15 flex items-center justify-between text-black shadow-md">
                <h1 class="text-lg font-bold">Sales History for {{ $customer->name }}</h1>
            </header>

            <!-- Back to Inventory Button -->
            <div class="flex justify-start mt-20 md:mt-24 px-4">
                <a href="{{ route('customer.index') }}" class="back-btn flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l-7-7 7-7" />
                    </svg>
                    Back to Customer List
                </a>
            </div>

            <div class="flex justify-center px-12 py-4">
    <div class="overflow-hidden rounded-lg shadow-md bg-white w-full max-w-5xl">
        <table id="sales" class="min-w-full table-fixed">
            <thead class="bg-blue-500 text-white">
                <tr>
                    <th class="py-2 px-4 text-left">#</th>
                    <th class="py-2 px-4 text-left">Customer Name</th>
                    <th class="py-2 px-4 text-left">Product Name</th>
                    <th class="py-2 px-4 text-left">Serial Number</th>
                    <th class="py-2 px-4 text-left">State</th>
                    <th class="py-2 px-4 text-left">Sale Date</th>
                    <th class="py-2 px-4 text-left">Amount</th>
                    <th class="py-2 px-4 text-left">Payment Type</th>
                </tr>
            </thead>
            <tbody>
                @if ($sales->isEmpty())
                    <tr>
                        <td colspan="8" class="py-2 px-4 text-center">No sales data available for this customer.</td>
                    </tr>
                @else
                    @foreach($sales as $key => $sale)
                        <tr class="hover:bg-gray-100 border-b border-gray-300">
                            <td class="py-2 px-4">{{ $key + 1 }}</td>
                            <td class="py-2 px-4">{{ $sale->customer->name }}</td>
                            <td class="py-2 px-4">{{ $sale->inventory->product_name }}</td>
                            <td class="py-2 px-4">{{ $sale->inventoryItem->serial_number }}</td>
                            <td class="py-2 px-4">{{ $sale->state }}</td>
                            <td class="py-2 px-4">{{ $sale->sale_date->format('Y-m-d') }}</td>
                            <td class="py-2 px-4">{{ number_format($sale->amount, 2) }}</td>
                            <td class="py-2 px-4">{{ ucfirst($sale->payment_type) }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>



    <style>
        body {
            font-family: 'Poppins';
        }

        @media (max-width: 768px) {
            .fixed {
                position: static;
                width: 100%;
                height: auto;
            }
            header {
                left: 0;
                padding-left: 1rem;
            }
            .insert-btn {
                width: 100%;
                text-align: center;
                margin-left: 0;
                padding: 0.6rem;
            }
        }

        .container {
            width: 80%;
            max-width: 1000px;
            margin: 1rem auto 2rem auto;
            padding: 1rem;
            background-color: #ffffff;
            border-radius: 0.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .table {
            width: 100%;
            color: #4a5568;
            border-radius: 3px;
            overflow: hidden;
            border-collapse: collapse;
        }

        th, td {
            padding: 14px;
            font-size: 14px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4A628A;
            color: #fff;
        }

        tr:hover {
            background-color: #edf2f7;
        }

        .back-btn {
            color: #3C3D37;
            padding: 0.3rem 1.2rem;
            font-size: 1rem;
            font-weight: bold;
            border-radius: 0.375rem;
            transition: transform 0.3s ease;
            text-decoration: none;
            margin-left: 2rem;
            margin-top: -1rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .back-btn:hover {
            transform: translateX(-5px);
        }

        .back-btn svg {
            transition: transform 0.3s ease;
        }

        .back-btn:hover svg {
            transform: translateX(-8px);
        }
    </style>
</x-app-layout>
