<?php
use Livewire\Volt\Component;
use Livewire\Attributes\On;
use App\Models\Setting;

new class extends Component {
    public $route;
    public $label;
    public $icon;
    public $originalVariant;
    public $nightMode = false;

    public function mount($route = null, $label = null, $icon = null, $variant = 'primary')
    {
        $this->route = $route;
        $this->label = $label;
        $this->icon = $icon;
        $this->originalVariant = $variant;

        $this->nightMode = Setting::first()?->night_mode ?? false;
    }

    public function getVariantProperty()
    {
        return $this->nightMode ? 'night' : $this->originalVariant;
    }

    public function getBgColorProperty()
    {
        return match ($this->variant) {
            'primary' => 'bg-[#1e3a8a]',
            'secondary' => 'bg-[#ff6b35]',
            'night' => 'bg-gray-800',
            default => 'bg-gray-500',
        };
    }

    public function getBgHoverColorProperty()
    {
        return match ($this->variant) {
            'primary' => 'hover:bg-[#2d4ba8]',
            'secondary' => 'hover:bg-[#ff7d4d]',
            'night' => 'hover:bg-gray-700',
            default => 'hover:bg-gray-500',
        };
    }

    public function getTextColorProperty()
    {
        return match ($this->variant) {
            'primary' => 'text-white',
            'secondary' => 'text-white',
            'night' => 'text-white',
            default => 'text-gray-500',
        };
    }

    #[On('night-mode-toggled')]
    public function updateNightMode($value)
    {
        $this->nightMode = (bool) $value;
    }
};

?>

<a href="{{ $route }}" wire:navigate
    class="flex-1 flex items-center justify-between {{ $this->bgColor }} {{ $this->bgHoverColor }} {{ $this->textColor }} rounded-xl shadow-md hover:shadow-lg transition-all duration-200 p-4 active:scale-[0.98]">
    <div>
        <p class="font-bold mb-0 tracking-wide {{ $this->textColor }}">{{ $label }}</p>
    </div>
    @if ($icon)
        <i class="ph ph-{{ $icon }} {{ $this->textColor }}"></i>
    @endif
</a>
