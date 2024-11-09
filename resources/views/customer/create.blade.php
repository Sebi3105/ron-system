<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>
<body>
    <h1>Create Customer</h1>
    <div class = "error_checking">
    @if($errors->any())
        <ul>
            @foreach($errors->all as $error)
                <li>{{$error}}</li>

            @endforeach
        </ul>



        @endif
    </div>
    <form method = "post" action="{{route('customer.store')}}" onsubmit="return confirmAction('Are you sure you want to save this product?')">
    @csrf 
    @method('post')
    <div class = "customer_name">
        <label>Customer Name</label>
        <input type = "customer_name" name = "name" placeholder="Customer Name" />
    </div>
    <div class = "customer_address">
        <label>Address</label>
        <input type = "customer_address" name = "address" placeholder="Science City of Munoz" />
    </div>
    <div class = "customer_contactno">
        <label>Contact Number</label>
        <input type="tel" name="contact_no" maxlength="10" inputmode="tel" pattern="[1-9]{10}" placeholder="e.g., 9123424321" />
    </div>
    <div class = "submit">
        <input type = "submit" value = "Save Customer Profile">
    </div>
    </form>
</body>
<script>
        function confirmAction(message) {
            return confirm(message);
        }
    </script>
</html>