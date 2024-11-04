<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert a Product</title>
</head>
<body>
    <h1>Insert a Product</h1>
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
        @method('post')
        <div class="category_dropdown">
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id" required>
                <option value="" selected>Select a Category</option>
                @foreach($category as $categories)
                    <option value="{{ $categories->category_id }}">{{ $categories->category_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="brand_dropdown">
            <label for="brand_id">Brand</label>
            <select name="brand_id" id="brand_id" required>
                <option value="" selected>Select a Brand</option>
                @foreach($brands as $brand)
                    <option value="{{ $brand->brand_id }}">{{ $brand->brand_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="product_name">
            <label>Product Name</label>
            <input type="text" name="product_name" placeholder="Product Name" required>
        </div>

        <div class="quantity">
            <label>Quantity</label>
            <input type="number" name="quantity" placeholder="Quantity" required min="0">
        </div>

        <div class="date">
            <label>Date</label>
            <input type="date" name="released_date" required>
        </div>

        <div class="status_dropdown">
    </div>


        <div class="notes">
            <label>Notes</label>
            <input type="text" name="notes" placeholder="Notes">
        </div>

        <div class="submit">
            <input type="submit" value="Save Product">
        </div>
    </form>
    <script src="{{ asset('js/confirmation.js') }}"></script>
</body>
</html>
