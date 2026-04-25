@extends('layouts.public')

@section('content')
<div class="bg-white">
    <!-- Breadcrumbs (Minimal) -->
    <div class="pt-28 pb-4">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex text-[10px] font-bold uppercase tracking-[0.2em] text-gray-400">
                <ol class="inline-flex items-center space-x-3">
                    <li><a href="{{ route('home') }}" class="hover:text-black transition-colors">Home</a></li>
                    <li><span class="text-gray-300">/</span></li>
                    <li><a href="{{ route('products') }}" class="hover:text-black transition-colors">Shop</a></li>
                    <li><span class="text-gray-300">/</span></li>
                    <li class="text-black">{{ $product['name'] }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Main Product Area -->
    <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 pb-24">
        <div class="lg:grid lg:grid-cols-12 lg:gap-16 xl:gap-24">
            
            <!-- Left: Image Gallery (Vertical Grid) -->
            <div class="lg:col-span-7">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($product['images'] as $index => $image)
                    <div class="aspect-[4/5] bg-gray-50 overflow-hidden {{ count($product['images']) === 1 || $index === 0 ? 'md:col-span-2' : '' }} group">
                        <img src="{{ $image }}" alt="{{ $product['name'] }}" class="w-full h-full object-cover transform transition-transform duration-1000 group-hover:scale-105">
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Right: Product Info (Sticky) -->
            <div class="lg:col-span-5 mt-10 lg:mt-0 relative">
                <div class="sticky top-32">
                    
                    <!-- Badges -->
                    <div class="flex flex-wrap gap-2 mb-6">
                        <span class="bg-orange-100 text-orange-800 text-[9px] font-black px-3 py-1 rounded-sm uppercase tracking-widest">New Arrival</span>
                        @if($product['rating'] >= 4.5)
                        <span class="bg-gray-100 text-gray-800 text-[9px] font-black px-3 py-1 rounded-sm uppercase tracking-widest">Top Rated</span>
                        @endif
                    </div>

                    <!-- Title & Subtitle -->
                    <div class="flex items-start justify-between gap-4 mb-2">
                        <h1 class="text-4xl lg:text-5xl font-black text-gray-900 tracking-tight leading-[1.1]">{{ $product['name'] }}</h1>
                        <form action="{{ route('product.favorite', $product->id) }}" method="POST" class="flex-shrink-0">
                            @csrf
                            <button type="submit" class="w-12 h-12 flex items-center justify-center bg-gray-50 backdrop-blur-md rounded-full shadow-sm hover:bg-white hover:scale-110 active:scale-95 transition-all duration-300 group/fav">
                                <svg class="w-6 h-6 {{ $isFavorite ? 'text-orange-500 fill-orange-500' : 'text-gray-400 group-hover/fav:text-rose-500' }} transition-colors" 
                                     fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                    <p class="text-base text-gray-500 font-medium mb-8">{{ $product['subtitle'] ?? 'Premium Collection' }}</p>
                    
                    <!-- Price -->
                    <div class="flex items-baseline gap-4 mb-10">
                        <span class="text-3xl lg:text-4xl font-medium text-gray-900">${{ number_format($product['price'], 2) }}</span>
                    </div>

                    <!-- Add to Cart Form -->
                    <form action="{{ route('cart.add') }}" method="POST" class="mb-12">
                        @csrf
                        <input type="hidden" name="id"       value="{{ $product['id'] }}">
                        <input type="hidden" name="name"     value="{{ $product['name'] }}">
                        <input type="hidden" name="price"    value="{{ $product['price'] }}">
                        <input type="hidden" name="subtitle" value="{{ $product['subtitle'] }}">
                        <input type="hidden" name="image"    value="{{ $product['images'][0] ?? '' }}">
                        
                        <button type="submit" class="w-full bg-black text-white font-bold text-xs uppercase tracking-[0.2em] py-5 px-8 hover:bg-orange-500 transition-colors duration-300 flex items-center justify-center gap-3 group">
                            <span>Add to Bag</span>
                            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="square" stroke-linejoin="miter" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </button>
                    </form>

                    <!-- Accordions -->
                    <div class="border-t border-gray-200 divide-y divide-gray-200">
                        
                        <!-- Description Accordion -->
                        <div x-data="{ open: true }" class="py-6">
                            <button @click="open = !open" class="flex justify-between items-center w-full focus:outline-none group">
                                <span class="text-sm font-bold uppercase tracking-widest text-gray-900 group-hover:text-orange-500 transition-colors">Description</span>
                                <svg class="w-4 h-4 text-gray-900 transform transition-transform" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="square" stroke-linejoin="miter" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="open" x-transition class="mt-6 text-sm text-gray-600 leading-loose font-medium">
                                {{ $product['description'] }}
                                <ul class="mt-6 list-disc list-inside space-y-3 text-gray-500">
                                    <li>Premium vet-approved materials</li>
                                    <li>Durable, pet safe, and eco-friendly packaging</li>
                                    <li>100% satisfaction guaranteed for your furry friend</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Details Accordion -->
                        <div x-data="{ open: false }" class="py-6">
                            <button @click="open = !open" class="flex justify-between items-center w-full focus:outline-none group">
                                <span class="text-sm font-bold uppercase tracking-widest text-gray-900 group-hover:text-orange-500 transition-colors">Delivery & Returns</span>
                                <svg class="w-4 h-4 text-gray-900 transform transition-transform" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="square" stroke-linejoin="miter" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="open" x-transition x-cloak class="mt-6 text-sm text-gray-600 leading-loose font-medium">
                                <p class="mb-4"><strong class="text-gray-900 font-bold uppercase text-[10px] tracking-widest">Free Standard Delivery</strong><br> On all orders. Dispatched within 24 hours.</p>
                                <p><strong class="text-gray-900 font-bold uppercase text-[10px] tracking-widest">Returns</strong><br> 30-day return window. Item must be enclosed in its original packaging and in perfect condition.</p>
                            </div>
                        </div>

                         <!-- Reviews Accordion -->
                         <div x-data="{ open: false }" class="py-6">
                            <button @click="open = !open" class="flex justify-between items-center w-full focus:outline-none group">
                                <div class="flex items-center gap-4">
                                    <span class="text-sm font-bold uppercase tracking-widest text-gray-900 group-hover:text-orange-500 transition-colors">Reviews ({{ $product['reviews'] }})</span>
                                    <div class="flex text-black">
                                        @for($i=1; $i<=5; $i++)
                                        <svg class="w-3 h-3 {{ $i<=floor($product['rating']) ? 'text-black' : 'text-gray-200' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        @endfor
                                    </div>
                                </div>
                                <svg class="w-4 h-4 text-gray-900 transform transition-transform" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="square" stroke-linejoin="miter" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="open" x-transition x-cloak class="mt-6">
                                <div class="flex items-center justify-between mb-4">
                                    <span class="text-5xl font-black text-gray-900">{{ number_format($product['rating'], 1) }}</span>
                                    <span class="text-[10px] text-gray-500 uppercase tracking-widest font-bold">Overall Rating</span>
                                </div>
                                <p class="text-sm text-gray-500 italic bg-gray-50 p-4 rounded-lg">"Highly recommend this for any pet owner looking for quality. Fits perfectly and looks great!"</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related / Quality Banner -->
    <div class="bg-gray-50 py-24 border-t border-gray-200">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h3 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] mb-16">The Pawtique Promise</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 max-w-4xl mx-auto">
                <div class="group">
                    <svg class="w-8 h-8 mx-auto mb-6 text-black group-hover:text-orange-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="square" stroke-linejoin="miter" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    <h4 class="font-bold text-gray-900 mb-2 uppercase tracking-wide text-xs">Vet Approved</h4>
                    <p class="text-sm text-gray-500">Every item is rigorously tested for complete safety.</p>
                </div>
                <div class="group">
                    <svg class="w-8 h-8 mx-auto mb-6 text-black group-hover:text-orange-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="square" stroke-linejoin="miter" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    <h4 class="font-bold text-gray-900 mb-2 uppercase tracking-wide text-xs">Loved by Pets</h4>
                    <p class="text-sm text-gray-500">Comfort and absolute happiness guaranteed.</p>
                </div>
                <div class="group">
                    <svg class="w-8 h-8 mx-auto mb-6 text-black group-hover:text-orange-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="square" stroke-linejoin="miter" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <h4 class="font-bold text-gray-900 mb-2 uppercase tracking-wide text-xs">Fast Delivery</h4>
                    <p class="text-sm text-gray-500">Quick dispatch and express delivery available.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
