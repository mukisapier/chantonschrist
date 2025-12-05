<?php

namespace App\Livewire;

use App\Models\Song;
use Illuminate\View\View;
use Livewire\Component;

class Index extends Component
{
    public function render(): View
    {
        $songs = Song::where('is_favorite', true)->orderBy('updated_at', 'desc')->get()?->toArray();
        return view('livewire.index', compact('songs'))->layout('layouts.app')->title('Chantons');
    }
}
