<x-app-layout>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <div class="flex flex-col md:flex-row h-screen">
        <!-- Sidebar (Navigation) -->
        <div class="w-full md:w-64 fixed top-0 left-0 z-10 h-screen bg-gray-900 md:block">
            @include('layouts.navigation') 
        </div>     

        <!-- Main Content -->
        <div class="flex-1 md:ml-64 mt-16 md:mt-0 bg-gray-100 text-gray-800"> 
            <!-- Fixed Header -->
            <header class="bg-gray-200 py-3 px-3 fixed top-0 md:left-64 right-0 z-20 h-16 flex items-center justify-between text-black shadow-md">
                <h1 class="text-lg font-bold">Sale Information</h1>
            </header>
              
            <!-- Back to Sales View Button -->
            <div class="flex justify-start mt-24 md:mt-28 px-4"> <!-- Reduced margin-top -->
                <a href="{{ route('sales.index') }}" class="back-btn flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l-7-7 7-7" />
                    </svg>
                    Back to Sales
                </a>
            </div>
            
            <!-- Displaying Sale Details -->
            <div class="flex justify-center items-center">
                <div class="details-container">
                    <h1 class="text-lg text-center font-bold stitle">SALES DETAILS</h1>

                    <!-- Sale Information -->
                    <div class="detail">
                        <span class="label">Customer Name:</span>
                        <span>{{ $sale->customer->name ?? 'N/A' }}</span>
                    </div>

                    <div class="detail">
                        <span class="label">Product:</span>
                        <span>{{ $sale->inventory->product_name ?? 'N/A' }}</span>
                    </div>

                    <div class="detail">
                        <span class="label">Serial Number:</span>
                        <span>{{ $sale->serial_number ?? 'N/A' }}</span>
                    </div>

                    <div class="detail">
                        <span class="label">State:</span>
                        <span>{{ $sale->state ?? 'N/A' }}</span>
                    </div>

                    <div class="detail">
                        <span class="label">Sale Date:</span>
                        <span>{{ $sale->sale_date ?? 'N/A' }}</span>
                    </div>

                    <div class="detail">
                        <span class="label">Amount:</span>
                        <span>{{ number_format($sale->amount, 2) ?? 'N/A' }}</span>
                    </div>

                    <div class="detail">
                        <span class="label">Payment Method:</span>
                        <span>{{ ucfirst($sale->payment_method) ?? 'N/A' }}</span>
                    </div>

                    <div class="detail">
                        <span class="label">Payment Type:</span>
                        <span>{{ ucfirst($sale->payment_type) ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .details-container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 30px;
            width: 100%;
            max-width: 600px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .stitle {
            font-size: 1.5rem;
            text-align: center;
            margin-bottom: 20px;
            color: #4a628a;
        }

        .detail {
            margin-bottom: 10px;
            font-size: 1rem;
            line-height: 1.5;
        }

        .detail .label {
            font-weight: bold;
            color: #555;
            margin-right: 10px;
        }

        .detail span {
            color: #333;
        }

        .back-btn {
            color: #3C3D37;
            padding: 0.3rem 1.2rem;
            font-size: 1rem;
          
            border-radius: 0.375rem;
            transition: transform 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: -1.5REM;
        }

        .back-btn:hover {
            background-color: #F5F5F5;
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
