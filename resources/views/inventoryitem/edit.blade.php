<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Inventory Item</title>
    <script>
        function confirmAction(message) {
            return confirm(message);
        }
    </script>
    <style>
        /* Center the form container */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f5f5f5;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        /* Form container styling */
        .form-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        /* Form header */
        .form-container h1 {
            font-size: 1.5em;
            margin-bottom: 20px;
            color: #4a4a4a;
        }

        /* Error checking list */
        .error_checking ul {
            color: red;
            list-style-type: none;
            padding: 0;
            margin: 10px 0;
        }

        /* Label styling */
        .form-container label {
            display: block;
            font-weight: bold;
            margin-top: 10px;
            text-align: left;
        }

        /* Input and select styling */
        .form-container input[type="text"],
        .form-container select {
            width: calc(100% - 20px); /* Matching the padding width */
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1em;
            box-sizing: border-box;
        }

        /* Button styling */
        .button-group {
            margin-top: 20px;
        }

        .button-group input[type="submit"],
        .button-group a {
            display: block;
            width: 95%;
            padding: 9px;
            font-size: 1em;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            margin-bottom: 10px;
            margin-left: 10px;
            box-sizing: border-box;
        }

        /* Save button */
        .button-group input[type="submit"] {
            background-color: #3b5998;
            color: white;
        }

        /* View button */
        .button-group a {
            background-color: #d9534f;
            color: white;
        }

        /* Hover effects */
        .button-group input[type="submit"]:hover {
            background-color: #2e4477;
        }

        .button-group a:hover {
            background-color: #c9302c;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Edit Inventory Item</h1>

        <div class="error_checking">
            @if($errors->any())
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endif
        </div>

        <form method="post" action="{{ route('inventoryitem.update', ['inventoryitem' => $inventoryitem->sku_id]) }}" 
              onsubmit="return confirmAction('Are you sure you want to save these changes?')">
            @csrf
            @method('put')

            <div class="productid_dropdown">
                <label for="product_id">Product</label>
                <select name="product_id" id="product_id">
                    <option value="" selected>Choose Product</option>
                    @foreach($inventories as $inventory)
                        <option value="{{ $inventory->product_id }}" {{ $inventory->product_id == $inventoryitem->product_id ? 'selected' : '' }}>
                            {{ $inventory->product_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="serial_number">
                <label for="serial_number">Serial Number</label>
                <input type="text" id="serial_number" name="serial_number" placeholder="Serial Number" value="{{ old('serial_number', $inventoryitem->serial_number) }}">
            </div>

            <div class="condition">
                <label for="condition">Condition</label>
                <select name="condition" id="condition">
                    <option value="working" {{ $inventoryitem->condition == 'working' ? 'selected' : '' }}>Working</option>
                    <option value="defective" {{ $inventoryitem->condition == 'defective' ? 'selected' : '' }}>Defective</option>
                </select>
            </div>

            <div class="button-group">
                <input type="submit" value="Save Serial Number">
                <a href="{{ route('inventoryitem.serials', ['product_id' => $inventoryitem->product_id]) }}">View Serial Numbers</a>
            </div>
        </form>
    </div>
</body>
</html>