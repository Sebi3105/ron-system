<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Technician Profile</title>
</head>
<body>
    <h1>Update Technician Profile</h1>
    
    <div class="error_checking">
        @if($errors->any())
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </div>
    
    <form method="post" action="{{ route('techprofile.update', ['techprofile' => $techprofile]) }}" onsubmit="return confirmAction('Are you sure you want to save these changes?')">
        @csrf
        @method('put')
        
        <div class="technician_name">
            <label for="name">Technician Name</label>
            <input type="text" name="name" id="name" placeholder="Technician Name" value="{{ old('name', $techprofile->name) }}" />
        </div>
        
        <div class="contact_no">
            <label for="contact_no">Contact Number</label>
            <input type="text" name="contact_no" id="contact_no" placeholder="Contact Number" value="{{ old('contact_no', $techprofile->contact_no) }}" />
        </div>
        
        <div class="submit">
            <input type="submit" value="Update Profile">
        </div>
    </form>
    
    <script type="text/javascript">
    function confirmAction(message) {
        return confirm(message); // Shows a standard browser confirmation dialog
    }
</script>

</body>
</html>
