<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Technician Report</title>
</head>
<body>
    <h1>Edit Technician Report</h1>

    @if($errors->any())
        <div class="error_checking">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ route('techreport.update', ['techreport' => $techreport]) }}" onsubmit="return confirmAction('Are you sure you want to save these changes?')">
        @csrf
        @method('put')

        <!-- Technician Dropdown -->
        <div class="technician_dropdown">
            <label for="technician_id">Technician</label>
            <select name="technician_id" id="technician_id" required>
                <option value="" selected>Select Technician</option>
                @foreach($techprofile as $technician)
                    <option value="{{ $technician->technician_id }}" {{ $technician->technician_id == $techreport->technician_id ? 'selected' : '' }}>
                        {{ $technician->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Customer Dropdown -->
        <div class="customer_dropdown">
            <label for="customer_id">Customer</label>
            <select name="customer_id" id="customer_id" required>
                <option value="" selected>Select Customer</option>
                @foreach($customer as $cust)
                    <option value="{{ $cust->customer_id }}" {{ $cust->customer_id == $techreport->customer_id ? 'selected' : '' }}>
                        {{ $cust->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- SKU Dropdown -->
        <div class="sku_dropdown">
            <label for="sku_id">SKU</label>
            <select name="sku_id" id="sku_id" required>
                <option value="" selected>Select SKU</option>
                @foreach($inventoryitem as $item)
                    <option value="{{ $item->sku_id }}" {{ $item->sku_id == $techreport->sku_id ? 'selected' : '' }}>
                        {{ $item->sku_id }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Service Dropdown -->
        <div class="service_dropdown">
            <label for="service_id">Service</label>
            <select name="service_id" id="service_id" required>
                <option value="" selected>Select Service</option>
                @foreach($service as $srv)
                    <option value="{{ $srv->service_id }}" {{ $srv->service_id == $techreport->service_id ? 'selected' : '' }}>
                        {{ $srv->service_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Date of Completion -->
        <div class="date_of_completion">
            <label for="date_of_completion">Date of Completion</label>
            <input type="date" name="date_of_completion" value="{{ old('date_of_completion', $techreport->date_of_completion) }}" required>
        </div>

        <!-- Payment Type Dropdown -->
        <div class="payment_type_dropdown">
            <label for="payment_type">Payment Type</label>
            <select name="payment_type" id="payment_type" required>
                <option value="" selected>Select Payment Type</option>
                @foreach($paymenttype as $type)
                    <option value="{{ $type }}" {{ $type == $techreport->payment_type ? 'selected' : '' }}>
                        {{ ucfirst(str_replace('_', ' ', $type)) }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Payment Method Dropdown -->
        <div class="payment_method_dropdown">
            <label for="payment_method">Payment Method</label>
            <select name="payment_method" id="payment_method" required>
                <option value="" selected>Select Payment Method</option>
                @foreach($paymentmethod as $method)
                    <option value="{{ $method }}" {{ $method == $techreport->payment_method ? 'selected' : '' }}>
                        {{ ucfirst($method) }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Status Dropdown -->
        <div class="status_dropdown">
            <label for="status">Status</label>
            <select name="status" id="status" required>
                <option value="" selected>Select Status</option>
                @foreach($statuses as $status)
                    <option value="{{ $status }}" {{ $status == $techreport->status ? 'selected' : '' }}>
                        {{ ucfirst($status) }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Remarks -->
        <div class="remarks">
            <label for="remarks">Remarks</label>
            <input type="text" name="remarks" placeholder="Remarks" value="{{ old('remarks', $techreport->remarks) }}">
        </div>

        <!-- Cost -->
        <div class="cost">
            <label for="cost">Cost</label>
            <input type="number" step="0.01" name="cost" placeholder="Cost" value="{{ old('cost', $techreport->cost) }}" required min="0">
        </div>

        <!-- Submit -->
        <div class="submit">
            <input type="submit" value="Save Report">
        </div>
    </form>

    <script src="{{ asset('js/confirmation.js') }}"></script>
</body>
</html>
