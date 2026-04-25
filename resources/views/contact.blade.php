@extends('layouts.public')

@section('content')
<div class="pt-32 pb-24 bg-gray-50 min-h-screen relative overflow-hidden">
    <!-- Decorative background elements -->
    <div class="absolute top-20 left-10 w-96 h-96 bg-orange-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
    <div class="absolute bottom-20 right-10 w-96 h-96 bg-rose-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-16">
            <span class="inline-block py-1 px-3 rounded-full bg-orange-100 text-orange-600 text-sm font-semibold mb-4 tracking-wide">
                We're Here For You
            </span>
            <h1 class="text-4xl md:text-6xl font-extrabold text-gray-900 mb-6 tracking-tight">Let's get in touch</h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">Have questions about our premium pet collections, grooming services, or subscriptions? Our team is always ready to help your furry friends.</p>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-2xl border border-gray-100 overflow-hidden flex flex-col lg:flex-row max-w-6xl mx-auto">
            
            <!-- Contact Information Side -->
            <div class="lg:w-2/5 p-10 md:p-14 bg-gray-900 text-white relative overflow-hidden flex flex-col justify-between">
                <!-- Decorative rings -->
                <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 rounded-full border-[30px] border-white/5 z-0"></div>
                <div class="absolute bottom-0 right-0 -mb-16 -mr-16 w-48 h-48 rounded-full border-[20px] border-orange-500/20 z-0"></div>

                <div class="relative z-10">
                    <h3 class="text-3xl font-bold mb-8">Contact Information</h3>
                    <p class="text-gray-400 mb-10 leading-relaxed text-lg">Fill up the form and our Team will get back to you within 24 hours.</p>

                    <div class="space-y-8">
                        <div class="flex items-start gap-4 group cursor-pointer">
                            <div class="w-12 h-12 rounded-full bg-gray-800 flex items-center justify-center text-orange-400 group-hover:bg-orange-500 group-hover:text-white transition-all duration-300 transform group-hover:scale-110 shadow-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-400 font-semibold mb-1">Call Us</p>
                                <p class="text-lg font-medium group-hover:text-orange-400 transition-colors">+1 (555) 123-4567</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 group cursor-pointer">
                            <div class="w-12 h-12 rounded-full bg-gray-800 flex items-center justify-center text-orange-400 group-hover:bg-orange-500 group-hover:text-white transition-all duration-300 transform group-hover:scale-110 shadow-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-400 font-semibold mb-1">Email Us</p>
                                <p class="text-lg font-medium group-hover:text-orange-400 transition-colors">hello@pawtique.com</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 group cursor-pointer">
                            <div class="w-12 h-12 rounded-full bg-gray-800 flex items-center justify-center text-orange-400 group-hover:bg-orange-500 group-hover:text-white transition-all duration-300 transform group-hover:scale-110 shadow-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-400 font-semibold mb-1">Visit Boutique</p>
                                <p class="text-lg font-medium leading-tight group-hover:text-orange-400 transition-colors">123 Pet Avenue,<br>Beverly Hills, CA 90210</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Social Links -->
                <div class="relative z-10 mt-16 flex gap-4">
                    <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-orange-500 transition-colors hover:-translate-y-1 transform duration-300">
                        <span class="sr-only">Twitter</span>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path></svg>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-orange-500 transition-colors hover:-translate-y-1 transform duration-300">
                        <span class="sr-only">Instagram</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"></path><circle cx="4" cy="4" r="2" stroke="none" fill="currentColor"></circle></svg>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-orange-500 transition-colors hover:-translate-y-1 transform duration-300">
                        <span class="sr-only">Facebook</span>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"></path></svg>
                    </a>
                </div>
            </div>

            <!-- Contact Form Side -->
            <div class="lg:w-3/5 p-10 md:p-14 bg-white">
                <form action="{{ route('contact.submit') }}" method="POST" class="space-y-8">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="relative group">
                            <input type="text" name="first_name" id="first_name" required class="block w-full px-4 py-4 text-base text-gray-900 bg-gray-50 border border-gray-200 rounded-2xl appearance-none focus:outline-none focus:ring-0 focus:border-orange-500 focus:bg-white peer transition-all duration-300" placeholder=" " />
                            <label for="first_name" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] left-4 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4 peer-focus:text-orange-500">First Name</label>
                            @error('first_name') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                        </div>
                        <div class="relative group">
                            <input type="text" name="last_name" id="last_name" class="block w-full px-4 py-4 text-base text-gray-900 bg-gray-50 border border-gray-200 rounded-2xl appearance-none focus:outline-none focus:ring-0 focus:border-orange-500 focus:bg-white peer transition-all duration-300" placeholder=" " />
                            <label for="last_name" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] left-4 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4 peer-focus:text-orange-500">Last Name</label>
                            @error('last_name') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-gray-400 peer-focus:text-orange-500 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <input type="email" name="email" id="email" required class="block w-full pl-12 pr-4 py-4 text-base text-gray-900 bg-gray-50 border border-gray-200 rounded-2xl appearance-none focus:outline-none focus:ring-0 focus:border-orange-500 focus:bg-white peer transition-all duration-300" placeholder=" " />
                        <label for="email" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] left-12 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4 peer-focus:text-orange-500">Email Address</label>
                        @error('email') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="relative group">
                        <label class="block text-sm font-semibold text-gray-700 mb-3 ml-1">Subject</label>
                        <div class="flex flex-wrap gap-3">
                            <label class="cursor-pointer">
                                <input type="radio" name="subject" value="General Inquiry" class="peer sr-only" checked>
                                <div class="px-5 py-2.5 rounded-full border border-gray-200 bg-gray-50 text-gray-600 peer-checked:bg-orange-500 peer-checked:text-white peer-checked:border-orange-500 hover:border-gray-300 transition-all font-medium">General Inquiry</div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="radio" name="subject" value="My Order" class="peer sr-only">
                                <div class="px-5 py-2.5 rounded-full border border-gray-200 bg-gray-50 text-gray-600 peer-checked:bg-orange-500 peer-checked:text-white peer-checked:border-orange-500 hover:border-gray-300 transition-all font-medium">My Order</div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="radio" name="subject" value="Grooming Booking" class="peer sr-only">
                                <div class="px-5 py-2.5 rounded-full border border-gray-200 bg-gray-50 text-gray-600 peer-checked:bg-orange-500 peer-checked:text-white peer-checked:border-orange-500 hover:border-gray-300 transition-all font-medium">Grooming Booking</div>
                            </label>
                        </div>
                    </div>

                    <div class="relative group">
                        <textarea id="message" name="message" required rows="4" class="block w-full px-4 py-4 text-base text-gray-900 bg-gray-50 border border-gray-200 rounded-2xl appearance-none focus:outline-none focus:ring-0 focus:border-orange-500 focus:bg-white peer transition-all duration-300 resize-none" placeholder=" "></textarea>
                        <label for="message" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] left-4 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4 peer-focus:text-orange-500">Write your message...</label>
                        @error('message') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex items-center justify-end">
                        <button type="submit" class="inline-flex items-center justify-center px-10 py-4 text-lg font-bold rounded-2xl text-white bg-gray-900 hover:bg-orange-500 shadow-xl hover:shadow-orange-500/30 transition-all duration-300 transform hover:-translate-y-1">
                            Send Message
                            <svg class="w-5 h-5 ml-2 -mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
