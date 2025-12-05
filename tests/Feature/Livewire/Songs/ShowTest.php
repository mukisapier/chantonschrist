<?php

use App\Livewire\Songs\Show;
use App\Models\Setting;
use App\Models\Song;
use Livewire\Livewire;

beforeEach(function () {
    $this->artisan('migrate:fresh');
    Setting::create(['font_size' => 50, 'night_mode' => false]);
});

it('renders successfully', function () {
    $song = Song::factory()->create();

    Livewire::test(Show::class, ['type' => $song->type, 'song' => $song])
        ->assertStatus(200)
        ->assertSee($song->title);
});
