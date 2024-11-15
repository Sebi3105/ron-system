<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< Updated upstream
    <title>Document</title>
</head>
<body>
    <h1>Update Brands</h1>
    <div class = "error_checking">
        @if($errors->any())
        <ul>
            @foreach($errors->all as $error)
                <li>{{$error}}</li>

            @endforeach
        </ul>



        @endif
    </div>
    <form method = "post" action="{{route('brand.update', ['brand' => $brand])}}" onsubmit="return confirmAction('Are you sure you want to save these changes')">
    @csrf 
    @method('put')
    <div class = "brand_name">
        <label>Update Brand</label>
        <input type = "brand_name" name = "brand_name" placeholder="Brand Name" value = "{{$brand->brand_name}}"/>
    </div>
    <div class = "submit">
        <input type = "submit" value = "Update Brand">
    </div>
    </form>
=======
    <title>Update Brands</title>
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
            padding: 20px 40px;
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
            color: #333;
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

        /* Input styling */
        .form-container input[type="text"],
        .form-container select {
            width: 95%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1em;
        }

        /* Button styling */
        .button-group {
            display: flex;
            justify-content: space-between;
        }

        .button-group input[type="submit"],
        .button-group button {
            width: 48%;
            padding: 10px;
            font-size: 1em;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 1px;
        }

        /* Save button */
        .button-group input[type="submit"] {
            background-color: #4a628a;
            color: white;
        }

        /* Cancel button */
        .button-group button {
            background-color: #d9534f;
            color: white;
        }

        /* Hover effects */
        .button-group input[type="submit"]:hover {
            background-color: #4a628a;
        }

        .button-group button:hover {
            background-color: #c9302c;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Update Brand</h1>

        <div class="error_checking">
            @if($errors->any())
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endif
        </div>

        <form method="post" action="{{ route('brand.update', ['brand' => $brand]) }}" 
              onsubmit="return confirmAction('Are you sure you want to save these changes?')">
            @csrf
            @method('put')
            
            <div class="brand_name">
                <label for="brand_name">Brand Name</label>
                <input type="text" id="brand_name" name="brand_name" placeholder="Enter Brand Name" value="{{ $brand->brand_name }}" />
            </div>

            <div class="button-group">
                <input type="submit" value="Save Brand">
                <button type="button" onclick="window.location.href='{{ url()->previous() }}'">Cancel</button>
            </div>
        </form>
    </div>
>>>>>>> Stashed changes
</body>
</html>