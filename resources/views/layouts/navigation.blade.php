<nav class="bg-white border-r border-white h-screen w-64 fixed top-0 left-0">


    <div class="flex flex-col h-full">
        <!-- Logo -->
        <div class="shrink-0 p-4 flex justify-center">
            <a href="{{ url('/dashboard') }}">
                <img src="{{ asset('images/ronlogo.png') }}" alt="Logo" class="block h-20 w-20">
            </a>
        </div>

       <!-- User Info (Placed above Dashboard) -->
    <div class="p-4 text-black text-center flex items-center justify-center space-x-4 mb-8">
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
                <x-nav-link href="{{ url('/dashboard') }}" 
                class="text-white w-full px-12 py-2 text-center items-center justify-start hover:bg-navy-blue whitespace-nowrap flex 
                {{ request()->is('dashboard') ? 'bg-navy-blue text-white' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15" />
                </svg>
                {{ __('Dashboard') }}
                </x-nav-link>
                </li>
                
                <!-- Admin Dashboard (Only for SuperAdmin) -->
                @if(Auth::user()->is_superadmin)
                <li>
                <x-nav-link href="{{ url('/admin/dashboard') }}" 
                class="text-white w-full px-12 py-2 text-center  items-center justify-start hover:bg-navy-blue whitespace-nowrap flex 
                {{ request()->is('admin/dashboard') ? 'bg-navy-blue text-white' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                </svg>
                {{ __('Admin Dashboard') }}
                </x-nav-link>
                </li>
                @endif

                <!-- Notifications -->
                <li>
                <x-nav-link href="{{ url('/notification') }}" 
                class="text-white w-full px-12 py-2 text-center items-center justify-start hover:bg-navy-blue whitespace-nowrap flex 
                {{ request()->is('notification') ? 'bg-navy-blue text-white' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                    </svg>
                {{ __('Notification') }}
                </x-nav-link>
                </li>

                <!-- Inventory -->
                <li>
                <x-nav-link href="{{ url('/inventory') }}" 
                class="text-white w-full px-12 py-2 text-center items-center justify-start hover:bg-navy-blue whitespace-nowrap flex 
                {{ request()->is('inventory') ? 'bg-navy-blue text-white' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                {{ __('Inventory') }}
                </x-nav-link>
                </li>

                <!-- Customer -->
                <li>
                <x-nav-link href="{{ url('/customer') }}" 
                class="text-white w-full px-12 py-2 text-center items-center justify-start hover:bg-navy-blue whitespace-nowrap flex 
                {{ request()->is('customer') ? 'bg-navy-blue text-white' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
                {{ __('Customer') }}
                </x-nav-link>
                </li>

                <!-- Sales -->
                <li>
                <x-nav-link href="{{ url('/sales') }}" 
                class="text-white w-full px-12 py-2 text-center items-center justify-start hover:bg-navy-blue whitespace-nowrap flex 
                {{ request()->is('sales') ? 'bg-navy-blue text-white' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                </svg>
                {{ __('Sales') }}
                </x-nav-link>
                </li>

                <!-- Technician -->
                <li>
                <x-nav-link href="{{ url('/techreport') }}" 
                class="text-white w-full px-12 py-2 text-center items-center justify-start hover:bg-navy-blue whitespace-nowrap flex 
                {{ request()->is('techreport') ? 'bg-navy-blue text-white' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75a4.5 4.5 0 0 1-4.884 4.484c-1.076-.091-2.264.071-2.95.904l-7.152 8.684a2.548 2.548 0 1 1-3.586-3.586l8.684-7.152c.833-.686.995-1.874.904-2.95a4.5 4.5 0 0 1 6.336-4.486l-3.276 3.276a3.004 3.004 0 0 0 2.25 2.25l3.276-3.276c.256.565.398 1.192.398 1.852Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.867 19.125h.008v.008h-.008v-.008Z" />
                </svg>
                {{ __('Technician') }}
                </x-nav-link>
                </li>
            </ul>
        </div>

        <!-- Authentication (Log Out) -->
        <div class="border-t border-white mt-auto">
            <div class="space-y-1">
                <form method="POST" action="{{ url('/logout') }}">
                    @csrf
                    <x-nav-link href="{{ url('/logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="w-full text-left px-9 py-2 text-center text-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="Red" class="size-6 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                    </svg>
                        {{ __('Log Out') }}
                    </x-nav-link>
                </form>
            </div>
        </div>
    </div>

</nav>




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


                <!-- Setting
                <li>
                    <x-nav-link href="{{ url('/settings') }}" class="text-black w-full px-12 py-2 hover:bg-navy-blue text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                        {{ __('Setting') }}
                    </x-nav-link>
                </li> -->