<?php

namespace App\Livewire\Songs;

use App\Models\Song;
use Livewire\Component;
use App\Models\Setting;
use Livewire\Attributes\On;

class Item extends Component
{
    public array $song = [];
    public bool $nightMode = false;

    public function mount(array $song = [])
    {
        $this->song = $song;
        $this->nightMode = Setting::first()?->night_mode ?? false;
    }

    #[On('night-mode-toggled')]
    public function updateNightMode($value)
    {
        $this->nightMode = (bool) $value;
    }

    public function getBgColorProperty()
    {
        return $this->nightMode ? 'bg-gray-900' : 'bg-gray-50';
    }

    public function getBgHoverColorProperty()
    {
        return $this->nightMode ? 'hover:bg-gray-900' : 'hover:bg-gray-100';
    }

    public function getTextColorProperty()
    {
        return $this->nightMode ? 'text-white' : 'text-gray-500';
    }

    public function getTextHoverColorProperty()
    {
        return $this->nightMode ? 'group-hover:text-white' : 'group-hover:text-gray-700';
    }

    public function getBgNumberColorProperty()
    {
        return $this->nightMode ? 'bg-white' : ($this->song['type'] == 1 ? 'bg-[#1e3a8a]' : 'bg-[#ff6b35]');
    }

    public function getNumberColorProperty()
    {
        return $this->nightMode ? 'text-gray-700' : 'text-white';
    }


    public function render()
    {
        return view('livewire.songs.item');
    }
}