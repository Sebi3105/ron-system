    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Update Service</title>
    </head>
    <body>
        <h1>Update Service</h1>
        <div class="error_checking">
            @if($errors->any())
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
        <form method="post" action="{{ route('service.update', ['service' => $service]) }}" onsubmit="return confirmAction('Are you sure you want to save these changes?')">
            @csrf
            @method('put')
            <div class="service_name">
                <label for="service_name">Update Service</label>
                
                <input type="text" name="service_name" id="service_name" placeholder="Service Name" value="{{ old('service_name', $service->service_name) }}" required pattern="[A-Za-z\s]+" title="Only letters and spaces are allowed" required/>

                <!--<input type="service_name" name="service_name" id="service_name" placeholder="Service Name" value="{{$service->service_name }}" />-->
            </div>
            <div class="submit">
                <input type="submit" value="Update Service">
            </div>
        </form>

        <script type="text/javascript">
    function confirmAction(message) {
        return confirm(message); // Shows a standard browser confirmation dialog
    }
</script>

    </body>
    </html>
