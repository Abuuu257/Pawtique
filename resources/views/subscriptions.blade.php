@extends('layouts.public')

@section('content')
<div class="pt-32 pb-24 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="inline-block py-1 px-3 rounded-full bg-orange-100 text-orange-600 text-sm font-semibold mb-6 tracking-wide">
                Never Run Out
            </span>
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4">Pawtique Subscriptions</h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">Get your pet's favorite food and treats delivered to your door every month. Subscribe and save 15%.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Basic Plan -->
            <div class="bg-white rounded-3xl p-8 shadow-sm hover:shadow-xl transition-shadow duration-300 border border-gray-100 flex flex-col">
                <h3 class="text-xl font-bold text-gray-900 mb-2">The Snack Pack</h3>
                <p class="text-gray-500 mb-6 flex-grow">A monthly selection of 3 premium organic treats.</p>
                <div class="mb-8">
                    <span class="text-4xl font-extrabold text-gray-900">$29</span>
                    <span class="text-gray-500 font-semibold">/month</span>
                </div>
                <ul class="space-y-4 mb-8">
                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-orange-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span class="text-gray-600">3 unique treats</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-orange-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span class="text-gray-600">100% natural ingredients</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-orange-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span class="text-gray-600">Free shipping</span>
                    </li>
                </ul>
                <form action="{{ route('subscribe') }}" method="POST">
                    @csrf
                    <input type="hidden" name="name" value="The Snack Pack">
                    <input type="hidden" name="price" value="29">
                    <input type="hidden" name="subtitle" value="Monthly Subscription">
                    <button type="submit" class="w-full py-4 rounded-xl font-bold text-gray-900 bg-gray-100 hover:bg-gray-200 transition-colors">Select Plan</button>
                </form>
            </div>

            <!-- Pro Plan -->
            <div class="bg-gray-900 rounded-3xl p-8 shadow-2xl relative transform md:-translate-y-4 flex flex-col">
                <div class="absolute top-0 right-8 transform -translate-y-1/2">
                    <span class="bg-orange-500 text-white text-xs font-bold px-4 py-1.5 rounded-full shadow-lg">Most Popular</span>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">The Full Feast</h3>
                <p class="text-gray-400 mb-6 flex-grow">Everything they need. Premium food bag plus selected treats and one toy.</p>
                <div class="mb-8">
                    <span class="text-4xl font-extrabold text-white">$69</span>
                    <span class="text-gray-500 font-semibold">/month</span>
                </div>
                <ul class="space-y-4 mb-8">
                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-orange-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span class="text-gray-300">Large bag of premium food</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-orange-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span class="text-gray-300">2 organic treats</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-orange-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span class="text-gray-300">1 surprise toy</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-orange-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span class="text-gray-300">VIP Support & Free Shipping</span>
                    </li>
                </ul>
                <form action="{{ route('subscribe') }}" method="POST">
                    @csrf
                    <input type="hidden" name="name" value="The Full Feast">
                    <input type="hidden" name="price" value="69">
                    <input type="hidden" name="subtitle" value="Monthly Subscription">
                    <button type="submit" class="w-full py-4 rounded-xl font-bold text-gray-900 bg-orange-400 hover:bg-orange-300 transition-colors">Select Plan</button>
                </form>
            </div>

            <!-- Deluxe Plan -->
            <div class="bg-white rounded-3xl p-8 shadow-sm hover:shadow-xl transition-shadow duration-300 border border-gray-100 flex flex-col">
                <h3 class="text-xl font-bold text-gray-900 mb-2">The Groomer</h3>
                <p class="text-gray-500 mb-6 flex-grow">Essential hygiene and grooming restocked monthly so they stay fresh.</p>
                <div class="mb-8">
                    <span class="text-4xl font-extrabold text-gray-900">$45</span>
                    <span class="text-gray-500 font-semibold">/month</span>
                </div>
                <ul class="space-y-4 mb-8">
                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-orange-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span class="text-gray-600">Fresh shampoo bottle</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-orange-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span class="text-gray-600">Waste bags & wipes</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-orange-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span class="text-gray-600">Dental sticks</span>
                    </li>
                </ul>
                <form action="{{ route('subscribe') }}" method="POST">
                    @csrf
                    <input type="hidden" name="name" value="The Groomer">
                    <input type="hidden" name="price" value="45">
                    <input type="hidden" name="subtitle" value="Monthly Subscription">
                    <button type="submit" class="w-full py-4 rounded-xl font-bold text-gray-900 bg-gray-100 hover:bg-gray-200 transition-colors">Select Plan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
