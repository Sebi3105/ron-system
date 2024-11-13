<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Insert a Service</h1>
    <div class = "error_checking">
        @if($errors->any())
        <ul>
            @foreach($errors->all as $error)
                <li>{{$error}}</li>

            @endforeach
        </ul>



        @endif
    </div>
    <form method = "post" action="{{route('service.store')}}" onsubmit="return confirmAction('Are you sure you want to save this product?')">
    @csrf 
    @method('post')
    <div class = "brand_name">
        <label>Service Name</label>
        <input type = "service_name" name = "service_name" placeholder="Service Name" />
    </div>
    <div class = "submit">
        <input type = "submit" value = "Save Service">
    </div>
    </form>
    <script src="{{ asset('js/confirmation.js') }}"></script>
</body>
</html>