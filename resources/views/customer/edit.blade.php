<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Customer Info</title>
    <style>
        /* Basic styling for layout */
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
        .form-group input[type="text"],
        .form-group input[type="number"],
        .form-group input[type="date"],
        .form-group select {
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 0.9em;
        }
        .button-group, .back-group {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .button-group input[type="submit"],
        .button-group .exit-btn {
            padding: 10px;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            color: #fff;
            font-weight: bold;
            text-align: center;
            display: inline-block;
        }
        .button-group input[type="submit"] {
            background-color: #2c3e50;
            width: 48%;
        }
        .button-group .exit-btn {
            background-color: #e74c3c;
            text-decoration: none;
            width: 45%;
        }
        .error_checking {
            color: red;
            font-size: 0.9em;
            margin-bottom: 10px;
        }
    </style>
    <script>
        function confirmAction(message) {
            return confirm(message);
        }
    </script>
</head>
<body>

    <div class="form-container">
        <h1>Update Customer Information</h1>
        
        @if($errors->any())
            <div class="error_checking">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="post" action="{{ route('customer.update', ['customer' => $customer->customer_id]) }}" onsubmit="return confirmAction('Are you sure you want to save these changes?')">
            @csrf 
            @method('put')
        
            <div class="form-grid">
                <div class="form-group">
                    <label for="name">Customer Name</label>
                    <input type="text" name="name" id="name" placeholder="Customer Name" value="{{ old('name', $customer->name) }}" required>
                </div>

                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" placeholder="Customer Address" value="{{ old('address', $customer->address) }}" required>
                </div>

                <div class="form -group">
                    <label>Contact Number</label>
                    <input type="tel" name="contact_no" maxlength="10" inputmode="numeric" pattern="[0-9]{10}" placeholder="e.g., 9123424321" value="{{ old('contact_no', substr($customer->contact_no, 3)) }}" required />
                    <small>Note: Enter only the last 10 digits (e.g., 9123424321)</small>
                </div>
            </div>

            <div class="button-group">
                <input type="submit" value="Update Customer">
                <a href="{{ route('customer.index') }}" class="exit-btn" onclick="return confirmAction('Are you sure you want to cancel this?')">Cancel</a>
            </div>
        </form>
    </div>

</body>
</html>