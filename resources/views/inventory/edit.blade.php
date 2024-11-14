<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
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
        <h1>Update Product Information</h1>
        
        @if($errors->any())
            <div class="error_checking">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="post" action="{{ route('inventory.update', ['inventory' => $inventory->product_id]) }}" onsubmit="return confirmAction('Are you sure you want to save these changes?')">
            @csrf 
            @method('put')
        
            <div class="form-grid">
                <div class="form-group">
                    <label for="product_name">Product Name</label>
                    <input type="text" name="product_name" id="product_name" placeholder="Product Name" value="{{ old('product_name', $inventory->product_name) }}" required>
                </div>

                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select name="category_id" id="category_id" required>
                        <option value="" selected>Select a Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->category_id }}" {{ $category->category_id == $inventory->category_id ? 'selected' : '' }}>
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="brand_id">Brand</label>
                    <select name="brand_id" id="brand_id" required>
                        <option value="" selected>Select a Brand</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->brand_id }}" {{ $brand->brand_id == $inventory->brand_id ? 'selected' : '' }}>
                                {{ $brand->brand_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" name="quantity" id="quantity" placeholder="Quantity" value="{{ old('quantity', $inventory->quantity) }}" required min="0">
                </div>

                <div class="form-group">
                    <label for="released_date">Date of Release</label>
                    <input type="date" name="released_date" id="released_date" value="{{ old('released_date', \Carbon\Carbon::parse($inventory->released_date)->format('Y-m-d')) }}" required>
                </div>

                <div class="form-group full-width">
                    <label for="notes">Notes</label>
                    <input type="text" name="notes" id="notes" placeholder="Notes" value="{{ old('notes', $inventory->notes) }}">
                </div>
            </div>

            <div class="button-group">
                <input type="submit" value="Update Product">
                <a href="{{ route('inventory.index') }}" class="exit-btn" onclick="return confirmAction('Are you sure you want to cancel this?')">Cancel</a>
            </div>
        </form>
    </div>

</body>
</html>