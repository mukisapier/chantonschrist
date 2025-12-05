<?php

namespace App\Livewire\Partials;

use App\Models\Setting;
use Livewire\Component;

class Header extends Component
{
    public ?int $type = null;
    public ?string $backRoute = null;
    public bool $nightMode = false;

    public function mount(?int $type = null, ?string $backRoute = null): void
    {
        $this->type = $type;
        $this->backRoute = $backRoute;

        $setting = Setting::first();
        if ($setting) {
            $this->nightMode = $setting->night_mode;
        }
    }

    public function toggleNightMode(): void
    {
        $this->nightMode = ! $this->nightMode;

        $setting = Setting::first();
        if ($setting) {
            $setting->update(['night_mode' => $this->nightMode]);
        }
        $this->dispatch('night-mode-toggled', value: $this->nightMode);
    }

    public function getBgColorProperty(){
        return $this->nightMode ? 'bg-gray-900' : 'bg-[#1e3a8a]';
    }

    public function getNightModeIconProperty(){
        return $this->nightMode ? 'ph ph-sun' : 'ph ph-moon';
    }

    public function render()
    {
        return view('livewire.partials.header');
    }
}
