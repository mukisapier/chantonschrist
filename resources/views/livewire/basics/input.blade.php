<?php
    use Livewire\Volt\Component;
    use Livewire\Attributes\Modelable;
    
    new class extends Component {
        #[Modelable]
        public $value = '';
        
        public $type = "text";
        public $icon;
        public $loading;
        public $placeholder;

        public function mount($icon, $loading, $placeholder)
        {
            $this->icon = $icon;
            $this->loading = $loading;
            $this->placeholder = $placeholder;
        }
    }
?>

<div class="mb-6">
    <div class="relative bg-white rounded-xl shadow-sm">
        @if($icon)
            <i class="ph ph-{{ $icon }} absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400"></i>
        @endif
        <input
            type="{{ $type }}"
            wire:model.live.debounce.500ms="value"
            placeholder="{{ $placeholder }}"
            class="w-full pl-12 pr-12 py-3.5 rounded-xl border border-gray-300 focus:border-[#1e3a8a] focus:outline-none focus:ring-2 focus:ring-blue-100 text-gray-700 placeholder-gray-400 transition">

        <!-- Loading Spinner -->
        @if($loading)
        <div wire:loading wire:target="value" class="absolute right-4 top-1/2 transform -translate-y-1/2">
            <svg class="animate-spin h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </div>
        @endif
    </div>
</div>