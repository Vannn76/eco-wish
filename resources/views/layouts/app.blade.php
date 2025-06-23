<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>@yield('title', 'EcoWish')</title>
    <link rel="icon" type="image/jpg" href="{{ asset('images/logo.jpg') }}">
    <link rel="stylesheet" href="../css/app.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://kit.fontawesome.com/8793f7d3d3.js" crossorigin="anonymous"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>

    <style>
    [x-cloak] {
        display: none !important;
    }
    </style>

    @livewireStyles


</head>

<body class="font-sans antialiased bg-white text-gray-900">
    <header>
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <a href="/"><img src="/images/logo.png" alt="Logo" class="w-16 h-16" /></a>
                <span class="text-lg font-bold text-green-600">EcoWish</span>
            </div>
            <nav class="hidden md:flex items-center space-x-6 text-sm text-gray-700">
                <a href="/"
                    class="nav-link hover:text-green-600  {{ request()->is('/') ? 'text-green-600 font-bold' : '' }}">
                    <i class="fas fa-home mr-1"></i> Home
                </a>
                <a href="/eco-learn"
                    class="nav-link hover:text-green-600  {{ request()->is('eco-learn*') ? 'text-green-600 font-bold' : '' }}">
                    <i class="fas fa-book-open mr-1"></i> Eco Learn
                </a>
                <a href="/eco-games"
                    class="nav-link hover:text-green-600  {{ request()->is('eco-games*') ? 'text-green-600 font-bold' : '' }}">
                    <i class="fas fa-gamepad mr-1"></i> Eco Games
                </a>
                <!-- <a href="/eco-journey"
                    class="nav-link hover:text-green-600  {{ request()->is('eco-journey*') ? 'text-green-600 font-bold' : '' }}">
                    <i class="fas fa-leaf mr-1"></i> Eco Journey
                </a>
                <a href="/eco-mart"
                    class="nav-link hover:text-green-600 {{ request()->is('eco-mart*') ? 'text-green-600 font-bold' : '' }}">
                    <i class="fas fa-store mr-1"></i> Eco Mart
                </a>
                <a href="/eco-circle"
                    class="nav-link hover:text-green-600 {{ request()->is('eco-circle*') ? 'text-green-600 font-bold' : '' }}">
                    <i class="fas fa-users mr-1"></i> Eco Circle
                </a> -->

                @auth
                @if(auth()->user()->is_admin)
                <div x-data="{ open: false }" class="relative" x-cloak>
                    <button @click="open = !open"
                        class="flex items-center gap-1 px-3 py-2 hover:text-green-600 transition-all">
                        <i class="fas fa-user-shield"></i>
                        <span>Admin</span>
                        <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.23 7.21a.75.75 0 011.06.02L10 11.293l3.71-4.06a.75.75 0 011.14.98l-4.25 4.65a.75.75 0 01-1.14 0l-4.25-4.65a.75.75 0 01.02-1.06z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>

                    <div x-show="open" x-transition x-cloak @click.outside="open = false"
                        class="absolute right-0 mt-2 w-48 bg-white border rounded-md shadow z-50 py-2">
                        <a href="/admin/users" class="block px-4 py-2 text-sm hover:bg-gray-100">Kelola Users</a>
                        <a href="/admin/games" class="block px-4 py-2 text-sm hover:bg-gray-100">Kelola Games</a>
                        <a href="/admin/eco-learn" class="block px-4 py-2 text-sm hover:bg-gray-100">Verifikasi
                            Konten</a>
                        <!-- <a href="/admin/eco-journey/missions"
                            class="block px-4 py-2 text-sm hover:bg-gray-100">Tambah/edit
                            Misi</a>
                        <a href="/admin/eco-journey/submissions"
                            class="block px-4 py-2 text-sm hover:bg-gray-100">Verifikasi Misi</a> -->
                    </div>
                </div>
                @endif
                @endauth

                @auth
                <form method="POST" action="/logout">
                    @csrf
                    <button type="submit"
                        class="text-sm text-gray-700 hover:text-red-600 cursor-pointer">Logout</button>
                </form>
                @endauth

                @guest
                <a href="{{ route('login') }}" class="text-sm text-gray-700 hover:text-green-600">Login</a>
                <a href="{{ url('/register') }}"
                    class="text-sm text-gray-700 border border-gray-300 px-3 py-1 rounded hover:bg-gray-100">Register</a>
                @endguest
            </nav>
            <div class="md:hidden">
                <button id="mobile-menu-button" class="focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
        <div id="mobile-menu" class="md:hidden hidden px-4 pb-4">
            @auth
            <form method="POST" action="/logout" class="mt-2">
                @csrf
                <button type="submit"
                    class="block w-full text-left py-2 text-sm text-gray-700 hover:text-red-600 cursor-pointer">Logout</button>
            </form>
            @endauth

            @guest
            <a href="{{ route('login') }}" class="text-sm text-gray-700 hover:text-green-600">Login</a>
            <a href="{{ url('/register') }}"
                class="text-sm text-gray-700 border border-gray-300 px-3 py-1 rounded hover:bg-gray-100">Register</a>
            @endguest
        </div>
    </header>

    <main class="mb-12 md:mb-0">
        @yield('content')
    </main>

    <script>
    document.getElementById('mobile-menu-button').addEventListener('click', () => {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });
    </script>
    {{-- Bottom Nav untuk Mobile --}}
    {{-- Bottom Navigation for Mobile --}}
    <nav class="md:hidden fixed bottom-0 left-0 right-0 bg-white border-t shadow z-1">
        <div class="flex justify-around items-center text-xs text-gray-600">
            <a href="/"
                class="flex flex-col items-center py-2 w-full hover:text-green-600 {{ request()->is('/') ? 'text-green-600 font-semibold' : '' }}">
                <i class="fas fa-home text-lg mb-1"></i>
                <span>Home</span>
            </a>
            <a href="/eco-learn"
                class="flex flex-col items-center py-2 w-full hover:text-green-600 {{ request()->is('eco-learn*') ? 'text-green-600 font-semibold' : '' }}">
                <i class="fas fa-book-open text-lg mb-1"></i>
                <span>EcoLearn</span>
            </a>
            <a href="/eco-games"
                class="flex flex-col items-center py-2 w-full hover:text-green-600 {{ request()->is('eco-games*') ? 'text-green-600 font-semibold' : '' }}">
                <i class="fas fa-gamepad text-lg mb-1"></i>
                <span>EcoGames</span>
            </a>
            <!-- <a href="/eco-journey"
                class="flex flex-col items-center py-2 w-full hover:text-green-600 {{ request()->is('eco-journey*') ? 'text-green-600 font-semibold' : '' }}">
                <i class="fas fa-leaf text-lg mb-1"></i>
                <span>EcoJourney</span>
            </a>
            <a href="/eco-mart"
                class="flex flex-col items-center py-2 w-full hover:text-green-600 {{ request()->is('eco-mart*') ? 'text-green-600 font-semibold' : '' }}">
                <i class="fas fa-store text-lg mb-1"></i>
                <span>EcoMart</span>
            </a>
            <a href="/eco-circle"
                class="flex flex-col items-center py-2 w-full hover:text-green-600 {{ request()->is('eco-circle*') ? 'text-green-600 font-semibold' : '' }}">
                <i class="fas fa-users text-lg mb-1"></i>
                <span>EcoCircle</span>
            </a> -->
            {{-- Admin Dropdown - Mobile View --}}
            @auth
            @if(auth()->user()->is_admin)
            <div x-data="{ open: false }"
                class="fixed bottom-20 right-4 z-40 md:hidden rounded-sm p-3 bg-emerald-50 shadow-lg">
                <button @click="open = !open" class="admin-fab">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-user-shield text-lg"></i>
                        <span class="text-sm font-medium">Admin</span>
                        <svg class="w-4 h-4 transform transition-transform duration-200"
                            :class="{ 'rotate-180' : open }" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.23 7.21a.75.75 0 011.06.02L10 11.293l3.71-4.06a.75.75 0 011.14.98l-4.25 4.65a.75.75 0 01-1.14 0l-4.25-4.65a.75.75 0 01.02-1.06z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="admin-notification-dot"></div>
                </button>

                <div x-show="open" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 transform scale-95"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 transform scale-100"
                    x-transition:leave-end="opacity-0 transform scale-95" @click.away="open = false"
                    class="admin-dropdown">

                    <div class="admin-dropdown-header border-b">
                        <h3 class="text-sm font-semibold text-gray-800">Panel Admin</h3>
                        <p class="text-xs text-gray-500 mt-1">Kelola aplikasi</p>
                    </div>

                    <div class="py-2">
                        <a href="/admin/users" class="admin-menu-item">
                            <i class="fas fa-users admin-menu-icon text-green-500"></i>
                            <div class="border-b mb-3">
                                <div class="font-medium">Kelola Users</div>
                                <div class="text-xs text-gray-500">Users management</div>
                            </div>
                        </a>
                        <a href="/admin/games" class="admin-menu-item">
                            <i class="fas fa-gamepad admin-menu-icon text-blue-800"></i>
                            <div class="border-b mb-3">
                                <div class="font-medium">Kelola Games</div>
                                <div class="text-xs text-gray-500">Games management</div>
                            </div>
                        </a>
                        <a href="/admin/eco-learn" class="admin-menu-item">
                            <i class="fas fa-check-circle admin-menu-icon text-blue-500"></i>
                            <div class="border-b mb-3">
                                <div class="font-medium">Verifikasi Konten</div>
                                <div class="text-xs text-gray-500">EcoLearn management</div>
                            </div>
                        </a>

                        <!-- <a href="/admin/eco-journey/missions" class="admin-menu-item">
                            <i class="fas fa-plus-circle admin-menu-icon text-green-500"></i>
                            <div class="border-b mb-3">
                                <div class="font-medium">Kelola Misi</div>
                                <div class="text-xs text-gray-500">Tambah/edit misi harian</div>
                            </div>
                        </a> -->

                        <!-- <a href="/admin/eco-journey/submissions" class="admin-menu-item">
                            <i class="fas fa-clipboard-check admin-menu-icon text-purple-500"></i>
                            <div class="border-b mb-3">
                                <div class="font-medium">Verifikasi Misi</div>
                                <div class="text-xs text-gray-500">Review submission user</div>
                            </div>
                        </a> -->
                    </div>
                </div>
            </div>
            @endif
            @endauth


        </div>
    </nav>

    @stack('scripts')
    @livewireScripts
</body>

</html>