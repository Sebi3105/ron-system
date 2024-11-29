<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Customer Info</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f3f3;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 25px 40px;
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        h1 {
            font-size: 22px;
            color: #4A628A;
            margin-bottom: 20px;
            font-weight: bold;
        }

        label {
            display: block;
            font-size: 16px;
            color: #333;
            margin-bottom: 5px;
            text-align: left;
        }

        input[type="text"], input[type="tel"] {
            width: 100%;
            padding: 12px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
            margin-bottom: 20px;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .button-group button,
        .button-group .cancel-btn {
            padding: 12px 0;
            width: 48%;
            border-radius: 8px;
            font-weight: bold;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            color: white;
            display: inline-block;
        }

        .button-group button {
            background-color: #4A628A;
            border: none;
        }

        .button-group button:hover {
            background-color: #3B4D6C;
        }

        .button-group .cancel-btn {
            background-color: #e74c3c;
            border: none;
        }

        .button-group .cancel-btn:hover {
            background-color: #c0392b;
        }

        .error_checking {
            color: red;
            font-size: 0.9em;
            margin-bottom: 10px;
            text-align: left;
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
                    <input type="text" name="name" id="name" placeholder="Customer Name" value="{{ old('name', $customer->name) }}" required pattern="[A-Za-z\s]+" title="Only letters and spaces are allowed" required>
                </div>

                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" placeholder="Customer Address" value="{{ old('address', $customer->address) }}" required>
                </div>

                <div>
                    <label for="contact_no">Contact Number</label>
                    <div style="position: relative;">
                        <span 
                            style="position: absolute; 
                                   top: 33%; 
                                   left: 10px; 
                                   transform: translateY(-50%); 
                                   color: black; 
                                   pointer-events: none; 
                                   font-size: 15px;">
                            +63
                        </span>
                        <input 
                            type="tel" 
                            id="contact_no" 
                            name="contact_no" 
                            maxlength="10" 
                            inputmode="numeric" 
                            pattern="[0-9]{10}" 
                            placeholder="e.g., 9123424321" 
                            title="Enter a valid 10-digit phone number" 
                            style="padding-left: 40px;" 
                            value="{{ old('contact_no', substr($customer->contact_no, 3)) }}"
                            required
                        />
                    </div>
                    <small style="font-size: 12px;">Note: Enter only the last 10 digits (e.g., 9123424321)</small>
                </div>

                <div class="button-group">
                    <button type="submit" value="Update Customer">Save Changes</button>
                    <a href="{{ route('customer.index') }}" class="cancel-btn" onclick="return confirmAction('Are you sure you want to cancel this?')">Cancel</a>
                </div>
            </div>
        </form>
    </div>

</body>
</html>
