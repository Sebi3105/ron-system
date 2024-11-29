<!-- <x-app-layout>

    Notification Icon
<div class="fixed top-4 right-4">
    <div class="relative">
 
        <button id="notificationButton" class="relative text-black bg-gray-200 hover:bg-gray-300 rounded-full p-3">
            🔔
            <span class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                {{ count($product->where('quantity', '<=', 4)) }}
            </span>
        </button>

       
        <div id="notificationDropdown" class="hidden absolute right-0 mt-2 w-64 bg-white border border-gray-200 shadow-md rounded-lg">
            <div class="p-4">
                <h4 class="text-lg font-bold">Low Stock Alerts</h4>
                <ul class="mt-2 space-y-2">
                    @foreach($product as $index => $products)
                        @if($products->quantity <= 4)
                            <li class="text-sm">The stock for product {{ $products->product_name }} is running low. Only {{ $products->quantity }} left</li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div> -->
<!-- </div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const notificationButton = document.getElementById('notificationButton');
        const notificationDropdown = document.getElementById('notificationDropdown');

        // Toggle dropdown
        notificationButton.addEventListener('click', () => {
            notificationDropdown.classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', (event) => {
            if (!notificationButton.contains(event.target) && !notificationDropdown.contains(event.target)) {
                notificationDropdown.classList.add('hidden');
            }
        });
    });
    
</script>

</x-app-layout> -->