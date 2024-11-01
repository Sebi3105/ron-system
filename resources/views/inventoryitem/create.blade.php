<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert</title>
</head>
<body>
    <h1>Insert</h1>
    <div class="error_checking">
        @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif
    </div>
    <form method="post" action="{{ route('inventoryitem.store') }}" onsubmit="return confirmAction('Are you sure you want to save this product?')">
        @csrf
        @method('post')
        <div class="productid_dropdown">
            <select name="product_id" id="product_id">
                <option value="" selected>Choose what Product</option>
                @foreach($inventories as $inventory)
                    <option value="{{ $inventory->product_id }}">{{ $inventory->product_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="serial_number">
            <label>Serial Number</label>
            <input type="text" name="serial_number" placeholder="Serial Number">
        </div>
        <div class="condition">
            <select name="condition" id="condition">
                <option value="working">Working</option>
                <option value="defective">Defective</option>
            </select>
        </div>
        <div class="submit">
            <input type="submit" value="Save Product">
        </div>
    </form>
    <script src="{{ asset('js/confirmation.js') }}"></script>
</body>
</html>
