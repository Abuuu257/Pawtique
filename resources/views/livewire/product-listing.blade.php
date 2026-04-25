<div>
    <!-- Filter Bar -->
    <div class="mb-12 bg-white p-4 md:p-6 rounded-[2.5rem] shadow-sm border border-gray-100">
        <div class="flex flex-col md:flex-row gap-4 md:gap-6 items-stretch md:items-center">
            <!-- Search & Category Group -->
            <div class="flex flex-col sm:flex-row gap-4 flex-grow">
                <!-- Search -->
                <div class="relative flex-grow group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-300 group-focus-within:text-orange-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" wire:model.live.debounce.300ms="search" 
                           placeholder="Search boutique..." 
                           class="w-full bg-gray-50 border-transparent rounded-2xl py-4 pl-12 pr-4 focus:bg-white focus:ring-2 focus:ring-orange-100 placeholder-gray-400 font-medium text-sm transition-all outline-none">
                </div>
                <!-- Category -->
                <div class="relative min-w-[200px] group">
                    <select wire:model.live="category" 
                            style="appearance: none !important; -webkit-appearance: none !important; -moz-appearance: none !important; background-image: none !important;"
                            class="w-full bg-gray-50 border-transparent rounded-2xl py-4 pl-6 pr-12 focus:bg-white focus:ring-0 !ring-0 font-bold text-xs uppercase tracking-widest text-gray-600 outline-none cursor-pointer transition-all">
                        <option value="all">All Categories</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat }}">{{ $cat }}</option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                        <svg class="w-4 h-4 text-gray-400 group-hover:text-orange-500 transition-colors" 
                             style="pointer-events: none;"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Favorites & Reset Group -->
            <div class="flex items-center gap-4 md:gap-6">
                <!-- Favorites Toggle -->
                <label class="flex items-center gap-3 cursor-pointer group bg-gray-50 hover:bg-orange-50 px-6 py-4 rounded-2xl transition-all flex-grow md:flex-grow-0 justify-center">
                    <input type="checkbox" wire:model.live="favorites" 
                           class="w-5 h-5 rounded-lg border-gray-200 text-orange-500 focus:ring-orange-100 transition-all cursor-pointer">
                    <span class="text-xs font-black uppercase tracking-widest text-gray-500 group-hover:text-orange-500 transition-colors">Favorites</span>
                </label>

                <!-- Clear Button -->
                @if($search || $category !== 'all' || $favorites)
                <button wire:click="clearFilters" class="flex items-center justify-center w-12 h-12 rounded-2xl bg-rose-50 text-rose-500 hover:bg-rose-500 hover:text-white transition-all shadow-sm" title="Reset Filters">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
                @endif
            </div>
        </div>
    </div>

    <!-- Products Grid -->
    <div wire:loading.class="opacity-50 transition-opacity duration-300">
        @if($products->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($products as $product)
            <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 group">
                <div class="relative aspect-square overflow-hidden bg-gray-100">
                    <a href="{{ route('product.detail', $product->id) }}" class="block w-full h-full">
                        <img src="{{ $product->images[0] ?? 'https://images.unsplash.com/photo-1516734212186-a967f81ad0d7?auto=format&fit=crop&q=80&w=400' }}" alt="{{ $product->name }}" loading="lazy" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                    </a>
                    <div class="absolute top-4 right-4 z-20">
                        @php $isFavorite = in_array($product->id, $favoriteIds); @endphp
                        <button wire:click="toggleFavorite({{ $product->id }})" class="w-10 h-10 flex items-center justify-center bg-white/90 backdrop-blur-md rounded-full shadow-lg hover:bg-white hover:scale-110 active:scale-95 transition-all duration-300 group/fav">
                            <svg class="w-5 h-5 {{ $isFavorite ? 'text-orange-500 fill-orange-500' : 'text-gray-400 group-hover/fav:text-rose-500' }} transition-colors" 
                                 fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-2">
                        <a href="{{ route('product.detail', $product->id) }}" class="text-lg font-bold text-gray-900 leading-tight hover:text-orange-500 transition-colors">{{ $product->name }}</a>
                        <span class="text-orange-500 font-extrabold">${{ number_format($product->price) }}</span>
                    </div>
                    <p class="text-sm text-gray-500 mb-4">{{ $product->subtitle }}</p>
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <input type="hidden" name="name" value="{{ $product->name }}">
                        <input type="hidden" name="price" value="{{ $product->price }}">
                        <input type="hidden" name="image" value="{{ $product->images[0] ?? '' }}">
                        <input type="hidden" name="subtitle" value="{{ $product->subtitle }}">
                        <button type="submit" class="w-full py-3 bg-gray-900 text-white rounded-xl font-semibold hover:bg-orange-500 transition-colors duration-300">
                            Add to Cart
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="mt-24 pb-32 flex justify-center">
            <div class="w-full max-w-4xl pt-32 pb-48 px-10 text-center bg-white rounded-[4rem] border border-gray-100 shadow-sm relative overflow-hidden">
                <!-- Decorative background elements -->
                <div class="absolute -top-24 -right-24 w-64 h-64 bg-orange-50 rounded-full blur-3xl opacity-60"></div>
                <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-blue-50 rounded-full blur-3xl opacity-60"></div>
                
                <div class="relative z-10 max-w-lg mx-auto">
                    <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-br from-gray-50 to-gray-100 rounded-[2.5rem] mb-10 shadow-inner">
                        <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 4v.01"></path>
                        </svg>
                    </div>
                    
                    @if($search || $category !== 'all' || $favorites)
                        <h3 class="text-3xl font-black text-gray-900 mb-4 tracking-tight">No matches found</h3>
                        <p class="text-lg text-gray-500 mb-12 leading-relaxed font-medium">We couldn't find any products matching your current filters. Try broadening your search or resetting the filters.</p>
                        <button wire:click="clearFilters" class="inline-flex items-center px-10 py-5 bg-orange-500 text-white rounded-3xl font-black text-[10px] uppercase tracking-[0.2em] hover:bg-orange-600 transition-all shadow-xl shadow-orange-100 hover:-translate-y-1 active:scale-95">
                            Reset All Filters
                        </button>
                    @else
                        <h3 class="text-3xl font-black text-gray-900 mb-4 tracking-tight">The Boutique is Resting</h3>
                        <p class="text-lg text-gray-500 mb-12 leading-relaxed font-medium">Our curated collection is currently being refreshed with new seasonal arrivals. Check back soon for our latest drops!</p>
                        <a href="{{ route('home') }}" wire:navigate class="inline-flex items-center px-10 py-5 bg-gray-900 text-white rounded-3xl font-black text-[10px] uppercase tracking-[0.2em] hover:bg-orange-500 transition-all shadow-xl hover:-translate-y-1 active:scale-95">
                            Return to Home
                        </a>
                    @endif
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
