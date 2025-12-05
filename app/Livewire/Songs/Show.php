<?php

namespace App\Livewire\Songs;

use App\Models\Song;
use Livewire\Component;
use App\Models\Setting;
use Livewire\Attributes\On;

class Show extends Component
{
    public int $songId;
    public int $type;


    public bool $nightMode = false;

    public function mount(string $type, Song $song): void
    {
        $this->songId = $song->id;
        $this->type = (int) $type;

        $this->nightMode = Setting::first()?->night_mode ?? false;
    }

    #[On('night-mode-toggled')]
    public function updateNightMode($value)
    {
        $this->nightMode = (bool) $value;
    }

    public function getBgColorProperty(){
        return $this->nightMode ? 'bg-gray-900' : 'bg-white';
    }

    public function getTextColorProperty(){
        return $this->nightMode ? 'text-white' : 'text-gray-900';
    }

    public function render()
    {
        $song = Song::findOrFail($this->songId);
        return view('livewire.songs.show', compact('song'))->layout('layouts.app')->title($song->title.' - Chantons');
    }
}
