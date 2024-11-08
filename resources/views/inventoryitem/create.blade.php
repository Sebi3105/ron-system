<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert</title>
</head>
<body>
    <h1>Insert Serial Number</h1>
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
        <input type="hidden" name="product_id" value="{{ $selectedInventory->product_id }}"> <!-- Hidden field for product_id -->
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
