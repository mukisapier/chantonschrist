<div class="fixed top-0 left-0 right-0 z-50 shadow-lg height-16 {{ $this->bgColor }} text-white py-6 px-4 transition-colors">
    <div class="max-w-2xl mx-auto flex items-center justify-center">
        @if (request()->routeIs('songs.listing'))
            <a href="{{ route('songs.index') }}" wire:navigate
                class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/20 dark:bg-white/10 hover:bg-white/30 dark:hover:bg-white/20 transition cursor-pointer">
                <i class="ph ph-caret-left text-white"></i>
            </a>
        @elseif (request()->routeIs('songs.show'))
            <a href="{{ route('songs.listing', ['type' => request()->route('type')]) }}" wire:navigate
                class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/20 dark:bg-white/10 hover:bg-white/30 dark:hover:bg-white/20 transition cursor-pointer">
                <i class="ph ph-caret-left text-white"></i>
            </a>
        @endif
        <div class="flex-1 items-center justify-end">
            <img src="{{ asset('images/logo.png') }}" alt="CHANTONS" class="h-10 mx-auto">
        </div>

        <div class="flex items-center justify-end">
            <button wire:click="toggleNightMode" class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/20 dark:bg-white/10 hover:bg-white/30 dark:hover:bg-white/20 transition cursor-pointer"
                title="Mode nuit">
                <i class="{{ $this->nightModeIcon }} text-white"></i>
            </button>
        </div>
    </div>
</div>
