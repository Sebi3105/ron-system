<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Inventory Item</title>
    <script>
        function confirmAction(message) {
            return confirm(message);
        }
    </script>
</head>
<body>
    <h1>Edit Inventory Item</h1>
    <div class="error_checking">
        @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif
    </div>
    <form method="post" action="{{ route('inventoryitem.update', ['inventoryitem' => $inventoryitem->sku_id]) }}" onsubmit="return confirmAction('Are you sure you want to save these changes?')">
        @csrf
        @method('put')
        <div class="productid_dropdown">
            <select name="product_id" id="product_id">
                <option value="" selected>Choose Product</option>
                @foreach($inventories as $inventory)
                    <option value="{{ $inventory->product_id }}" {{ $inventory->product_id == $inventoryitem->product_id ? 'selected' : '' }}>
                        {{ $inventory->product_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="serial_number">
            <label>Serial Number</label>
            <input type="text" name="serial_number" placeholder="Serial Number" value="{{ old('serial_number', $inventoryitem->serial_number) }}">
        </div>
        <div class="condition">
            <select name="condition" id="condition">
                <option value="working" {{ $inventoryitem->condition == 'working' ? 'selected' : '' }}>Working</option>
                <option value="defective" {{ $inventoryitem->condition == 'defective' ? 'selected' : '' }}>Defective</option>
            </select>
        </div>
        <div class="submit">
            <input type="submit" value="Save Serial Number">
        </div>
    </form>
    <div>
        <a href="{{ route('inventoryitem.serials', ['product_id' => $inventoryitem->product_id]) }}">View Serial Numbers</a>
    </div>
</body>
</html>
