<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert a Category</title>
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

        /* Input styling */
        .form-container input[type="text"] {
            width: calc(100% - 5px); /* Matching the padding width */
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
            display: flex;
            gap: 10px;
        }

        .button-group input[type="submit"],
        .button-group button {
            flex: 1;
            padding: 10px;
            font-size: 1em;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: white;
            text-align: center;
            box-sizing: border-box;
        }

        /* Save button */
        .button-group input[type="submit"] {
            background-color: #4a628a;
        }

        /* Cancel button */
        .button-group button {
            background-color: #d9534f;
        }

        /* Hover effects */
        .button-group input[type="submit"]:hover {
            background-color:#4a628a;
        }

        .button-group button:hover {
            background-color: #c9302c;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Insert a Category</h1>

        <div class="error_checking">
            @if($errors->any())
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endif
        </div>

        <form method="post" action="{{ route('category.update', ['category' => $category]) }}" 
              onsubmit="return confirmAction('Are you sure you want to save these changes?')">
            @csrf
            @method('put')
            
            <div class="category_name">
                <label for="category_name">Category Name</label>
                <input type="text" id="category_name" name="category_name" placeholder="Category Name" value="{{ $category->category_name }}" />
            </div>

            <div class="button-group">
                <input type="submit" value="Save Category">
                <button type="button" onclick="window.location.href='{{ url()->previous() }}'">Cancel</button>
            </div>
        </form>
    </div>
</body>
</html>
