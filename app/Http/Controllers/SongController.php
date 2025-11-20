<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SongController extends Controller
{
    /**
     * Display the home page with search.
     */
    public function index(Request $request): View
    {
        $search = $request->input('search');
        $type = $request->input('type');

        $query = Song::query();

        if ($search) {
            $query->search($search);
        }

        if ($type) {
            $query->ofType((int) $type);
        }

        $songs = $query->orderBy('number')->orderBy('title')->paginate(20);

        return view('songs.index', [
            'songs' => $songs,
            'search' => $search,
            'type' => $type,
        ]);
    }

    /**
     * Display a specific song.
     */
    public function show(Song $song): View
    {
        // Get previous song (same type, lower number or ID)
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

        // Get next song (same type, higher number or ID)
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

        return view('songs.show', [
            'song' => $song,
            'previousSong' => $previousSong,
            'nextSong' => $nextSong,
        ]);
    }
}
