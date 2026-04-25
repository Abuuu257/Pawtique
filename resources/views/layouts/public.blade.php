<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Pawtique - Premium Pet Boutique offering curated collections of organic treats, chic accessories, and professional grooming essentials.">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 24 24%22 fill=%22%23f59e0b%22><path d=%22M12 21.5c-1.5 0-2.8-1.1-3.4-2.5-.5-1.1-1.4-1.9-2.5-2.2-1.8-.4-3.1-1.9-3.1-3.8 0-2.1 1.7-3.8 3.8-3.8.4 0 .9.1 1.3.2 1.4.5 3-1.1 2.8-2.6-.2-1.6.9-3.2 2.5-3.6 1.8-.4 3.6 1 3.6 2.8 0 1.2.8 2.3 1.9 2.7 1.4.5 2.2 1.9 2.2 3.3 0 2-1.6 3.6-3.6 3.6-.5 0-.9-.1-1.4-.2-1.3-.5-2.8 1-2.7 2.4.2 1.4-.8 2.8-2.1 3.3-.4.2-.9.4-1.3.4z%22/></svg>">
    <title>Pawtique | Premium Pet Boutique</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
        .glass-nav {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }
        .hero-gradient {
            background: linear-gradient(135deg, #fdfbfb 0%, #ebedee 100%);
        }
        .text-gradient {
            background: linear-gradient(to right, #f59e0b, #ef4444);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>
<body class="antialiased bg-gray-50 text-gray-900 selection:bg-orange-500 selection:text-white flex flex-col min-h-screen">
    @if(session('success'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="fixed top-24 right-4 z-[60]"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-x-10"
         x-transition:enter-end="opacity-100 translate-x-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-x-0"
         x-transition:leave-end="opacity-0 translate-x-10">
        <div class="bg-gray-900 text-white px-6 py-4 rounded-xl shadow-2xl flex items-center gap-3 border border-gray-800">
            <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="font-semibold">{{ session('success') }}</span>
        </div>
    </div>
    @endif

    <!-- Navigation -->
    <nav x-data="{ open: false }" class="fixed w-full z-50 glass-nav transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center gap-2 cursor-pointer group">
                    <div class="p-1.5 bg-orange-100 rounded-xl group-hover:bg-orange-500 transition-colors duration-300">
                        <svg class="w-7 h-7 text-orange-500 group-hover:text-white transition-colors duration-300" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 21.5c-1.5 0-2.8-1.1-3.4-2.5-.5-1.1-1.4-1.9-2.5-2.2-1.8-.4-3.1-1.9-3.1-3.8 0-2.1 1.7-3.8 3.8-3.8.4 0 .9.1 1.3.2 1.4.5 3-1.1 2.8-2.6-.2-1.6.9-3.2 2.5-3.6 1.8-.4 3.6 1 3.6 2.8 0 1.2.8 2.3 1.9 2.7 1.4.5 2.2 1.9 2.2 3.3 0 2-1.6 3.6-3.6 3.6-.5 0-.9-.1-1.4-.2-1.3-.5-2.8 1-2.7 2.4.2 1.4-.8 2.8-2.1 3.3-.4.2-.9.4-1.3.4z"/>
                        </svg>
                    </div>
                    <span class="font-extrabold text-2xl tracking-tight text-gray-900">Pawtique</span>
                </a>

                <!-- Center Navigation Links -->
                <div class="hidden lg:flex items-center space-x-1 pl-4 border-l border-gray-200">
                    <a href="{{ route('home') }}" class="relative px-3 py-2 text-sm font-semibold {{ request()->routeIs('home') ? 'text-gray-900' : 'text-gray-600 hover:text-orange-500' }} transition-colors duration-200 group">
                        Home
                        <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-1 h-1 rounded-full {{ request()->routeIs('home') ? 'bg-orange-500 scale-100' : 'bg-orange-500 scale-0 group-hover:scale-100' }} transition-transform duration-200"></span>
                    </a>
                    <a href="{{ route('products') }}" class="relative px-3 py-2 text-sm font-semibold {{ request()->routeIs('products') ? 'text-gray-900' : 'text-gray-600 hover:text-orange-500' }} transition-colors duration-200 group">
                        Products
                        <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-1 h-1 rounded-full {{ request()->routeIs('products') ? 'bg-orange-500 scale-100' : 'bg-orange-500 scale-0 group-hover:scale-100' }} transition-transform duration-200"></span>
                    </a>
                    <a href="{{ route('subscriptions') }}" class="relative px-3 py-2 text-sm font-semibold {{ request()->routeIs('subscriptions') ? 'text-gray-900' : 'text-gray-600 hover:text-orange-500' }} transition-colors duration-200 group">
                        Subscriptions
                        <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-1 h-1 rounded-full {{ request()->routeIs('subscriptions') ? 'bg-orange-500 scale-100' : 'bg-orange-500 scale-0 group-hover:scale-100' }} transition-transform duration-200"></span>
                    </a>
                    <a href="{{ route('contact') }}" class="relative px-3 py-2 text-sm font-semibold {{ request()->routeIs('contact') ? 'text-gray-900' : 'text-gray-600 hover:text-orange-500' }} transition-colors duration-200 group">
                        Contact Us
                        <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-1 h-1 rounded-full {{ request()->routeIs('contact') ? 'bg-orange-500 scale-100' : 'bg-orange-500 scale-0 group-hover:scale-100' }} transition-transform duration-200"></span>
                    </a>
                    @auth
                        @if(Auth::user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="relative px-3 py-2 text-sm font-extrabold text-orange-600 hover:text-orange-700 bg-orange-50 rounded-full transition-colors duration-200 group ml-2 flex items-center gap-1.5 shadow-sm">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path></svg>
                            Admin
                        </a>
                        @endif
                    @endauth
                </div>

                <!-- Right Side Actions & Auth -->
                <div class="flex items-center space-x-5">
                    <!-- Cart Icon -->
                    @php $cartQty = collect(session()->get('cart', []))->sum('quantity'); @endphp
                    <a href="{{ route('cart') }}" class="relative p-2 {{ request()->routeIs('cart') ? 'text-orange-500 bg-orange-50' : 'text-gray-600 bg-gray-100' }} hover:text-orange-500 transition-colors duration-200 group hover:bg-orange-50 rounded-full">
                        <svg class="w-5 h-5 transform group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        @if($cartQty > 0)
                        <!-- Badge -->
                        <span class="absolute top-0 right-0 -mt-1 -mr-1 flex h-4 w-4 items-center justify-center rounded-full bg-rose-500 text-[9px] font-bold text-white shadow-sm ring-2 ring-white">
                            {{ $cartQty }}
                        </span>
                        @endif
                    </a>

                    @if (Route::has('login'))
                        <div class="hidden lg:flex items-center space-x-4 pl-2 border-l border-gray-200">
                            @auth
                                <!-- Profile Dropdown -->
                                <div x-data="{ open: false }" @click.away="open = false" class="relative">
                                    <button @click="open = !open" class="flex items-center gap-2 group focus:outline-none">
                                        <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-orange-400 to-rose-400 p-[2px] transition-transform duration-300 group-hover:scale-105 shadow-sm">
                                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                                <img class="w-full h-full rounded-full border-2 border-white object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                            @else
                                                <div class="w-full h-full rounded-full border-2 border-white bg-white flex items-center justify-center text-orange-500 font-bold text-sm">
                                                    {{ substr(Auth::user()->name, 0, 1) }}
                                                </div>
                                            @endif
                                        </div>
                                        <span class="font-semibold text-sm text-gray-700 group-hover:text-orange-500 transition-colors duration-200">{{ strtok(Auth::user()->name, " ") }}</span>
                                        <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </button>

                                    <!-- Dropdown Menu -->
                                    <div x-show="open" 
                                         x-transition:enter="transition ease-out duration-200"
                                         x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                                         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                         x-transition:leave="transition ease-in duration-75"
                                         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                                         x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                                         class="absolute right-0 mt-3 w-48 py-2 bg-white rounded-2xl shadow-2xl border border-gray-100 z-[60]" x-cloak>
                                        
                                        <div class="px-4 py-2 border-b border-gray-50 mb-1">
                                            <p class="text-[10px] font-black uppercase tracking-widest text-gray-400">Manage Account</p>
                                        </div>

                                        <a href="{{ route('profile.custom') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm font-bold text-gray-700 hover:bg-gray-50 hover:text-orange-500 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                            My Profile
                                        </a>

                                        <form method="POST" action="{{ route('logout') }}" x-data>
                                            @csrf
                                            <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm font-bold text-rose-500 hover:bg-rose-50 transition-colors text-left">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                                Log Out
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @else
                                <!-- Login & Register -->
                                <a href="{{ route('login') }}" class="font-semibold text-sm text-gray-600 hover:text-orange-500 transition-colors duration-200">Log in</a>
                                
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-5 py-2 border border-transparent text-sm font-semibold rounded-full text-white bg-gray-900 hover:bg-orange-500 transition-all duration-300 shadow hover:shadow-lg transform hover:-translate-y-0.5">
                                        Sign up
                                    </a>
                                @endif
                            @endauth
                        </div>
                    @endif
                    
                    <!-- Mobile Menu Button -->
                    <button @click="open = !open" class="lg:hidden p-2 text-gray-600 hover:text-orange-500 bg-gray-100 hover:bg-orange-50 rounded-full focus:outline-none transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                            <path x-cloak x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
            
            <!-- Mobile Menu Dropdown -->
            <div x-cloak x-show="open" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-4"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-4"
                 class="lg:hidden absolute left-0 right-0 top-full bg-white/95 backdrop-blur shadow-lg border-b border-gray-100 px-4 pt-2 pb-6 flex flex-col space-y-4 rounded-b-2xl">
                <a href="{{ route('home') }}" class="text-lg font-semibold text-gray-800 hover:text-orange-500">Home</a>
                <a href="{{ route('products') }}" class="text-lg font-semibold text-gray-800 hover:text-orange-500">Products</a>
                <a href="{{ route('subscriptions') }}" class="text-lg font-semibold text-gray-800 hover:text-orange-500">Subscriptions</a>
                <a href="{{ route('contact') }}" class="text-lg font-semibold text-gray-800 hover:text-orange-500">Contact Us</a>
                <hr class="border-gray-100">
                @if (Route::has('login'))
                    @auth
                        @if(Auth::user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="text-lg font-black text-orange-600 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path></svg>
                            Admin Dashboard
                        </a>
                        @endif
                        <a href="{{ route('profile.custom') }}" class="text-lg font-semibold text-gray-800 hover:text-orange-500">My Profile</a>
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf
                            <button type="submit" class="text-lg font-semibold text-rose-500 hover:text-rose-600 w-full text-left">Log Out</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-lg font-semibold text-gray-800 hover:text-orange-500">Log In</a>
                        <a href="{{ route('register') }}" class="text-lg font-semibold text-orange-500">Sign Up</a>
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- Main Content Slot -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 pt-16 pb-8 mt-auto border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
                <!-- Branding -->
                <div class="col-span-1 lg:col-span-1">
                    <div class="flex items-center gap-2 mb-6">
                        <svg class="w-8 h-8 text-orange-500" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 21.5c-1.5 0-2.8-1.1-3.4-2.5-.5-1.1-1.4-1.9-2.5-2.2-1.8-.4-3.1-1.9-3.1-3.8 0-2.1 1.7-3.8 3.8-3.8.4 0 .9.1 1.3.2 1.4.5 3-1.1 2.8-2.6-.2-1.6.9-3.2 2.5-3.6 1.8-.4 3.6 1 3.6 2.8 0 1.2.8 2.3 1.9 2.7 1.4.5 2.2 1.9 2.2 3.3 0 2-1.6 3.6-3.6 3.6-.5 0-.9-.1-1.4-.2-1.3-.5-2.8 1-2.7 2.4.2 1.4-.8 2.8-2.1 3.3-.4.2-.9.4-1.3.4z"/>
                        </svg>
                        <span class="font-extrabold text-white text-2xl tracking-tight">Pawtique</span>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed">Providing premium, organic, and expertly crafted products for your furry friends. Because they deserve the best.</p>
                </div>

                <!-- Livewire Newsletter Component -->
                <div class="col-span-1 md:col-span-1 lg:col-span-3 lg:pl-16">
                    <h4 class="text-white font-bold mb-4 text-lg">Stay Updated</h4>
                    <p class="text-sm text-gray-400 mb-6 leading-relaxed">Subscribe to our newsletter for exclusive offers, pet care tips, and new arrival alerts. We never spam.</p>
                    <livewire:newsletter />
                </div>
            </div>

            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center text-center md:text-left gap-4">
                <p class="text-sm text-gray-500">
                    &copy; {{ date('Y') }} Pawtique Premium Pet Boutique. All rights reserved.
                </p>
                <div class="flex space-x-6 text-sm text-gray-400">
                    <a href="#" class="hover:text-orange-500 transition-colors">Privacy Policy</a>
                    <a href="#" class="hover:text-orange-500 transition-colors">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
