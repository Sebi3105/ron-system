<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
</head>
<body>
    <h1>Edit Product</h1>
    
    <div class="error_checking">
        @if($errors->any())
            <ul>
                @foreach($errors->all() as $error) <!-- Fixed method call here -->
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </div>

    <form method="post" action="{{ route('inventory.update', ['inventory' => $inventory->product_id]) }}" onsubmit="return confirmAction('Are you sure you want to save these changes')">
        @csrf 
        @method('put')
        
        <div class="category_dropdown">
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id">
                <option value="" selected>Select a Category</option>
                @foreach($categories as $category)
                     <option value="{{ $category->category_id }}" {{ $category->category_id == $inventory->category_id ? 'selected' : '' }}>
                     {{ $category->category_name }}
                  </option>
                @endforeach

            </select>
        </div>

        <div class="brand_dropdown">
            <label for="brand_id">Brand</label>
            <select name="brand_id" id="brand_id">
                <option value="" selected>Select a Brand</option>
                @foreach($brands as $brand)
                    <option value="{{ $brand->brand_id }}" {{ $brand->brand_id == $inventory->brand_id ? 'selected' : '' }}>
                        {{ $brand->brand_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="product_name">
            <label>Product Name</label>
            <input type="text" name="product_name" placeholder="Product Name" value="{{ old('product_name', $inventory->product_name) }}">
        </div>

        <div class="quantity">
            <label>Quantity</label>
            <input type="number" name="quantity" placeholder="Quantity" value="{{ old('quantity', $inventory->quantity) }}">
        </div>

        <div class="date">
            <label>Date</label>
            <input type="date" name="released_date" value="{{ old('released_date', \Carbon\Carbon::parse($inventory->released_date)->format('Y-m-d')) }}">
        </div>
        <div class="status_dropdown">
    <label for="status">Status</label>
    <select name="status" id="status">
        <option value="available" {{ $inventory->status == 'available' ? 'selected' : '' }}>Available</option>
        <option value="low_stock" {{ $inventory->status == 'low_stock' ? 'selected' : '' }}>Low Stock</option>
        <option value="out_of_stock" {{ $inventory->status == 'out_of_stock' ? 'selected' : '' }}>Out Of Stock</option>
    </select>
    </div>
        <div class="notes">
            <label>Notes</label>
            <input type="text" name="notes" placeholder="Notes" value="{{ old('notes', $inventory->notes) }}">
        </div>

        <div class="submit">
            <input type="submit" value="Update Product">
        </div>
        <div class="exit_button" style="margin-top: 20px;">
        <a href="{{ route('inventory.index') }}" style="text-decoration: none;">
            <button type="button">Exit</button>
        </a>
    </div>

    </form>
</body>
</html>
