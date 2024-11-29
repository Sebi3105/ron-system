<nav class="bg-white border-r border-white h-screen w-64 fixed top-0 left-0">
    <div class="flex flex-col h-full">
        <!-- Logo -->
        <div class="shrink-0 p-8 flex justify-center">
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
            <ul class="space-y-4 flex flex-col py-10">
                <!-- Dashboard -->
                <li class="flex items-center space-x-4 px-10 hover:bg-navy-blue">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15" />
                    </svg>
                    <x-nav-link href="{{ url('/dashboard') }}" class="text-black w-full">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </li>

                <!-- Notification -->
                <li class="flex items-center space-x-4 px-10 py-1 hover:bg-navy-blue">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                    </svg>
                    <x-nav-link href="{{ url('/notifications') }}" class="text-black w-full">
                        {{ __('Notification') }}
                    </x-nav-link>
                </li>

                <!-- Inventory -->
                <li class="flex items-center space-x-4 px-10 py-1 hover:bg-navy-blue">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" />
                    </svg>
                    <x-nav-link href="{{ route('inventory.index') }}" class="text-black w-full">
                        {{ __('Inventory') }}
                    </x-nav-link>
                </li>

                <!-- Customer -->
                <li class="flex items-center space-x-4 px-10 py-1 hover:bg-navy-blue">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14c2.209 0 4-1.791 4-4s-1.791-4-4-4-4 1.791-4 4 1.791 4 4 4zm0 0c-3.333 0-6 2.667-6 6v1h12v-1c0-3.333-2.667-6-6-6z" />
                    </svg>
                    <x-nav-link href="{{ url('/customer') }}" class="text-black w-full">
                        {{ __('Customer') }}
                    </x-nav-link>
                </li>

                <!-- Sales -->
                <li class="flex items-center space-x-4 px-10 py-1 hover:bg-navy-blue">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>
                    <x-nav-link href="{{ url('/sales') }}" class="text-black w-full">
                        {{ __('Sales') }}
                    </x-nav-link>
                </li>

                <!-- Technician -->
                <li class="flex items-center space-x-4 px-10 py-1 hover:bg-navy-blue">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75a4.5 4.5 0 0 1-4.884 4.484c-1.076-.091-2.264.071-2.95.904l-7.152 8.684a2.548 2.548 0 1 1-3.586-3.586l8.684-7.152c.833-.686.995-1.874.904-2.95a4.5 4.5 0 0 1 6.336-4.486l-3.276 3.276a3.004 3.004 0 0 0 2.25 2.25l3.276-3.276c.256.565.398 1.162.428 1.763" />
                    </svg>
                    <x-nav-link href="{{ url('/techreport') }}" class="text-black w-full">
                        {{ __('Technician') }}
                    </x-nav-link>
                </li>
                <!-- Setting -->
                <li class="flex items-center space-x-4 px-10 py-1 hover:bg-navy-blue">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                     <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                    <x-nav-link href="{{ url('/settings') }}" class="text-black w-full">
                        {{ __('Setting') }}
                    </x-nav-link>

                <!-- Log Out -->
                <li class="flex items-center space-x-4 px-10 py-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-red-500">
                      <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                  <form method="POST" action="{{ url('/logout') }}">
                  @csrf
                  <a href="{{ url('/logout') }}" class="text-red-500 text-sm" onclick="event.preventDefault(); this.closest('form').submit();">
                  {{ __('Log Out') }}
                  </a>
                </form>
               </li>
            </ul>
        </div>
    </div>
</nav>
