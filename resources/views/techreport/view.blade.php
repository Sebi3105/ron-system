<x-app-layout>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <div class="flex flex-col md:flex-row min-h-screen">
        <!-- Sidebar (Navigation) -->
        <div class="w-full md:w-64 fixed top-0 left-0 z-10 h-screen bg-gray-900 md:block">
            @include('layouts.navigation') 
        </div>

        <!-- Main Content -->
        <div class="flex-1 md:ml-64 mt-16 md:mt-0 bg-gray-100 text-gray-800"> 
            <!-- Fixed Header -->
            <header class="bg-gray-200 py-3 px-3 fixed top-0 md:left-64 right-0 z-20 h-16 flex items-center justify-between text-black shadow-md">
                <h1 class="text-lg font-bold">Technician Report</h1>
            </header>
             
            <!-- Back to Technician View Button -->
            <div class="flex justify-start mt-24 md:mt-28 px-4">
                <a href="{{ route('techreport.index') }}" class="back-btn flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l-7-7 7-7" />
                    </svg>
                    Back to Technician
                </a>
            </div>

            <!-- Centered Form -->
            <div class="flex justify-center items-center py-16">
                <div class="form-container mx-auto p-6 bg-white rounded-lg shadow-md w-full sm:w-11/12 md:w-3/4 lg:w-1/2">
                    <h1 class="text-lg text-center font-bold stitle" style="color:#4A628A; font-size:22px;">Technician Report</h1>
                    
                    @if($errors->any())
                        <div class="error_checking">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="post" action="{{ route('techreport.update', ['techreport' => $techreport]) }}">
                        @csrf
                        @method('put')

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <!-- Row 1 -->
                            <div class="form-group">
                                <label for="technician_id">Technician</label>
                                <input type="text" name="technician_id" id="technician_id" value="{{ $techreport->technician->name ?? 'N/A' }}" readonly>
                            </div>

                            <div class="form-group">
                                <label for="customer_id">Customer</label>
                                <input type="text" name="customer_id" id="customer_id" value="{{ $techreport->customer->name ?? 'N/A' }}" readonly>
                            </div>

                            <!-- Row 2 -->
                            <div class="form-group">
                                <label for="sku_id">Serial No.</label>
                                <input type="text" name="sku_id" id="sku_id" value="{{ $techreport->inventory->serial_number ?? 'N/A' }}" readonly>
                            </div>

                            <div class="form-group">
                                <label for="service_id">Service</label>
                                <input type="text" name="service_id" id="service_id" value="{{ $techreport->service->service_name ?? 'N/A' }}" readonly>
                            </div>

                            <!-- Row 3 -->
                            <div class="form-group">
                                <label for="date_of_completion">Date of Completion</label>
                                <input type="date" name="date_of_completion" value="{{ old('date_of_completion', $techreport->date_of_completion) }}" readonly>
                            </div>

                            <div class="form-group">
                                <label for="payment_type">Payment Type</label>
                                <input type="text" name="payment_type" id="payment_type" value="{{ ucfirst(str_replace('_', ' ', $techreport->payment_type)) }}" readonly>
                            </div>

                            <!-- Row 4 -->
                            <div class="form-group">
                                <label for="payment_method">Payment Method</label>
                                <input type="text" name="payment_method" id="payment_method" value="{{ ucfirst($techreport->payment_method) }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <input type="text" name="status" id="status" value="{{ ucfirst($techreport->status) }}" readonly>
                            </div>

                            <!-- Row 5 -->
                            <div class="form-group">
                                <label>Remarks</label>
                                <input type="text" name="remarks" value="{{ $techreport->remarks ?? 'No remarks' }}" readonly>
                            </div>

                            <div class="form-group">
                                <label for="cost">Cost</label>
                                <input type="number" step="0.01" name="cost" id="cost" value="{{ $techreport->cost }}" readonly>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        body {
            font-family: 'Poppins';
            background-color: #f3f3f3;
            margin: 0;
        }
        .form-container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 30px;
            width: 750px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .stitle {
            font-size: 1.2em;
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 1px;
        }
        .form-group label {
            color: #555;
            margin-bottom: 1px;
        }
        .form-group input[type="number"],
        .form-group input[type="text"],
        .form-group input[type="date"],
        .form-group select {
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 0.9em;
            width: 100%;
        }
        
        .form-group input[readonly] {
            background-color: #f5f5f5;
            border-color: #ddd;
        }

        .full-width {
            grid-column: span 2;
        }
    </style>
</x-app-layout>
