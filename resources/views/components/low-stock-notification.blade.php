@php
    // Get all products ordered by updated_at
    $product = App\Models\Inventory::orderBy('updated_at', 'desc')->get();
    $limit = 5; 
@endphp

<div class="fixed top-4 right-4 z-50">
    <div class="relative">
        <button id="notificationButton" class="relative text-black bg-gray-200 hover:bg-gray-300 rounded-full p-3">
            🔔
            <span class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                {{ count($product->where('quantity', '<=', 4)) }}
            </span>
        </button>   

        <div id="notificationDropdown" class="hidden absolute right-0 mt-2 w-80 bg-white border border-gray-200 shadow-md rounded-lg">
            <div class="p-4">
                <h4 class="text-lg font-bold text-center">Low Stock Alerts</h4>
                <ul class="mt-2 space-y-2">
                    @foreach($product->take($limit) as $products)
                        @if($products->quantity <= 0)
                            <li class="text-sm out-of-stock p-3 rounded-lg" style="line-height: 1.1;">
                                The product <strong class="uppercase">{{ $products->product_name }}</strong> is out of stock.
                            </li>
                        @elseif($products->quantity >= 1 && $products->quantity <= 4)
                            <li class="text-sm low-stock p-3 rounded-lg" style="line-height: 1.1;">
                                The stock for <strong class="uppercase">{{ $products->product_name }}</strong> is running low. Only {{ $products->quantity }} left.
                            </li>
                        @endif
                    @endforeach
                </ul>
                <div class="mt-4 text-center">
                    <a href="{{ route('notification.index') }}" class="text-blue-500 hover:text-blue-700 text-sm">
                        See all notifications
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
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
@endpush

<style>
    .out-of-stock {
        background-color: #ffdddd;
        border: 1px solid #ff0000;
    }

    .low-stock {
        background-color: #fff8dc;
        border: 1px solid #ffd700;
    }

    .uppercase {
        text-transform: uppercase;
    }
</style>
