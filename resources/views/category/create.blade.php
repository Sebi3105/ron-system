<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
    <script>
        function confirmAction(message) {
            return confirm(message);
        }
    </script>
</head>
<body>
    <h1>Add New Category</h1>
    <div class="success_pop">
        @if(session()->has('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif
    </div>

    <form method="POST" action="{{ route('category.store') }}" onsubmit="return confirmAction('Are you sure you want to save these changes')">
        @csrf
        <label for="category_name">Category Name:</label>
        <input type="text" name="category_name" required>
        <button type="submit">Add Category</button>
    </form>
    
    <a href="{{ route('inventory.index') }}">Back to Inventory</a>
</body>
</html>
