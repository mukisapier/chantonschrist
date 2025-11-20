<?php

use App\Http\Controllers\SongController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SongController::class, 'index'])->name('songs.index');
Route::get('/songs/{song}', [SongController::class, 'show'])->name('songs.show');
