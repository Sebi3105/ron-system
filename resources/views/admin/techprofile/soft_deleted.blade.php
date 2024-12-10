<x-app-layout>
    <div class="container mx-auto mt-5">
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <h1 class="text-2xl font-semibold mb-4 text-center text-white">Soft Deleted Technician</h1>
        <div class="py-4 overflow-auto max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-gray-200 shadow sm:rounded-lg">
                <table id="softDeletedBrandTable" class="min-w-full table-fixed bg-gray-200 text-black border border-gray-400">
                    <thead class="bg-gray-300">

                            <th class="px-4 py-2 border-b border-gray-400 text-gray-800">#</th>
                            <th class="px-4 py-2 border-b border-gray-400 text-gray-800">Technician Name</th>
                            <th class="px-4 py-2 border-b border-gray-400 text-gray-800">Contact No</th>
                            <th class="px-4 py-2 border-b border-gray-400 text-gray-800">Deleted At</th>
                            <th class="px-4 py-2 border-b border-gray-400 text-gray-800">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($softDeletedItems as $item)
                            <tr class="hover:bg-gray-400">
                                <td class="px-4 py-2 border-b border-gray-400 text-gray-800">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2 border-b border-gray-400 text-gray-800"> {{ $item->name }}</td>
                                <td class="px-4 py-2 border-b border-gray-400 text-gray-800"> {{ $item->contact_no }}</td> <!-- Accessing the related inventory's product name -->
                                <td class="px-4 py-2 border-b border-gray-400 text-gray-800">{{ $item->deleted_at }}</td>
                                <td class="px-4 py-2 border-b border-gray-400 text-gray-800">
                                    <form action="{{ route('admin.techprofile.restore', $item->technician_id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to restore this item?');">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-1 px-2 rounded">Restore</button>
                                    </form>

                                    <form action="{{ route('admin.techprofile.forceDelete', $item->technician_id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this item permanently?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-2 rounded">Delete Permanently</button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Include DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#softDeletedBrandTable').DataTable({
                "paging": true,        // Enable pagination
                "lengthChange": true,  // Allow changing the number of records per page
                "searching": true,     // Enable searching
                "ordering": true,      // Enable sorting
                "info": true,          // Show table information
                "autoWidth": false,    // Disable auto width calculation
                "responsive": true      // Make the table responsive
            });
        });
    </script>
</x-app-layout>



