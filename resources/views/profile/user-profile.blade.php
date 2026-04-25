@extends('layouts.public')

@section('content')
<div class="pt-32 pb-24 bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Profile Header -->
        <div class="bg-white rounded-[3rem] p-10 md:p-14 shadow-2xl border border-gray-100 mb-10 relative overflow-hidden">
            <!-- Decorative background blurs -->
            <div class="absolute -top-24 -right-24 w-80 h-80 bg-orange-100/50 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-24 -left-24 w-80 h-80 bg-rose-100/30 rounded-full blur-3xl"></div>
            
            <div class="relative z-10 grid grid-cols-1 md:grid-cols-[auto_1fr_auto] items-center gap-8 md:gap-12">
                <!-- Avatar Seal -->
                <div class="flex justify-center">
                    <div class="w-24 h-24 md:w-32 md:h-32 bg-gradient-to-tr from-orange-400 to-rose-400 p-[3px] rounded-full shadow-2xl relative group flex-shrink-0 aspect-square">
                        <div class="w-full h-full rounded-full border-[5px] border-white bg-white overflow-hidden flex items-center justify-center">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <img class="w-full h-full object-cover" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" />
                            @else
                                <span class="text-orange-500 font-black text-4xl">{{ substr($user->name, 0, 1) }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- User Info -->
                <div class="text-center md:text-left">
                    <h1 class="text-4xl md:text-5xl font-black text-gray-900 mb-2 tracking-tight">{{ $user->name }}</h1>
                    <p class="text-lg text-gray-400 font-medium mb-6">{{ $user->email }}</p>
                    
                    <div class="flex flex-wrap justify-center md:justify-start gap-3">
                        <span class="inline-flex items-center px-5 py-2 rounded-xl bg-gray-900 text-white text-[10px] font-black uppercase tracking-widest shadow-lg">
                            <svg class="w-3 h-3 mr-2 text-orange-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path></svg>
                            Active Member
                        </span>
                        @if($user->is_admin)
                        <span class="inline-flex items-center px-5 py-2 rounded-xl bg-orange-50 text-orange-600 text-[10px] font-black uppercase tracking-widest border border-orange-100">
                            Boutique Admin
                        </span>
                        @endif
                    </div>
                </div>
                
                <!-- Action -->
                <div class="flex justify-center md:justify-end">
                    <a href="{{ route('profile.show') }}" class="inline-flex items-center justify-center px-10 py-5 bg-gray-900 text-white rounded-2xl text-[11px] font-black uppercase tracking-[0.2em] hover:bg-orange-500 transition-all shadow-xl hover:-translate-y-1 active:scale-95 whitespace-nowrap">
                        Edit Account
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Membership Status -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100 h-full">
                    <h2 class="text-xl font-bold text-gray-900 mb-8 flex items-center gap-3">
                        <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        Club Membership
                    </h2>

                    @if($subscription)
                    <div class="bg-orange-50 rounded-3xl p-8 border border-orange-100 relative overflow-hidden group">
                        <div class="absolute -right-8 -bottom-8 w-32 h-32 text-orange-100 transform rotate-12 transition-transform group-hover:scale-110">
                            <svg fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.5c-1.5 0-2.8-1.1-3.4-2.5-.5-1.1-1.4-1.9-2.5-2.2-1.8-.4-3.1-1.9-3.1-3.8 0-2.1 1.7-3.8 3.8-3.8.4 0 .9.1 1.3.2 1.4.5 3-1.1 2.8-2.6-.2-1.6.9-3.2 2.5-3.6 1.8-.4 3.6 1 3.6 2.8 0 1.2.8 2.3 1.9 2.7 1.4.5 2.2 1.9 2.2 3.3 0 2-1.6 3.6-3.6 3.6-.5 0-.9-.1-1.4-.2-1.3-.5-2.8 1-2.7 2.4.2 1.4-.8 2.8-2.1 3.3-.4.2-.9.4-1.3.4z"/></svg>
                        </div>
                        
                        <div class="relative z-10">
                            <span class="inline-block px-3 py-1 rounded-lg bg-white text-orange-600 text-[10px] font-black uppercase tracking-widest border border-orange-100 mb-4">
                                Currently Active
                            </span>
                            <h3 class="text-3xl font-black text-gray-900 mb-2">{{ $subscription->plan_name }}</h3>
                            <p class="text-gray-500 font-medium mb-6">Your next delivery is being prepared.</p>
                            
                            <div class="flex items-center gap-6 text-sm font-bold text-gray-900">
                                <div>
                                    <span class="block text-[10px] text-gray-400 uppercase tracking-widest mb-1">Price</span>
                                    ${{ number_format($subscription->price, 2) }}/mo
                                </div>
                                <div>
                                    <span class="block text-[10px] text-gray-400 uppercase tracking-widest mb-1">Member Since</span>
                                    {{ $subscription->created_at->format('M Y') }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="text-center py-12 px-6 bg-gray-50 rounded-3xl border-2 border-dashed border-gray-200">
                        <div class="w-16 h-16 bg-white rounded-2xl shadow-sm flex items-center justify-center mx-auto mb-4 text-gray-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="font-bold text-gray-900 mb-2">No Active Membership</h3>
                        <p class="text-gray-500 text-sm mb-6">Join a Pawtique club today and get premium treats delivered monthly.</p>
                        <a href="{{ route('subscriptions') }}" class="inline-flex items-center justify-center px-8 py-3 bg-gray-900 text-white rounded-xl text-xs font-black uppercase tracking-widest hover:bg-orange-500 transition-all">
                            View Plans
                        </a>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Quick Stats/Info -->
            <div class="space-y-8">
                <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-900 mb-6">Account Summary</h3>
                    <div class="space-y-6">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-orange-50 rounded-xl flex items-center justify-center text-orange-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <span class="block text-[10px] text-gray-400 uppercase tracking-widest">Last Login</span>
                                <span class="text-sm font-bold text-gray-900">Today</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-green-50 rounded-xl flex items-center justify-center text-green-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            </div>
                            <div>
                                <span class="block text-[10px] text-gray-400 uppercase tracking-widest">Security Status</span>
                                <span class="text-sm font-bold text-gray-900 text-green-600">Verified</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Support -->
                <div class="bg-gray-900 rounded-[2.5rem] p-8 shadow-xl text-white">
                    <h3 class="text-lg font-bold mb-4">Need help?</h3>
                    <p class="text-gray-400 text-sm mb-6 leading-relaxed">Our boutique team is available to assist you with your orders or membership.</p>
                    <a href="{{ route('contact') }}" class="w-full py-3 bg-white text-gray-900 rounded-xl text-xs font-black uppercase tracking-widest text-center inline-block hover:bg-orange-400 transition-colors">
                        Contact Support
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
