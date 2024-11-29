
 <!-- Notification Icon -->
 <!-- @php
 $product = App\Models\Inventory::all();
 @endphp
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
    </div>
</div> -->


<nav class="bg-white border-r border-white h-screen w-64 fixed top-0 left-0">


    <div class="flex flex-col h-full">
        <!-- Logo -->
        <div class="shrink-0 p-4 flex justify-center">
            <a href="{{ url('/dashboard') }}">
                <img src="{{ asset('images/ronlogo.png') }}" alt="Logo" class="block h-20 w-20">
            </a>
        </div>

        <!-- User Info (Placed above Dashboard) -->
        <div class="p-4 text-black text-center flex items-center justify-center space-x-4">
            <div class="w-12 h-12 rounded-full bg-gray-300 flex items-center justify-center">
                <span class="text-white text-lg">P</span>
            </div>
            <div>
                <a href="{{ route('profile.edit') }}" class="text-black font-medium text-lg hover:underline">
                    {{ Auth::user()->name }}
                </a>
                <div class="text-sm">
                    <a href="{{ route('profile.edit') }}" class="text-black hover:underline">
                        {{ Auth::user()->email }}
                    </a>
                </div>
            </div>
        </div>

        
        <!-- Navigation Links -->
        <div class="flex-1 overflow-y-auto">
            <ul class="space-y-4 flex flex-col">
                <!-- Dashboard -->
                <li>
                    <x-nav-link href="{{ url('/dashboard') }}" class="text-black w-full px-4 py-2 hover:bg-sky-100 text-center">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </li>
                <!-- Admin Dashboard (Only for SuperAdmin) -->
                @if(Auth::user()->is_superadmin)
                <li>
                    <x-nav-link href="{{ url('/admin/dashboard') }}" class="text-black w-full px-4 py-2 hover:bg-sky-100 text-center">
                        {{ __('Admin Dashboard') }}
                    </x-nav-link>
                </li>
                @endif
                <!-- Notification -->
                <li>
                    <x-nav-link href="{{ url('/notification') }}" class="text-black w-full px-4 py-2 hover:bg-sky-100 text-center">
                        {{ __('Notification') }}
                    </x-nav-link>
                </li>
                <!-- Inventory -->
                <li>
                    <x-nav-link href="{{ route('inventory.index') }}" class="text-black w-full px-4 py-2 hover:bg-sky-100 text-center">
                        {{ __('Inventory') }}
                    </x-nav-link>
                </li>
                <!-- Customer -->
                <li>
                    <x-nav-link href="{{ url('/customer') }}" class="text-black w-full px-4 py-2 hover:bg-sky-100 text-center">
                        {{ __('Customer') }}
                    </x-nav-link>
                </li>
                <!-- Sales -->
                <li>
                    <x-nav-link href="{{ url('/sales') }}" class="text-black w-full px-4 py-2 hover:bg-sky-100 text-center">
                        {{ __('Sales') }}
                    </x-nav-link>
                </li>
                <!-- Technician -->
                <li>
                    <x-nav-link href="{{ url('/techreport') }}" class="text-black w-full px-4 py-2 hover:bg-sky-100 text-center">
                        {{ __('Technician') }}
                    </x-nav-link>
                </li>
                <!-- Setting -->
                <li>
                    <x-nav-link href="{{ url('/settings') }}" class="text-black w-full px-4 py-2 hover:bg-sky-100 text-center">
                        {{ __('Setting') }}
                    </x-nav-link>
                </li>
            </ul>
        </div>

        <!-- Authentication (Log Out) -->
        <div class="border-t border-white mt-auto">
            <div class="space-y-1">
                <form method="POST" action="{{ url('/logout') }}">
                    @csrf
                    <x-nav-link href="{{ url('/logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="w-full text-left px-4 py-2 text-center text-red-500">
                        {{ __('Log Out') }}
                    </x-nav-link>
                </form>
            </div>
        </div>
    </div>

</nav>


<!-- <script>
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
    
</script> -->