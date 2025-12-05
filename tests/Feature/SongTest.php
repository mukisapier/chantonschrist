<?php

use App\Livewire\Index;
use App\Models\Setting;
use App\Models\Song;
use Livewire\Livewire;

use function Pest\Laravel\get;

uses()->group('songs');

beforeEach(function () {
    $this->artisan('migrate:fresh');
    Setting::create(['font_size' => 50, 'night_mode' => false]);
});

it('displays the songs index page', function () {
    $response = get(route('songs.index'));

    $response->assertSuccessful();
    $response->assertSeeLivewire(Index::class);
});

it('displays songs on the index page', function () {
    Song::factory()->count(3)->create(['is_favorite' => true]);
    Song::factory()->count(2)->create(['is_favorite' => false]);

    Livewire::test(Index::class)
        ->assertSuccessful()
        ->assertViewHas('songs', function ($songs) {
            return $songs->count() === 3; // Only favorites
        });
});

it('displays only favorite songs on index', function () {
    $favorite1 = Song::factory()->create(['title' => 'Amazing Grace', 'is_favorite' => true]);
    $favorite2 = Song::factory()->create(['title' => 'How Great Thou Art', 'is_favorite' => true]);
    Song::factory()->create(['title' => 'Not Favorite', 'is_favorite' => false]);

    Livewire::test(Index::class)
        ->assertSee('Amazing Grace')
        ->assertSee('How Great Thou Art')
        ->assertDontSee('Not Favorite');
});

it('displays a specific song', function () {
    $song = Song::factory()->create([
        'title' => 'Amazing Grace',
        'content' => 'Amazing grace, how sweet the sound',
        'author' => 'John Newton',
    ]);

    $response = get(route('songs.show', ['type' => $song->type, 'song' => $song]));

    $response->assertSuccessful();
    $response->assertSee('Amazing Grace');
    $response->assertSee('Amazing grace, how sweet the sound');
    $response->assertSee('John Newton');
});

it('shows correct category name for french songs', function () {
    $song = Song::factory()->french()->create();

    expect($song->category_name)->toBe('Chants de triomphe');
    expect($song->language)->toBe('French');
});

it('shows correct category name for swahili songs', function () {
    $song = Song::factory()->swahili()->create();

    expect($song->category_name)->toBe('Nyimbo Za Wokovu');
    expect($song->language)->toBe('Swahili');
});

it('shows no songs when no favorites exist', function () {
    Song::factory()->count(5)->create(['is_favorite' => false]);

    Livewire::test(Index::class)
        ->assertSuccessful()
        ->assertSee('Aucun cantique favori disponible');
});

it('provides previous and next song links', function () {
    $song1 = Song::factory()->french()->create(['number' => 1]);
    $song2 = Song::factory()->french()->create(['number' => 2]);
    $song3 = Song::factory()->french()->create(['number' => 3]);

    $response = get(route('songs.show', ['type' => $song2->type, 'song' => $song2]));

    $response->assertSuccessful();
    $response->assertSee($song1->number);
    $response->assertSee($song3->number);
});

it('handles first song with no previous', function () {
    $song1 = Song::factory()->french()->create(['number' => 1]);
    $song2 = Song::factory()->french()->create(['number' => 2]);

    $response = get(route('songs.show', ['type' => $song1->type, 'song' => $song1]));

    $response->assertSuccessful();
    $response->assertSee($song2->number);
});

it('handles last song with no next', function () {
    $song1 = Song::factory()->french()->create(['number' => 1]);
    $song2 = Song::factory()->french()->create(['number' => 2]);

    $response = get(route('songs.show', ['type' => $song2->type, 'song' => $song2]));

    $response->assertSuccessful();
    $response->assertSee($song1->number);
});
