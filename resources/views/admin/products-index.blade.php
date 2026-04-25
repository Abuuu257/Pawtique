@extends('layouts.public')

@section('content')
<div class="pt-32 pb-24 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6 mb-10">
            <div>
                <a href="{{ route('admin.dashboard') }}" class="text-[10px] font-black text-orange-500 uppercase tracking-[0.2em] flex items-center gap-2 mb-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Back to Dashboard
                </a>
                <h1 class="text-3xl font-black text-gray-900 tracking-tight">Active Inventory</h1>
            </div>
            <a href="{{ route('admin.products.create') }}" class="bg-gray-900 text-white px-8 py-4 rounded-2xl font-black text-[10px] uppercase tracking-[0.2em] hover:bg-orange-500 transition-all shadow-xl shadow-gray-200 text-center">
                Add New Product
            </a>
        </div>

        @if(session('success'))
        <div class="mb-8 p-4 bg-green-50 border border-green-100 text-green-600 rounded-2xl font-bold text-sm">
            {{ session('success') }}
        </div>
        @endif

        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
            <!-- Desktop Table View -->
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-gray-50/50 border-b border-gray-100">
                            <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Product</th>
                            <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Category</th>
                            <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Price</th>
                            <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Rating</th>
                            <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($products as $product)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <img src="{{ $product->images[0] ?? '' }}" class="w-12 h-12 rounded-xl object-cover bg-gray-100 shadow-sm">
                                    <span class="font-bold text-gray-900">{{ $product->name }}</span>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <span class="text-[10px] font-black uppercase tracking-widest text-gray-500 bg-gray-100 px-3 py-1.5 rounded-lg">{{ $product->subtitle }}</span>
                            </td>
                            <td class="px-8 py-6">
                                <span class="font-black text-gray-900">${{ number_format($product->price, 2) }}</span>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-1">
                                    <svg class="w-4 h-4 text-orange-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    <span class="text-sm font-bold text-gray-900">{{ $product->rating }}</span>
                                </div>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="p-2 text-gray-400 hover:text-orange-500 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </a>
                                    <form action="{{ route('admin.products.delete', $product->id) }}" method="POST" onsubmit="return confirm('Delete this product permanently?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-gray-400 hover:text-rose-500 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Mobile Card View -->
            <div class="md:hidden divide-y divide-gray-100">
                @foreach($products as $product)
                <div class="p-6">
                    <div class="flex items-center gap-4 mb-4">
                        <img src="{{ $product->images[0] ?? '' }}" class="w-16 h-16 rounded-2xl object-cover bg-gray-50 shadow-sm">
                        <div>
                            <h3 class="font-black text-gray-900 leading-tight">{{ $product->name }}</h3>
                            <span class="text-[10px] font-black uppercase tracking-widest text-gray-400">{{ $product->subtitle }}</span>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between bg-gray-50 rounded-2xl p-4 mb-4">
                        <div>
                            <p class="text-[9px] font-black uppercase tracking-widest text-gray-400 mb-1">Price</p>
                            <p class="font-black text-gray-900">${{ number_format($product->price, 2) }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-[9px] font-black uppercase tracking-widest text-gray-400 mb-1">Rating</p>
                            <div class="flex items-center justify-end gap-1">
                                <svg class="w-3 h-3 text-orange-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                <span class="font-bold text-gray-900">{{ $product->rating }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-3">
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="flex-1 bg-gray-900 text-white text-center py-3 rounded-xl font-black text-[10px] uppercase tracking-[0.2em] hover:bg-orange-500 transition-colors">Edit</a>
                        <form action="{{ route('admin.products.delete', $product->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Delete this product permanently?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full bg-rose-50 text-rose-500 py-3 rounded-xl font-black text-[10px] uppercase tracking-[0.2em] hover:bg-rose-500 hover:text-white transition-colors">Delete</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
