<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Serial Number</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f3f3f3;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
           justify-content: center;
        }

        .form-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 25px 40px;
            width: 100%;
            max-width: 450px;
            box-sizing: border-box;
        }

        .form-container div {
            margin-bottom: 20px;
        }

        label {
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 12px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
            transition: border-color 0.3s ease;
            box-sizing: border-box;
        }

        input[type="text"]:focus,
        select:focus {
            border-color: #4A628A;
            outline: none;
        }

        .button-group {
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
            background-color: #4A628A;
            width: 48%;
        }

        .button-group .exit-btn {
            background-color: #e74c3c;
            text-decoration: none;
            width: 45%;
        }

        .button-group input[type="submit"]:hover {
            background-color: #3b4e6a;
        }

        .button-group .exit-btn:hover {
            background-color: #c0392b;
        }

        .error_checking ul {
            color: #d9534f;
            list-style-type: none;
            padding: 0;
            margin: 0;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .error_checking li {
            margin-bottom: 10px;
        }

        .error_checking li:last-child {
            margin-bottom: 0;
        }

        .error-checking ul li::before {
            content: "⚠️ ";
            margin-right: 5px;
        }
    </style>
</head>
<body>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Serial Number</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f3f3f3;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
           justify-content: center;
        }

        .form-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 25px 40px;
            width: 100%;
            max-width: 450px;
            box-sizing: border-box;
        }

        .form-container div {
            margin-bottom: 20px;
        }

        label {
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 12px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
            transition: border-color 0.3s ease;
            box-sizing: border-box;
        }

        input[type="text"]:focus,
        select:focus {
            border-color: #4A628A;
            outline: none;
        }

        .button-group {
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
            background-color: #4A628A;
            width: 48%;
        }

        .button-group .exit-btn {
            background-color: #e74c3c;
            text-decoration: none;
            width: 45%;
        }

        .button-group input[type="submit"]:hover {
            background-color: #3b4e6a;
        }

        .button-group .exit-btn:hover {
            background-color: #c0392b;
        }

        .error_checking ul {
            color: #d9534f;
            list-style-type: none;
            padding: 0;
            margin: 0;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .error_checking li {
            margin-bottom: 10px;
        }

        .error_checking li:last-child {
            margin-bottom: 0;
        }

        .error-checking ul li::before {
            content: "⚠️ ";
            margin-right: 5px;
        }
    </style>
</head>
<body>
<div class="container mx-auto p-4">
    <h1>Create Serial Number for {{ $selectedInventory->product_name }}</h1>

    <p>You can create up to {{ $amount }} serial numbers for this product.</p>

    @if ($errors->any())
        <div class="bg-red-500 text-white p-2 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('inventoryitem.store') }}">
        @csrf
        <input type="hidden" name="product_id" value="{{ $selectedInventory->product_id }}">

        <div class="form-group">
            <label for="serial_number">Serial Number</label>
            <input type="text" name="serial_number" id="serial_number" required>
        </div>

        <div class="form-group">
            <label for="condition">Condition</label>
            <select name="condition" id="condition" required>
                @foreach($conditions as $condition)
                    <option value="{{ $condition }}">{{ ucfirst($condition) }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Create Serial Number</button>
    </form>

    <div class="mt-4">
        <a href="{{ route('inventory.index') }}" class="text-blue-500 hover:underline">Back to Inventory</a>
    </div>
</div>
    <script src="{{ asset('js/confirmation.js') }}"></script>
</body>
</html>
    <script src="{{ asset('js/confirmation.js') }}"></script>
</body>
</html>