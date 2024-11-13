<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Technician Profiles</title>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
</head>
<body>
    <h1>Technician Profiles</h1>

    <div class="success_pop">
        @if(session()->has('success'))
        <div class="success">
            {{ session('success') }}
        </div>
        @endif
    </div>

    <form method="GET" action="{{ route('techprofile.index') }}">
        <input type="text" name="search" placeholder="Search by name" value="{{ request()->input('search') }}">
        <button type="submit">Search</button>
        <a href="{{ route('techprofile.index') }}" class="clear-search">Clear Search</a>
    </form>

    <div class="create_link">
        <a href="{{ route('techprofile.create') }}">Insert New Technician</a>
    </div>

    <div class="table">
        <table border="1" id="techprofile">
            <thead>
                <tr>
                    <th></th>
                    <th>Technician ID</th>
                    <th>Technician Name</th>
                    <th>Contact Number</th>
                    <th>Actions</th>
                </tr>
            </thead>    
            <tbody></tbody>
        </table>
    </div>

    <script src="{{ asset('js/confirmation.js') }}"></script>
    <script>
        $(document).ready(function() {
            var table = $('#techprofile').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('techprofile.index') }}",
                columns: [
                    {
                        data: null,
                        orderable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    { data: 'technician_id', name: 'technician_id' },
                    { data: 'name', name: 'name' },
                    { data: 'contact_no', name: 'contact_no' },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $('#techprofile tbody').on('click', '.delete-btn', function() {
                var deleteUrl = $(this).data('url');
                if (confirm('Are you sure you want to delete this technician profile?')) {
                    $.ajax({
                        url: deleteUrl,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            alert('Technician profile deleted successfully!');
                            table.ajax.reload();
                        },
                        error: function(xhr) {
                            console.log('Error deleting technician profile: ' + (xhr.responseJSON.message || 'An unexpected error occurred.'));
                        }
                    });
                }
            });
        });
    </script>

</body>
</html>
