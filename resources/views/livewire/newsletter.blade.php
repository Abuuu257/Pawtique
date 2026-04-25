<div>
    @if($subscribed)
        <div class="bg-green-500/10 border border-green-500/20 text-green-400 p-4 rounded-xl flex items-center gap-3 mt-4">
            <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="font-bold text-sm">Thanks for subscribing! Check your inbox.</span>
        </div>
    @else
        <form wire:submit="subscribe" class="flex flex-col sm:flex-row gap-3 mt-4">
            <input type="email" wire:model="email" placeholder="Enter your email" required class="flex-grow bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-colors">
            <button type="submit" wire:loading.attr="disabled" class="px-6 py-3 bg-orange-500 hover:bg-orange-600 disabled:opacity-50 text-white font-bold rounded-xl transition-colors whitespace-nowrap">
                <span wire:loading.remove>Subscribe</span>
                <span wire:loading>...</span>
            </button>
        </form>
        @error('email') <span class="text-rose-400 text-sm mt-2 block">{{ $message }}</span> @enderror
    @endif
</div>
