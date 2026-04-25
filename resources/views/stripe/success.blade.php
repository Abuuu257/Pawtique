@extends('layouts.public')

@section('content')
<div class="py-24 bg-gray-50 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-xl px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-[4rem] pt-20 pb-24 px-8 md:px-16 shadow-[0_40px_100px_-15px_rgba(0,0,0,0.08)] border border-gray-100/50 relative overflow-hidden text-center">
            <!-- Boutique branding blur -->
            <div class="absolute -top-32 -left-32 w-80 h-80 bg-orange-100 rounded-full blur-[100px] opacity-40"></div>
            <div class="absolute -bottom-32 -right-32 w-80 h-80 bg-green-100 rounded-full blur-[100px] opacity-30"></div>
            
            <div class="relative z-10">
                <!-- Success Seal -->
                <div class="mb-12 relative flex justify-center">
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-24 h-24 bg-green-100 rounded-full animate-ping opacity-20 scale-150"></div>
                    <div class="w-24 h-24 aspect-square bg-white rounded-full flex items-center justify-center shadow-lg border border-gray-50 relative z-20 flex-shrink-0">
                        <div class="w-20 h-20 aspect-square bg-green-500 rounded-full flex items-center justify-center text-white flex-shrink-0">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <span class="block text-[10px] font-black uppercase tracking-[0.3em] text-orange-500 mb-4">Transaction Approved</span>
                <h1 class="text-4xl md:text-5xl font-black text-gray-900 mb-6 tracking-tight">Order Confirmed!</h1>
                
                <div class="w-16 h-1 bg-gray-100 mx-auto mb-8 rounded-full"></div>
                
                <p class="text-lg text-gray-500 mb-12 leading-relaxed font-medium">
                    We've received your order and our boutique team is already hand-picking your items. You'll receive a tracking link as soon as it ships!
                </p>

                <!-- Order Details Mockup -->
                <div class="bg-gray-50/50 rounded-3xl p-6 mb-12 border border-gray-100/50">
                    <div class="flex justify-between text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">
                        <span>Date</span>
                        <span>Status</span>
                    </div>
                    <div class="flex justify-between text-sm font-black text-gray-900">
                        <span>{{ date('M d, Y') }}</span>
                        <span class="text-green-600 flex items-center gap-1">
                            <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                            Processing
                        </span>
                    </div>
                </div>
                
                <div class="flex flex-col gap-4">
                    <a href="{{ route('home') }}" class="inline-flex items-center justify-center px-10 py-5 bg-gray-900 text-white rounded-[2rem] font-black text-[11px] uppercase tracking-[0.2em] hover:bg-orange-500 transition-all shadow-xl hover:-translate-y-1 active:scale-95">
                        Back to Home
                    </a>
                    <a href="{{ route('products') }}" class="inline-flex items-center justify-center px-10 py-5 bg-white border-2 border-gray-100 text-gray-900 rounded-[2rem] font-black text-[11px] uppercase tracking-[0.2em] hover:border-gray-900 transition-all hover:-translate-y-1 active:scale-95">
                        Shop More
                    </a>
                </div>
            </div>
        </div>
        
        <p class="mt-12 text-center text-gray-400 text-xs font-medium tracking-wide">
            Need help? Contact our boutique support at <span class="text-gray-900">support@pawtique.com</span>
        </p>
    </div>
</div>
@endsection
