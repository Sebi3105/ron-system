<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Technician Report</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Select2 CSS and JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" integrity="sha512-YHJ091iDoDM1PZZA9QLuBvpo0VXBBiGHsvdezDoc3p56S3SOMPRjX+zlCbfkOV5k3BmH5O9FqrkKxBRhkdtOkQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js" integrity="sha512-XBxUMC4YQcL60PavAScyma2iviXkiWNS5Yf+A0LZRWI1PNiGHkp66yPQxHWDSlv6ksonLAL2QMrUlCKq4NHhSQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f7f7f7;
        }
        .form-container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 30px;
            width: 600px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        h1 {
            font-size: 1.2em;
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 15px;
        }
        .form-group label {
            font-weight: bold;
            color: #555;
            margin-bottom: 5px;
        }
        .form-group select,
        .form-group input {
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 0.9em;
        }
        .full-width {
            grid-column: span 2;
        }
        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .button-group input[type="submit"],
        .button-group .cancel-btn {
            width: 48%;
            padding: 10px;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            color: #fff;
            font-weight: bold;
        }
        .button-group input[type="submit"] {
            background-color: #2c3e50;
        }
        .button-group .cancel-btn {
            background-color: #e74c3c;
        }
        .back-group {
            margin-bottom: 20px;
        }
        .back-group a {
            background-color: #3b5998;
            color: white;
            padding: 8px 15px;
            border-radius: 12px;
            text-decoration: none;
            font-size: 0.9em;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            display: inline-block;
        }
        .back-group a:hover {
            background-color: #314e75;
        }
        .error_checking {
            color: red;
            font-size: 0.9em;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    <div class="back-group">
        <a href="{{ route('techreport.index') }}">← Back</a>
    </div>

    <div class="form-container">
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

            <div class="form-grid">
                <div class="form-group">
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

                <div class="form-group">
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

                <div class="form-group">
                    <label for="sku_id">Serial No.</label>
                    <select name="sku_id" id="sku_id" required>
                        <option value="" selected>Select Serial</option>
                        @foreach($inventoryitem as $item)
                            <option value="{{ $item->sku_id }}" {{ $item->sku_id == $techreport->sku_id ? 'selected' : '' }}>
                                {{ $item->serial_number }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
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

                <div class="form-group">
                    <label for="date_of_completion">Date of Completion</label>
                    <input type="date" name="date_of_completion" value="{{ old('date_of_completion', $techreport->date_of_completion) }}" required>
                </div>

                <div class="form-group">
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

                <div class="form-group">
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

                <div class="form-group">
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

                <div class="form-group">
                    <label for="remarks">Remarks</label>
                    <input type="text" name="remarks" placeholder="Remarks" value="{{ old('remarks', $techreport->remarks) }}">
                </div>

                <div class="form-group">
                    <label for="cost">Cost</label>
                    <input type="number" step="0.01" name="cost" placeholder="Cost" value="{{ old('cost', $techreport->cost) }}" required>
                </div>

                

            <div class="button-group">
                <input type="submit" value="Update Report">
                <a href="{{ route('techreport.index') }}" class="cancel-btn">Cancel</a>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('#technician_id, #customer_id, #sku_id, #service_id, #payment_type, #payment_method, #status').select2();
        });

        function confirmAction(message) {
            return confirm(message);
        }
    </script>

</body>
</html>
