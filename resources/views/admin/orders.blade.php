@extends('layouts.public')

@section('content')
<div class="pt-32 pb-24 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <a href="{{ route('admin.dashboard') }}" class="text-xs font-bold text-orange-500 uppercase tracking-widest mb-2 inline-block hover:translate-x-1 transition-transform">← Back to Dashboard</a>
                <h1 class="text-3xl font-black text-gray-900 tracking-tight">Order Management</h1>
                <p class="text-gray-500 font-medium">Tracking every treat and toy delivered.</p>
            </div>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50 border-b border-gray-100">
                            <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Order Details</th>
                            <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Customer</th>
                            <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Items Ordered</th>
                            <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Total</th>
                            <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Status</th>
                            <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($orders as $order)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-8 py-8">
                                <span class="block font-black text-gray-900 shrink-0">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">{{ $order->created_at->format('M d, Y') }}</span>
                            </td>
                            <td class="px-8 py-8">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-orange-100 text-orange-600 flex items-center justify-center font-black text-sm">
                                        {{ strtoupper(substr($order->user_name ?? 'G', 0, 1)) }}
                                    </div>
                                    <div>
                                        <span class="block font-bold text-gray-900 leading-tight">{{ $order->user_name ?? 'Guest' }}</span>
                                        <span class="text-xs font-medium text-gray-500">{{ $order->user_email ?? 'No Email' }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-8">
                                <div class="flex flex-col gap-1">
                                    @php
                                        $items = is_array($order->items) ? $order->items : json_decode($order->items, true);
                                    @endphp
                                    @if($items)
                                        @foreach($items as $item)
                                            <div class="flex items-center gap-2">
                                                <span class="w-5 h-5 rounded-md bg-gray-100 text-gray-600 text-[10px] font-black flex items-center justify-center">{{ $item['quantity'] ?? 1 }}x</span>
                                                <span class="text-sm font-bold text-gray-700">{{ $item['name'] ?? 'Unknown Item' }}</span>
                                            </div>
                                        @endforeach
                                    @else
                                        <span class="text-gray-400 italic text-sm">No items list</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-8 py-8 text-sm font-black text-gray-900">
                                ${{ number_format($order->total_price, 2) }}
                            </td>
                            <td class="px-8 py-8">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-green-100 text-green-700 text-[10px] font-black uppercase tracking-widest border border-green-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span>
                                    Paid
                                </span>
                            </td>
                            <td class="px-8 py-8 text-right">
                                <form action="{{ route('admin.orders.delete', $order->id) }}" method="POST" onsubmit="return confirm('Archive this order?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-gray-300 hover:text-rose-500 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-8 py-20 text-center">
                                <p class="text-gray-400 font-bold">No orders found yet.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
