<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    /** @use HasFactory<\Database\Factories\SongFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'number' => 'integer',
            'type' => 'integer',
        ];
    }

    /**
     * Get the category name for the song.
     */
    public function getCategoryNameAttribute(): string
    {
        return match ($this->type) {
            1 => 'Nyimbo Za Wokovu',
            2 => 'Chants de triomphe',
            default => 'Unknown',
        };
    }

    /**
     * Get the language for the song.
     */
    public function getLanguageAttribute(): string
    {
        return match ($this->type) {
            1 => 'Swahili',
            2 => 'French',
            default => 'Unknown',
        };
    }

    /**
     * Scope a query to search songs by title or number.
     */
    public function scopeSearch($query, string $search): mixed
    {
        return $query->where(function ($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
                ->orWhere('number', '=', (int) $search);
        });
    }

    /**
     * Scope a query to filter by song type.
     */
    public function scopeOfType($query, int $type): mixed
    {
        return $query->where('type', $type);
    }
}
