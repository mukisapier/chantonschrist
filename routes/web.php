<?php

use Illuminate\Support\Facades\Route;

Route::get('/', App\Livewire\Index::class)->name('songs.index');
Route::get('/{type}', App\Livewire\Songs\Listing::class)->name('songs.listing');
Route::get('/{type}/{song}', App\Livewire\Songs\Show::class)->name('songs.show');
