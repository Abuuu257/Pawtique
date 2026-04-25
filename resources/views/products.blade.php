@extends('layouts.public')

@section('content')
<div class="pt-32 pb-24 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-20">
            <span class="inline-block py-1 px-3 rounded-full bg-orange-100 text-orange-600 text-[10px] font-black uppercase tracking-widest mb-4">
                The Boutique
            </span>
            <h1 class="text-4xl md:text-6xl font-black text-gray-900 mb-6 tracking-tight">Curated Collection</h1>
            <p class="text-lg text-gray-500 max-w-2xl mx-auto font-medium">Explore our hand-picked selection of premium pet accessories, organic food, and designer grooming essentials.</p>
        </div>

        <livewire:product-listing />
    </div>
</div>
@endsection
