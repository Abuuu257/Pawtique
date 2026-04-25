@extends('layouts.public')

@section('content')
<div class="pt-32 pb-24 bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-10">
            <a href="{{ route('admin.products') }}" class="text-xs font-bold text-orange-500 uppercase tracking-widest flex items-center gap-2 mb-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back to Inventory
            </a>
            <h1 class="text-3xl font-black text-gray-900 tracking-tight">Edit Boutique Item</h1>
            <p class="text-gray-400 font-bold uppercase text-[10px] tracking-widest mt-1">Ref ID: #{{ $product->id }}</p>
        </div>

        @if($errors->any())
        <div class="mb-8 p-6 bg-rose-50 border border-rose-100 rounded-[1.5rem]">
            <div class="flex items-center gap-3 mb-3 text-rose-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="font-black uppercase tracking-widest text-xs">Paws for a moment!</span>
            </div>
            <ul class="space-y-1">
                @foreach($errors->all() as $error)
                    <li class="text-rose-500 text-sm font-medium">• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 p-10">
            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" class="space-y-8">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 px-1">Product Name</label>
                        <input type="text" name="name" required value="{{ $product->name }}" class="w-full bg-gray-50 border-transparent rounded-2xl p-4 focus:bg-white focus:ring-2 focus:ring-orange-100 placeholder-gray-300 font-bold">
                    </div>
                    <!-- Category -->
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 px-1">Category</label>
                        <div class="relative">
                            <select name="subtitle" required 
                                    style="appearance: none !important; -webkit-appearance: none !important; -moz-appearance: none !important; background-image: none !important;"
                                    class="w-full bg-gray-50 border-transparent rounded-2xl p-4 focus:bg-white focus:ring-0 font-bold @error('subtitle') ring-2 ring-rose-200 @enderror">
                                @foreach(['Food', 'Accessories', 'Grooming', 'Toys', 'Organic'] as $cat)
                                    <option value="{{ $cat }}" {{ (old('subtitle') ?? $product->subtitle) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 px-1">Retail Price ($)</label>
                        <input type="number" step="0.01" name="price" required value="{{ $product->price }}" class="w-full bg-gray-50 border-transparent rounded-2xl p-4 focus:bg-white focus:ring-2 focus:ring-orange-100 placeholder-gray-300 font-bold">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 px-1">Rating (0-5)</label>
                        <input type="number" step="0.1" min="0" max="5" name="rating" required value="{{ $product->rating }}" class="w-full bg-gray-50 border-transparent rounded-2xl p-4 focus:bg-white focus:ring-2 focus:ring-orange-100 placeholder-gray-300 font-bold">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 px-1">Review Count</label>
                        <input type="number" name="reviews" required value="{{ $product->reviews }}" class="w-full bg-gray-50 border-transparent rounded-2xl p-4 focus:bg-white focus:ring-2 focus:ring-orange-100 placeholder-gray-300 font-bold">
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 px-1">Product Description</label>
                    <textarea name="description" rows="5" required class="w-full bg-gray-50 border-transparent rounded-2xl p-4 focus:bg-white focus:ring-2 focus:ring-orange-100 placeholder-gray-300 font-medium leading-relaxed">{{ $product->description }}</textarea>
                </div>

                <div class="space-y-4">
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest px-1">Unsplash / Image URLs</label>
                    <input type="url" name="image1" required value="{{ $product->images[0] ?? '' }}" class="w-full bg-gray-50 border-transparent rounded-2xl p-4 focus:bg-white focus:ring-2 focus:ring-orange-100 placeholder-gray-300 font-bold text-xs">
                    <input type="url" name="image2" value="{{ $product->images[1] ?? '' }}" class="w-full bg-gray-50 border-transparent rounded-2xl p-4 focus:bg-white focus:ring-2 focus:ring-orange-100 placeholder-gray-300 font-bold text-xs" placeholder="Secondary Image URL (Optional)">
                    <input type="url" name="image3" value="{{ $product->images[2] ?? '' }}" class="w-full bg-gray-50 border-transparent rounded-2xl p-4 focus:bg-white focus:ring-2 focus:ring-orange-100 placeholder-gray-300 font-bold text-xs" placeholder="Tertiary Image URL (Optional)">
                </div>

                <div class="pt-6">
                    <button type="submit" class="w-full bg-gray-900 text-white py-5 rounded-2xl font-black uppercase tracking-[0.2em] hover:bg-orange-500 transition-all shadow-2xl shadow-gray-200">
                        Update Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
