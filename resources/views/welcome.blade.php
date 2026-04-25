@extends('layouts.public')
@section('content')

    <!-- Hero Section -->
    <div class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden hero-gradient min-h-screen flex items-center">
        <!-- Decorative blobs -->
        <div class="absolute top-0 -left-4 w-72 h-72 bg-orange-300 rounded-full mix-blend-multiply filter blur-2xl opacity-30 animate-blob"></div>
        <div class="absolute top-0 -right-4 w-72 h-72 bg-yellow-300 rounded-full mix-blend-multiply filter blur-2xl opacity-30 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-8 left-20 w-72 h-72 bg-pink-300 rounded-full mix-blend-multiply filter blur-2xl opacity-30 animate-blob animation-delay-4000"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="lg:grid lg:grid-cols-12 lg:gap-16 items-center">
                <div class="lg:col-span-6 text-center lg:text-left mb-16 lg:mb-0">
                    <span class="inline-block py-1 px-3 rounded-full bg-orange-100 text-orange-600 text-sm font-semibold mb-6 tracking-wide">
                        Premium Quality for Your Pets
                    </span>
                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-extrabold tracking-tight mb-8 leading-tight">
                        Because they deserve <br class="hidden sm:block" />
                        <span class="text-gradient">the absolute best.</span>
                    </h1>
                    <p class="mt-4 text-xl text-gray-600 mb-10 max-w-2xl mx-auto lg:mx-0 leading-relaxed">
                        Discover curated collections of premium accessories, organic food, and chic grooming essentials that make your furry friends feel like royalty.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="{{ route('products') }}" class="inline-flex items-center justify-center px-8 py-4 text-base font-bold rounded-full text-white bg-gray-900 hover:bg-gray-800 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                            Shop Collection
                        </a>
                        @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-4 text-base font-bold rounded-full text-gray-900 bg-white border-2 border-gray-200 hover:border-gray-900 hover:bg-gray-50 transition-all duration-300">
                            Join the Club
                        </a>
                        @endif
                    </div>
                </div>
                <div class="lg:col-span-6 relative">
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl transform hover:scale-[1.02] transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent z-10"></div>
                        <img class="w-full h-[500px] object-cover" src="https://images.unsplash.com/photo-1583337130417-3346a1be7dee?auto=format&fit=crop&q=80&w=1200" alt="Happy Fluffy Dog">
                        <div class="absolute bottom-6 left-6 z-20">
                            <div class="bg-white/90 backdrop-blur px-4 py-2 rounded-2xl shadow-lg border border-white/20 inline-block">
                                <p class="text-sm font-bold text-gray-800">✨ Best Sellers 2026</p>
                            </div>
                        </div>
                    </div>
                    <!-- Decorative element behind image -->
                    <div class="absolute -top-6 -right-6 w-full h-full border-2 border-orange-200 rounded-3xl -z-10"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- New Arrivals Section -->
    <div class="py-24 bg-gray-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-end justify-between mb-12">
                <div>
                    <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">New Arrivals</h2>
                    <p class="text-gray-500 mt-2">The latest boutique finds for your furry companions.</p>
                </div>
                <a href="{{ route('products') }}" class="text-sm font-bold text-orange-500 hover:text-orange-600 flex items-center gap-2 group transition-colors">
                    Explore All
                    <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @forelse($featuredProducts as $product)
                <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 group">
                    <a href="{{ route('product.detail', $product->id) }}" class="block relative aspect-square overflow-hidden bg-gray-100">
                        <img src="{{ $product->images[0] ?? 'https://images.unsplash.com/photo-1516734212186-a967f81ad0d7?auto=format&fit=crop&q=80&w=400' }}" alt="{{ $product->name }}" loading="lazy" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                    </a>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-1">
                            <a href="{{ route('product.detail', $product->id) }}" class="text-base font-bold text-gray-900 hover:text-orange-500 transition-colors">{{ $product->name }}</a>
                            <span class="text-orange-500 font-extrabold">${{ number_format($product->price) }}</span>
                        </div>
                        <p class="text-xs text-gray-400 font-medium mb-4">{{ $product->subtitle }}</p>
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <input type="hidden" name="name" value="{{ $product->name }}">
                            <input type="hidden" name="price" value="{{ $product->price }}">
                            <input type="hidden" name="image" value="{{ $product->images[0] ?? '' }}">
                            <input type="hidden" name="subtitle" value="{{ $product->subtitle }}">
                            <button type="submit" class="w-full py-3 bg-gray-900 text-white rounded-xl text-xs font-bold uppercase tracking-widest hover:bg-orange-500 transition-colors duration-300">
                                Add to Bag
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="col-span-full py-20 px-6 text-center bg-white rounded-[3rem] border border-gray-100/50 shadow-sm">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-50 rounded-2xl mb-6 shadow-inner">
                        <svg class="w-8 h-8 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <p class="text-xl font-bold text-gray-900 mb-2">New arrivals are on their way!</p>
                    <p class="text-gray-500 font-medium italic">Our latest boutique finds are being curated as we speak. Check back shortly!</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Featured Categories -->
    <div id="collections" class="py-24 bg-white relative z-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-4">Curated with love</h2>
                <p class="text-lg text-gray-500">Everything your pet needs, thoughtfully selected for quality and style.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <!-- Category 1 -->
                <div class="group cursor-pointer">
                    <div class="relative rounded-3xl overflow-hidden mb-6 aspect-[4/5]">
                        <img src="https://images.unsplash.com/photo-1576201836106-db1758fd1c97?auto=format&fit=crop&q=80&w=400" alt="Accessories" loading="lazy" class="object-cover w-full h-full transform group-hover:scale-110 transition-transform duration-700 ease-in-out">
                        <div class="absolute inset-0 bg-black/20 group-hover:bg-black/40 transition-colors duration-300"></div>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Chic Accessories</h3>
                    <p class="text-gray-600">Collars, leashes, and apparel that turn heads at the dog park.</p>
                </div>

                <!-- Category 2 -->
                <div class="group cursor-pointer md:mt-12">
                    <div class="relative rounded-3xl overflow-hidden mb-6 aspect-[4/5]">
                        <img src="https://images.unsplash.com/photo-1516734212186-a967f81ad0d7?auto=format&fit=crop&q=80&w=400" alt="Grooming" loading="lazy" class="object-cover w-full h-full transform group-hover:scale-110 transition-transform duration-700 ease-in-out">
                        <div class="absolute inset-0 bg-black/20 group-hover:bg-black/40 transition-colors duration-300"></div>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Spa & Grooming</h3>
                    <p class="text-gray-600">Premium shampoos and brushes for a shiny, healthy coat.</p>
                </div>

                <!-- Category 3 -->
                <div class="group cursor-pointer">
                    <div class="relative rounded-3xl overflow-hidden mb-6 aspect-[4/5]">
                        <img src="https://images.unsplash.com/photo-1589924691995-400dc9ecc119?auto=format&fit=crop&q=80&w=400" alt="Food" loading="lazy" class="object-cover w-full h-full transform group-hover:scale-110 transition-transform duration-700 ease-in-out">
                        <div class="absolute inset-0 bg-black/20 group-hover:bg-black/40 transition-colors duration-300"></div>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Organic Treats</h3>
                    <p class="text-gray-600">Wholesome, delicious snacks made from 100% natural ingredients.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="py-24 bg-gray-900 text-white selection:bg-white selection:text-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl sm:text-5xl font-extrabold mb-8">Ready to spoil your best friend?</h2>
            <p class="text-xl text-gray-400 mb-10 max-w-2xl mx-auto">Create an account today and get 15% off your first order at Pawtique. Plus, track orders and save your favorite items!</p>
            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-10 py-5 text-lg font-bold rounded-full text-gray-900 bg-orange-400 hover:bg-orange-300 shadow-[0_0_40px_rgba(251,146,60,0.4)] transition-all duration-300 transform hover:scale-105">
                Create Free Account
            </a>
            @endif
        </div>
    </div>

@endsection
