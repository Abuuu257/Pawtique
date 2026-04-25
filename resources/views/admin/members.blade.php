@extends('layouts.public')

@section('content')
<div class="pt-32 pb-24 bg-gray-50 min-h-screen">
    <div class="max-max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumbs -->
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-4">
                <li><a href="{{ route('admin.dashboard') }}" class="text-sm font-bold text-gray-400 hover:text-gray-900 transition-colors uppercase tracking-widest">Dashboard</a></li>
                <li class="flex items-center space-x-4">
                    <svg class="flex-shrink-0 h-5 w-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20"><path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" /></svg>
                    <span class="text-sm font-bold text-gray-900 uppercase tracking-widest">Member Clubs</span>
                </li>
            </ol>
        </nav>

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12">
            <div>
                <h1 class="text-3xl font-black text-gray-900 mb-2 tracking-tight">Member Club Management</h1>
                <p class="text-gray-500 font-medium">Manage all active pet boutique subscriptions.</p>
            </div>
            
            <!-- Filter Bar -->
            <form action="{{ route('admin.members') }}" method="GET" class="flex items-center gap-3">
                <div class="relative group">
                    <select name="plan" onchange="this.form.submit()" 
                            style="appearance: none !important; -webkit-appearance: none !important; -moz-appearance: none !important; background-image: none !important;"
                            class="bg-white border border-gray-100 rounded-2xl py-3 pl-6 pr-12 focus:ring-2 focus:ring-blue-100 font-bold text-[10px] uppercase tracking-widest text-gray-600 outline-none cursor-pointer transition-all shadow-sm">
                        <option value="all">All Plans</option>
                        @foreach($plans as $plan)
                            <option value="{{ $plan }}" {{ request('plan') == $plan ? 'selected' : '' }}>{{ $plan }}</option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                </div>

                <div class="h-10 w-px bg-gray-200 mx-2"></div>

                <span class="inline-flex items-center gap-2 px-4 py-3 rounded-2xl bg-blue-100 text-blue-600 font-bold text-[10px] uppercase tracking-widest shadow-sm ring-1 ring-blue-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    {{ $members->count() }} Members
                </span>
            </form>
        </div>

        @if(session('success'))
        <div class="mb-8 p-4 bg-green-50 border border-green-100 text-green-600 rounded-2xl font-bold text-sm flex items-center gap-3">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/></svg>
            {{ session('success') }}
        </div>
        @endif

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-gray-50/50 border-b border-gray-100">
                            <th class="px-8 py-5 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Subscriber</th>
                            <th class="px-8 py-5 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Selected Plan</th>
                            <th class="px-8 py-5 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Monthly Price</th>
                            <th class="px-8 py-5 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Status</th>
                            <th class="px-8 py-5 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Joined Date</th>
                            <th class="px-8 py-5 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($members as $member)
                        <tr class="hover:bg-gray-50/50 transition-colors group">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-xl bg-gray-900 text-white flex items-center justify-center font-black text-sm">
                                        {{ strtoupper(substr($member->user->name ?? $member->email, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="text-sm font-black text-gray-900">{{ $member->user->name ?? 'Guest Member' }}</div>
                                        <div class="text-xs font-medium text-gray-400">{{ $member->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <span class="px-3 py-1 bg-orange-50 text-orange-600 rounded-lg text-[10px] font-black uppercase tracking-widest border border-orange-100">
                                    {{ $member->plan_name }}
                                </span>
                            </td>
                            <td class="px-8 py-6 text-sm font-black text-gray-900">
                                ${{ number_format($member->price, 2) }}
                            </td>
                            <td class="px-8 py-6">
                                <span class="flex items-center gap-1.5 text-[10px] font-black uppercase tracking-widest text-green-600">
                                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></span>
                                    {{ $member->status }}
                                </span>
                            </td>
                            <td class="px-8 py-6 text-xs font-bold text-gray-400">
                                {{ $member->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-8 py-6 text-right">
                                <form action="{{ route('admin.members.delete', $member->id) }}" method="POST" onsubmit="return confirm('Remove this user from the club permanently?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-gray-400 hover:text-rose-500 hover:bg-rose-50 rounded-lg transition-all" title="Remove Member">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-8 py-20 text-center">
                                <div class="flex flex-col items-center gap-4">
                                    <div class="w-16 h-16 bg-gray-50 rounded-2xl flex items-center justify-center text-gray-300">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-900">No members yet</h3>
                                    <p class="text-gray-500 max-w-xs mx-auto">Active subscriptions will appear here as soon as users join your boutique clubs.</p>
                                </div>
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
