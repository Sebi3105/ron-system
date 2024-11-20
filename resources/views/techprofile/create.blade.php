<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert a Service</title>
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

        input[type="text"] {
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
        <h1>Insert a Technician</h1>

        <div class="error_checking">
            @if($errors->any())
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </div>

        <form method="post" action="{{ route('techprofile.store') }}" onsubmit="return confirmAction('Are you sure you want to save this product?')">
            @csrf
            <div>
                <label for="name">Technician Name</label>
                <input type="text" id="name" name="name" placeholder="Technician Name" required>
            </div>
            <div>
                <label for="contact_no">Contact Number</label>
                <input type="text" id="contact_no" name="contact_no" placeholder="Contact Number" required>
            </div>

            <div class="button-group">
                <button type="submit">Save Technician</button>
                <a href="{{ url()->previous() }}" class="cancel-btn" onclick="return confirmAction('Are you sure you want to cancel this?')">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
