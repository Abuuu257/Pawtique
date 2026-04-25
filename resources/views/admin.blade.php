@extends('layouts.public')

@section('content')
<div class="pt-32 pb-24 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h1 class="text-3xl font-black text-gray-900 mb-2 tracking-tight">Admin Control Center</h1>
                <p class="text-gray-500 font-medium">Overview of your boutique operations.</p>
            </div>
            <div class="flex items-center gap-3">
                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-orange-100 text-orange-600 font-bold text-xs shadow-sm ring-1 ring-orange-200">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path></svg>
                    Master Admin
                </span>
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf
                    <button type="submit" class="text-xs font-bold text-gray-400 hover:text-gray-900 transition-colors uppercase tracking-widest">Logout</button>
                </form>
            </div>
        </div>

        @if(session('success'))
        <div class="mb-8 p-4 bg-green-50 border border-green-100 text-green-600 rounded-2xl font-bold text-sm flex items-center gap-3">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/></svg>
            {{ session('success') }}
        </div>
        @endif

        <!-- CRUD QUICK ACTIONS -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
            <!-- Manage Products -->
            <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100 hover:shadow-xl transition-all group">
                <div class="w-14 h-14 bg-orange-50 text-orange-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Inventory Management</h3>
                <p class="text-sm text-gray-500 mb-6 font-medium">Currently managing {{ $productCount ?? 0 }} unique items.</p>
                <div class="flex gap-3">
                    <a href="{{ route('admin.products') }}" class="flex-1 bg-gray-900 text-white text-center py-3 rounded-xl text-xs font-bold hover:bg-orange-500 transition-colors uppercase tracking-widest">List All</a>
                    <a href="{{ route('admin.products.create') }}" class="flex-1 bg-orange-100 text-orange-600 text-center py-3 rounded-xl text-xs font-bold hover:bg-orange-200 transition-colors uppercase tracking-widest">Add New</a>
                </div>
            </div>

            <!-- Manage Subscriptions -->
            <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100 hover:shadow-xl transition-all group">
                <div class="w-14 h-14 bg-blue-50 text-blue-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Member Clubs</h3>
                <p class="text-sm text-gray-500 mb-6 font-medium">Currently managing {{ $memberCount ?? 0 }} active club members.</p>
                <a href="{{ route('admin.members') }}" class="w-full inline-block bg-gray-900 text-white text-center py-3 rounded-xl text-xs font-bold hover:bg-blue-500 transition-colors uppercase tracking-widest">Manage Members</a>
            </div>
        </div>

        <!-- RECENT MESSAGES -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-8 border-b border-gray-100 bg-gray-50/50 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                    <h2 class="text-xl font-bold text-gray-900">Recent Customer Inquiries</h2>
                </div>
                <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">{{ count($messages) }} total</span>
            </div>
            
            <div class="divide-y divide-gray-100">
                @forelse($messages as $msg)
                <div class="p-8 hover:bg-gray-50 transition-colors {{ $msg->status === 'resolved' ? 'opacity-60' : '' }}">
                    <div class="flex flex-col sm:flex-row sm:items-start justify-between mb-4 gap-4">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-gray-900 text-white flex flex-shrink-0 items-center justify-center font-black text-lg">
                                {{ strtoupper(substr($msg->first_name, 0, 1)) }}
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 text-lg leading-tight">{{ $msg->first_name }} {{ $msg->last_name }}</h3>
                                <p class="text-sm font-medium text-orange-500">{{ $msg->email }}</p>
                            </div>
                        </div>
                        <div class="text-left sm:text-right flex flex-col items-start sm:items-end gap-2">
                            <div class="flex items-center gap-2">
                                <span class="inline-block px-3 py-1 rounded-lg text-[10px] font-black {{ $msg->status === 'new' ? 'bg-orange-100 text-orange-600 border-orange-200' : 'bg-green-100 text-green-600 border-green-200' }} uppercase tracking-widest border">
                                    {{ $msg->status }}
                                </span>
                                <span class="inline-block px-3 py-1 rounded-lg text-[10px] font-black bg-gray-100 text-gray-500 uppercase tracking-widest border border-gray-200">
                                    {{ $msg->subject }}
                                </span>
                            </div>
                            <p class="text-[10px] font-bold text-gray-400 block">{{ $msg->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    <div class="sm:pl-16 mb-6">
                        <p class="text-gray-600 text-base leading-relaxed p-6 bg-gray-50 rounded-2xl border border-gray-100 italic">
                            "{{ $msg->message }}"
                        </p>
                    </div>

                    <!-- Message Actions -->
                    <div class="sm:pl-16 flex flex-wrap gap-3">
                        <a href="mailto:{{ $msg->email }}?subject=Re: {{ $msg->subject }}" class="px-5 py-2.5 bg-gray-900 text-white rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-orange-500 transition-all flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            Reply via Email
                        </a>
                        
                        <form action="{{ route('admin.messages.status', $msg->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="status" value="{{ $msg->status === 'new' ? 'resolved' : 'new' }}">
                            <button type="submit" class="px-5 py-2.5 {{ $msg->status === 'new' ? 'bg-green-50 text-green-600 border-green-100' : 'bg-gray-100 text-gray-600 border-gray-200' }} border rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-gray-200 transition-all">
                                {{ $msg->status === 'new' ? 'Mark as Resolved' : 'Reopen' }}
                            </button>
                        </form>

                        <form action="{{ route('admin.messages.delete', $msg->id) }}" method="POST" onsubmit="return confirm('Delete this message permanently?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-5 py-2.5 bg-rose-50 text-rose-600 border border-rose-100 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-rose-100 transition-all">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="p-20 text-center">
                    <h3 class="text-gray-400 font-bold">No new messages</h3>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
