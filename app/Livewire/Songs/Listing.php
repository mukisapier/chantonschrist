<?php

namespace App\Livewire\Songs;

use App\Models\Song;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use App\Models\Setting;

#[Layout('layouts.app')]
class Listing extends Component
{
    public ?int $type = null;   
    public string $search = '';

    public array $songs = [];
    public bool $loading = false;
    public bool $nightMode = false;
    
    public function mount(): void
    {
        $this->loadSongs();
        $this->nightMode = Setting::first()?->night_mode ?? false;
    }

    #[On('night-mode-toggled')]
    public function updateNightMode($value)
    {
        $this->nightMode = (bool) $value;
    }

    /**
     * Runs when search input changes
     */
    public function updatedSearch(): void
    {
        $this->loading = true;
        $this->loadSongs();
        $this->loading = false;
    }

    public function getBgColorProperty()
    {
        return $this->nightMode ? 'bg-gray-800' : 'bg-gray-50';
    }

    /**
     * Shared method used in mount() and search updates
     */
    private function loadSongs(): void
    {
        $query = Song::query()
            ->when($this->type !== null, fn ($q) => $q->ofType($this->type))
            ->orderBy('number');

        if ($this->search !== '') {
            $query->search($this->search);
        }

        $this->songs = $query->get(['id', 'number', 'title', 'type', 'is_favorite'])->toArray();
    }

    public function render(): \Illuminate\View\View
    {
        return view('livewire.songs.listing');
    }
}
