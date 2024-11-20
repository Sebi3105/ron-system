<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Customer</title>
</head>
<body>
    <h1>Create Customer</h1>
    <div class="error_checking">
        @if($errors->any())
            <ul>
                @foreach($errors->all() as $error) <!-- Fixed the method call here -->
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </div>
    <form method="post" action="{{ route('customer.store') }}" onsubmit="return confirmAction('Are you sure you want to save this customer?')">
        @csrf 
        @method('post')
        
        <div class="customer_name">
            <label>Customer Name</label>
            <input type="text" name="name" placeholder="Customer Name" required />
        </div>
        
        <div class="customer_address">
            <label>Address</label>
            <input type="text" name="address" placeholder="Science City of Munoz" required />
        </div>
        
        <div class="customer_contactno">
            <label>Contact Number</label>
            <input type="tel" name="contact_no" maxlength="10" inputmode="numeric" pattern="[0-9]{10}" placeholder="e.g., 9123424321" required />
            <small>Note: Enter only the last 10 digits (e.g., 9123424321)</small>
        </div>
        
        <div class="submit">
            <input type="submit" value="Save Customer Profile">
        </div>
    </form>
    
    <script>
        function confirmAction(message) {
            return confirm(message);
        }
    </script>
</body>
</html>