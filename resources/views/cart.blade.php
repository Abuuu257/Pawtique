@extends('layouts.public')

@section('content')
<div class="pt-32 pb-24 bg-gray-50 min-h-screen">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-extrabold text-gray-900 mb-8">Shopping Cart</h1>
        
        @php
            $cart = session('cart', []);
            $subtotal = 0;
            foreach($cart as $item) {
                $subtotal += $item['price'] * $item['quantity'];
            }
            $taxes = $subtotal * 0.08;
            $total = $subtotal + $taxes;
        @endphp

        @if(count($cart) > 0)
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            <div class="lg:col-span-8 space-y-6">
                @foreach($cart as $id => $item)
                <!-- Cart Item -->
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex flex-col sm:flex-row items-center gap-6">
                    <div class="w-24 h-24 bg-gray-100 rounded-2xl overflow-hidden flex-shrink-0">
                        <img src="{{ $item['image'] ?? 'https://images.unsplash.com/photo-1576201836106-db1758fd1c97?auto=format&fit=crop&q=80&w=200' }}" alt="Product" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-grow text-center sm:text-left">
                        <h3 class="text-lg font-bold text-gray-900">{{ $item['name'] }}</h3>
                        <p class="text-sm text-gray-500 mb-2">{{ $item['subtitle'] }}</p>
                        <div class="flex items-center justify-center sm:justify-start gap-4">
                            <span class="text-orange-500 font-extrabold">${{ number_format($item['price'], 2) }}</span>
                            <div class="flex items-center gap-2 bg-gray-50 rounded-lg px-3 py-1 border border-gray-200">
                                <form action="{{ route('cart.update') }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $id }}">
                                    <input type="hidden" name="quantity" value="{{ $item['quantity'] - 1 }}">
                                    <button class="text-gray-500 hover:text-gray-900">&minus;</button>
                                </form>
                                <span class="font-semibold text-sm w-4 text-center">{{ $item['quantity'] }}</span>
                                <form action="{{ route('cart.update') }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $id }}">
                                    <input type="hidden" name="quantity" value="{{ $item['quantity'] + 1 }}">
                                    <button class="text-gray-500 hover:text-gray-900">&plus;</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('cart.remove', $id) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-gray-400 hover:text-rose-500 p-2 transform hover:scale-110 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </form>
                </div>
                @endforeach
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-4">
                <div class="bg-white rounded-3xl p-6 md:p-8 shadow-xl border border-gray-100 sticky top-32">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Order Summary</h3>
                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal</span>
                            <span class="font-medium">${{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Shipping</span>
                            <span class="font-medium text-green-500">Free</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Estimated Taxes</span>
                            <span class="font-medium">${{ number_format($taxes, 2) }}</span>
                        </div>
                        <div class="border-t border-gray-100 pt-4 flex justify-between">
                            <span class="text-lg font-bold text-gray-900">Total</span>
                            <span class="text-2xl font-extrabold text-orange-500">${{ number_format($total, 2) }}</span>
                        </div>
                    </div>
                    <form action="{{ route('checkout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full py-4 bg-gray-900 text-white rounded-xl font-bold hover:bg-orange-500 transition-colors duration-300">
                            Checkout Now
                        </button>
                    </form>
                    <p class="text-center text-xs text-gray-400 mt-4 flex items-center justify-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        Secure Encrypted Checkout
                    </p>
                </div>
            </div>
        </div>
        @else
        <!-- Empty Cart -->
        <div class="text-center py-20 bg-white rounded-3xl shadow-sm border border-gray-100">
            <svg class="w-24 h-24 mx-auto text-gray-200 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Your cart is empty</h2>
            <p class="text-gray-500 mb-8">Looks like you haven't added anything to your cart yet.</p>
            <a href="{{ route('products') }}" class="inline-flex items-center justify-center px-8 py-3 text-base font-bold rounded-xl text-white bg-orange-500 hover:bg-orange-600 transition-colors">
                Continue Shopping
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
