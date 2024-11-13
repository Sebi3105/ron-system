<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
</head>
<body>
    <h1>Services</h1>
    <div class = "success_pop">
        @if(session()->has('success'))
        <div class = "success">
            {{session('success')}}
        </div>
        @endif
    </div>
    <form method="GET" action="{{ route('service.index') }}">
        <input type="text" name="search" placeholder="Search by name" value="{{ request()->input('search') }}">
        <button type="submit">Search</button>
        <a href="{{ route('service.index') }}" class="clear-search">Clear Search</a>
    </form>
    <div class = "create_link">
        <a href = "{{route('service.create')}}">Insert New Service</a>
    </div>
    </div>
    <div class="table">
        <table border="1" id="service">
            <thead>
                <tr>
                    <th></th>
                    <th>Service ID</th>
                    <th>Service Name</th>
                    <th>Actions</th>
                </tr>
            </thead>    
            <tbody></tbody>
        </table>
    </div>
    <script src="{{ asset('js/confirmation.js') }}"></script>
    <script>
       $(document).ready(function() {
    var table = $('#service').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('service.index') }}",
        columns: [
            {
                data: null,
                orderable: false,
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { data: 'service_id', name: 'service_id' },
            { data: 'service_name', name: 'service_name' },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
        ]
    });

    $('#service tbody').on('click', '.delete-btn', function() {
        var deleteUrl = $(this).data('url');
        if (confirm('Are you sure you want to delete this item?')) {
            $.ajax({
                url: deleteUrl,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert('Item deleted successfully!');
                    table.ajax.reload();
                },
                error: function(xhr) {
                    console.log('Error deleting item: ' + (xhr.responseJSON.message || 'An unexpected error occurred.'));
                }
            });
        }
    });
});

    </script>
</body>
</html>
