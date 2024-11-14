<nav id="sidebar" class="bg-white dark:bg-gray-800 border-r border-white dark:border-gray-700 h-screen fixed top-0 left-0 w-64 lg:w-64 md:w-56 sm:w-48 
    w-full hidden lg:block transition-all duration-300">
    <div class="flex flex-col h-full">
        <!-- Logo -->
        <div class="shrink-0 p-4 flex justify-center">
            <a href="{{ url('/dashboard') }}">
                <img src="{{ asset('images/ronlogo.png') }}" alt="Logo" class="block h-20 w-20">
            </a>
        </div>

        <!-- User Info (Placed above Dashboard) -->
        <div class="p-4 text-black dark:text-gray-400 text-center flex items-center justify-center space-x-4 mb-8">
            <div class="w-12 h-12 rounded-full bg-gray-300 dark:bg-gray-600 flex items-center justify-center">
                <span class="text-white text-lg">P</span>
            </div>
            <div class="hidden sm:block">
                <a href="{{ route('profile.edit') }}" class="text-black dark:text-gray-400 font-medium text-lg hover:underline">
                    {{ Auth::user()->name }}
                </a>
                <div class="text-sm">
                    <a href="{{ route('profile.edit') }}" class="text-black dark:text-gray-400 hover:underline">
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
                    <x-nav-link href="{{ url('/dashboard') }}" class="text-black dark:text-gray-400 w-full px-12 py-2 hover:bg-navy-blue text-center hover:text-white">
                        <!-- Dashboard Icon (Heroicons) -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15" />
</svg>

                        <span class="hidden sm:inline">{{ __('Dashboard') }}</span>
                    </x-nav-link>
                </li>
                <!-- Notification -->
                <li>
                    <x-nav-link href="{{ url('/notifications') }}" class="text-black dark:text-gray-400 w-full px-12 py-2 hover:bg-navy-blue text-center hover:text-white">
                        <!-- Bell Icon (Heroicons) -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700 sm:inline-block" fill="none" stroke="currentColor" 
                            viewBox="0 0 24 24" stroke-width="1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 8a6 6 0 00-12 0v4a6 6 0 00-3 5h18a6 6 0 00-3-5V8z"></path>
                        </svg>
                        <span class="hidden sm:inline">{{ __('Notification') }}</span>
                    </x-nav-link>
                </li>
                <!-- Inventory -->
                <li>
                    <x-nav-link href="{{ route('inventory.index') }}" class="text-black dark:text-gray-400 w-full px-12 py-2 hover:bg-navy-blue text-center hover:text-white">
                        <!-- Box Icon (Heroicons) -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
</svg>

                        </svg>
                        <span class="hidden sm:inline">{{ __('Inventory') }}</span>
                    </x-nav-link>
                </li>
                <!-- Customer -->
                <li>
                    <x-nav-link href="{{ url('/customers') }}" class="text-black dark:text-gray-400 w-full px-12 py-2 hover:bg-navy-blue text-center hover:text-white">
                        <!-- Users Icon (Heroicons) -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 
                        0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                        <span class="hidden sm:inline">{{ __('Customer') }}</span>
                    </x-nav-link>
                </li>
                <!-- Sales -->
                <li>
                    <x-nav-link href="{{ url('/sales') }}" class="text-black dark:text-gray-400 w-full px-12 py-2 hover:bg-navy-blue text-center hover:text-white">
                        <!-- Dollar Sign Icon (Heroicons) -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
</svg>

                        <span class="hidden sm:inline">{{ __('Sales') }}</span>
                    </x-nav-link>
                </li>
                <!-- Technician -->
                <li>
                    <x-nav-link href="{{ url('/technicians') }}" class="text-black dark:text-gray-400 w-full px-12 py-2 hover:bg-navy-blue text-center hover:text-white">
                        <!-- Tools Icon (Heroicons) -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700 sm:inline-block" fill="none" stroke="currentColor" 
                            viewBox="0 0 24 24" stroke-width="1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 11l-3 3m0 0l-3-3m3 3V4m0 7L9 6m0 0L6 9"></path>
                        </svg>
                        <span class="hidden sm:inline">{{ __('Technician') }}</span>
                    </x-nav-link>
                </li>
                <!-- Settings -->
                <li>
                    <x-nav-link href="{{ url('/settings') }}" class="text-black dark:text-gray-400 w-full px-12 py-2 hover:bg-navy-blue text-center hover:text-white">
                        <!-- Settings Icon (Heroicons) -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
  <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
</svg>

                        <span class="hidden sm:inline">{{ __('Setting') }}</span>
                    </x-nav-link>
                </li>
            </ul>
        </div>
    </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-nav-link href="{{ url('/logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" 
                        class="w-full text-left px-20 py-2 text-center text-red-500">
                        <!-- Sign Out Icon (Heroicons) -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-red-700 sm:inline-block" fill="none" stroke="currentColor" 
                            viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 10l4-4m0 0l-4-4m4 4H7"></path>
                        </svg>
                        <span class="hidden sm:inline">{{ __('Log Out') }}</span>
                    </x-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

<!-- Mobile Hamburger Menu -->
<div class="lg:hidden p-4 fixed top-0 left-0 z-10">
    <button onclick="toggleSidebar()" class="text-black">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
    </button>
</div>

<script>
    // Toggle sidebar visibility for mobile
    function toggleSidebar() {
        let sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('hidden');
    }
</script>