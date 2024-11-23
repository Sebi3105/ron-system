<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create A Sale</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
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
        .form-group input[type="text"],
        .form-group input[type="number"],
        .form-group input[type ="date"],
        .form-group select {
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 0.9em;
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
            text-align: center;
            text-decoration: none;
            display: inline-block;
        }
        .button-group input[type="submit"] {
            background-color: #2c3e50;
        }
        .button-group .cancel-btn {
            background-color: #e74c3c;
        }
        .error_checking {
            color: red;
            font-size: 0.9em;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h1>Add Sales Information</h1>
        
        @if($errors->any())
            <div class="error_checking">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form method="post" action="{{ route('sales.store') }}" onsubmit="return confirm('Are you sure you want to save this product?')">
            @csrf

            <div class="form-group">
                <label for="customer">Customer Name</label>
                <select name="customer_id" id="customer_id" required>
                    <option value="" selected>Select Customer</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->customer_id }}">{{ $customer->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="inventories">Product</label>
                <select name="inventory_id" id="inventories" required>
                    <option value="" selected>Select Product</option>
                    @foreach($inventories as $inventory)
                        <option value="{{ $inventory->product_id }}">{{ $inventory->product_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="serials">Serial Number</label>
                <select name="serials" id="serials" required>
                    <option value="" selected>Select Serial Number</option>
                </select>
            </div>

            <div class="form-group">
                <label for="state">State</label>
                <select name="state" id="state" required>
                    <option value="" selected>Select State</option>
                    <option value="reserved">Reserved</option>
                    <option value="for_pickup">For Pickup</option>
                    <option value="for_delivery">For Delivery</option>
                </select>
            </div>

            <div class="form-group">
                <label for="sale_date">Sale Date</label>
                <input type="date" name="sale_date" id="sale_date" required>
            </div>

            <div class="form-group">
                <label for="amount">Amount</label>
                <input type="number" name="amount" id="amount" step="0.01" required>
            </div>

            <div class="form-group">
                <label for="payment_type">Payment Type</label>
                <select name="payment_type" id="payment_type" required>
                    <option value="" selected>Select Payment Type</option>
                    <option value="credit_card">Credit Card</option>
                    <option value="cash">Cash</option>
                    <option value="gcash">GCash</option>
                    <option value="paymaya">Paymaya</option>
                </select>
            </div>

            <div class="button-group">
                <input type="submit" value="Save Sale">
                <a href="{{ route('sales.index') }}" class="cancel-btn">Cancel</a>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('#customer_id, #inventories, #serials').select2();

            // When product is selected
            $('#inventories').change(function() {
                var productId = $(this).val();
                if (productId) {
                    $.ajax({
                        url: '{{ route("sales.serials", "") }}/ ' + productId,
                        type: 'GET',
                        success: function(data) {
                            // Clear the serials dropdown
                            $('#serials').empty().append('<option value="" selected>Select Serial Number</option>');
                            // Use a Set to avoid duplicates
                            const uniqueSerials = new Set();
                            $.each(data, function(index, serial) {
                                uniqueSerials.add(serial.serial_number); // Add to Set for uniqueness
                                // Populate dropdown with sku_id as value and serial_number as display text
                                $('#serials').append('<option value="' + serial.sku_id + '">' + serial.serial_number + '</option>');
                            });
                            // Re-initialize Select2 for the serials dropdown
                            $('#serials').select2();
                        },
                        error: function() {
                            alert('Error fetching serial numbers.');
                        }
                    });
                } else {
                    // Clear the serials dropdown if no product is selected
                    $('#serials').empty().append('<option value="" selected>Select Serial Number</option>');
                    $('#serials').select2();
                }
            });
        });
    </script>
</body>
</html>