<?php

namespace Database\Seeders;

use App\Models\Song;
use Illuminate\Database\Seeder;

class SongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Import songs from the converted array file
        $songsData = require __DIR__.'/songs_array.php';

        // Map the data to match our database schema (id -> number)
        $songs = collect($songsData)->map(function ($song) {
            return [
                'number' => $song['id'],
                'title' => $song['title'],
                'type' => $song['type'],
                'content' => $song['content'],
                'author' => $song['author'] ?? null,
            ];
        })->toArray();

        // Insert all songs
        foreach ($songs as $song) {
            Song::create($song);
        }
    }
}
