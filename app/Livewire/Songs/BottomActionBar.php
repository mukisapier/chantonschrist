<?php

namespace App\Livewire\Songs;

use App\Models\Setting;
use App\Models\Song;
use Livewire\Component;
use Livewire\Attributes\On;

class BottomActionBar extends Component
{
    public int $songId;
    public int $fontSizePercentage = 50;
    public string $fontSizePx = '18px';
    public bool $nightMode = false;

    public function mount(int $songId): void
    {
        $this->songId = $songId;

        $setting = Setting::first();
        if ($setting) {
            $this->fontSizePercentage = $setting->font_size ?? 50;
            $this->fontSizePx = $this->convert_percentage_to_px($this->fontSizePercentage);
            $this->nightMode = $setting->night_mode;
        }

        // Apply the font size from database to the DOM on initial load
        $this->js("
            const content = document.getElementById('lyrics-content');
            content.style.fontSize = '{$this->fontSizePx}';
        ");
    }

    #[On('night-mode-toggled')]
    public function updateNightMode($value)
    {
        $this->nightMode = (bool) $value;
    }

    public function convert_percentage_to_px($percentage)
    {
        return match ($percentage) {
            10 => '10px',
            20 => '12px',
            30 => '14px',
            40 => '16px',
            50 => '18px',
            60 => '20px',
            70 => '22px',
            80 => '24px',
            90 => '26px',
            100 => '28px',
            default => '18px',
        };
    }

    public function zoomOut()
    {
        // Decrease font size by 10, minimum 10%
        if ($this->fontSizePercentage > 10) {
            $this->fontSizePercentage = max($this->fontSizePercentage - 10, 10);
            $this->fontSizePx = $this->convert_percentage_to_px($this->fontSizePercentage);

            // Update database
            $setting = Setting::first();
            if ($setting) {
                $setting->update(['font_size' => $this->fontSizePercentage]);
            }

            // Update DOM
            $this->js("
                const content = document.getElementById('lyrics-content');
                if (content) {
                    content.style.fontSize = '{$this->fontSizePx}';
                }
            ");
        }
    }

    public function zoomIn()
    {
        // Increase font size by 10, maximum 100%
        if ($this->fontSizePercentage < 100) {
            $this->fontSizePercentage = min($this->fontSizePercentage + 10, 100);
            $this->fontSizePx = $this->convert_percentage_to_px($this->fontSizePercentage);

            // Update database
            $setting = Setting::first();
            if ($setting) {
                $setting->update(['font_size' => $this->fontSizePercentage]);
            }

            // Update DOM
            $this->js("
                const content = document.getElementById('lyrics-content');
                if (content) {
                    content.style.fontSize = '{$this->fontSizePx}';
                }
            ");
        }
    }

    public function toggleFavorite()
    {
        $song = Song::findOrFail($this->songId);
        $song->is_favorite = ! $song->is_favorite;
        $song->save();
    }

    public function scrollToTop()
    {
        $this->js("window.scrollTo({ top: 0, behavior: 'smooth' });");
    }

    public function getBgColorProperty()
    {
        return $this->nightMode ? 'bg-gray-900' : 'bg-white';
    }

    public function getTextColorProperty()
    {
        return $this->nightMode ? 'text-white' : 'text-gray-900';
    }

    public function getBorderColorProperty()
    {
        return $this->nightMode ? 'border-gray-700' : 'border-gray-200';
    }

    public function getHoverBgColorProperty()
    {
        return $this->nightMode ? 'hover:bg-gray-700' : 'hover:bg-gray-100';
    }

    public function getTextSecondaryColorProperty()
    {
        return $this->nightMode ? 'text-gray-300' : 'text-gray-700';
    }

    public function render()
    {
        $song = Song::findOrFail($this->songId);

        $previousSong = Song::where('type', $song->type)
            ->where(function ($query) use ($song) {
                $query->where('number', '<', $song->number)
                    ->orWhere(function ($q) use ($song) {
                        $q->where('number', '=', $song->number)
                            ->where('id', '<', $song->id);
                    });
            })
            ->orderBy('number', 'desc')
            ->orderBy('id', 'desc')
            ->first();

        $nextSong = Song::where('type', $song->type)
            ->where(function ($query) use ($song) {
                $query->where('number', '>', $song->number)
                    ->orWhere(function ($q) use ($song) {
                        $q->where('number', '=', $song->number)
                            ->where('id', '>', $song->id);
                    });
            })
            ->orderBy('number', 'asc')
            ->orderBy('id', 'asc')
            ->first();

        return view('livewire.songs.bottom-action-bar', compact('song', 'previousSong', 'nextSong'));
    }
}
