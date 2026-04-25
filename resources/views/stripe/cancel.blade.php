@extends('layouts.public')

@section('content')
<div class="pt-32 pb-24 bg-gray-50 min-h-screen flex items-center">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="bg-white rounded-[4rem] p-12 md:p-20 shadow-xl border border-gray-100 relative overflow-hidden">
            <!-- Decorative blobs -->
            <div class="absolute -top-24 -right-24 w-64 h-64 bg-rose-50 rounded-full blur-3xl opacity-60"></div>
            
            <div class="relative z-10">
                <div class="inline-flex items-center justify-center w-24 h-24 bg-rose-100 rounded-full mb-10 shadow-inner">
                    <svg class="w-12 h-12 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </div>
                
                <h1 class="text-4xl md:text-5xl font-black text-gray-900 mb-6 tracking-tight">Payment Cancelled</h1>
                <p class="text-xl text-gray-500 mb-12 leading-relaxed font-medium">No worries! Your cart is still safe. You can go back and complete your purchase whenever you're ready.</p>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('cart') }}" class="inline-flex items-center justify-center px-10 py-5 bg-orange-500 text-white rounded-3xl font-black text-[10px] uppercase tracking-[0.2em] hover:bg-orange-600 transition-all shadow-xl shadow-orange-100 hover:-translate-y-1 active:scale-95">
                        Back to Cart
                    </a>
                    <a href="{{ route('products') }}" class="inline-flex items-center justify-center px-10 py-5 bg-white border-2 border-gray-100 text-gray-900 rounded-3xl font-black text-[10px] uppercase tracking-[0.2em] hover:border-gray-900 transition-all hover:-translate-y-1 active:scale-95">
                        Keep Browsing
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
