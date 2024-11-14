<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert a Product</title>
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
        .full-width {
            grid-column: span 2;
        }
        .button-group, .back-group {
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
        /* Styling for Back button with icon */
        .back-group {
            margin-bottom: 20px;
            display: flex;
            justify-content: flex-start;
        }
        .back-group a {
            background-color: #3b5998; /* Change color to match the reference */
            color: white;
            padding: 8px 15px;
            border-radius: 12px; /* Rounded corners */
            font-weight: normal;
            display: flex;
            align-items: center;
            text-decoration: none;
            font-size: 0.9em;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); /* Soft shadow */
            transition: background-color 0.3s;
        }
        .back-group a:hover {
            background-color: #314e75; /* Darker shade on hover */
        }
        .back-group a .icon {
            margin-right: 8px;
            font-size: 1.2em;
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
        <a href="{{ route('inventory.index') }}">
            <span class="icon">←</span> Back
        </a>
    </div>

    <div class="form-container">
        <h1>Add Product Information</h1>
        
        @if($errors->any())
            <div class="error_checking">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="post" action="{{ route('inventory.store') }}" onsubmit="return confirmAction('Are you sure you want to save this product?')">
            @csrf

            <div class="form-grid">
                <div class="form-group">
                    <label for="product_name">Product Name</label>
                    <input type="text" name="product_name" id="product_name" placeholder="Product Name" required>
                </div>

                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select name="category_id" id="category_id" required>
                        <option value="" selected>Select a Category</option>
                        @foreach($category as $categories)
                            <option value="{{ $categories->category_id }}">{{ $categories->category_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="brand_id">Brand</label>
                    <select name="brand_id" id="brand_id" required>
                        <option value="" selected>Select a Brand</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->brand_id }}">{{ $brand->brand_name }}</option>
                        @endforeach
                    </select>
                </div>
                <br>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" name="price" id="price" placeholder="Price" required min="0">
                </div>

                <div class="form-group">
                <label for="quantity">Quantity</label>
                    <input type="number" name="quantity" placeholder="Quantity" required min="0">
                </div>

                <div class="form-group">
                    <label for="released_date">Date of Release</label>
                    <input type="date" name="released_date" id="released_date" required>
                </div>

                <div class="form-group">
                    <label for="notes">Notes</label>
                    <input type="text" name="notes" id="notes" placeholder="Notes">
                </div>
            </div>

            <div class="button-group">
                <input type="submit" value="Save Product">
                <button type="button" class="cancel-btn" onclick="window.location.href='{{ url()->previous() }}'">Cancel</button>
            </div>
        </form>
    </div>
    
    <script src="{{ asset('js/confirmation.js') }}"></script>
</body>
</html>