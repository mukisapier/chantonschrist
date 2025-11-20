<?php

use App\Models\Song;

use function Pest\Laravel\get;

uses()->group('songs');

beforeEach(function () {
    $this->artisan('migrate:fresh');
});

it('displays the songs index page', function () {
    $response = get(route('songs.index'));

    $response->assertSuccessful();
    $response->assertViewIs('songs.index');
});

it('displays songs on the index page', function () {
    Song::factory()->count(5)->create();

    $response = get(route('songs.index'));

    $response->assertSuccessful();
    $response->assertViewHas('songs');
});

it('can search songs by title', function () {
    Song::factory()->create(['title' => 'Amazing Grace', 'number' => 100]);
    Song::factory()->create(['title' => 'How Great Thou Art', 'number' => 200]);

    $response = get(route('songs.index', ['search' => 'Amazing']));

    $response->assertSuccessful();
    $response->assertSee('Amazing Grace');
    $response->assertDontSee('How Great Thou Art');
});

it('can search songs by number', function () {
    Song::factory()->create(['title' => 'Amazing Grace', 'number' => 100]);
    Song::factory()->create(['title' => 'How Great Thou Art', 'number' => 200]);

    $response = get(route('songs.index', ['search' => '100']));

    $response->assertSuccessful();
    $response->assertSee('Amazing Grace');
    $response->assertDontSee('How Great Thou Art');
});

it('can filter songs by type', function () {
    Song::factory()->french()->create(['title' => 'French Song']);
    Song::factory()->swahili()->create(['title' => 'Swahili Song']);

    $response = get(route('songs.index', ['type' => 2]));

    $response->assertSuccessful();
    $response->assertSee('French Song');
    $response->assertDontSee('Swahili Song');
});

it('can combine search and type filter', function () {
    Song::factory()->french()->create(['title' => 'French Grace', 'number' => 100]);
    Song::factory()->french()->create(['title' => 'French Love', 'number' => 200]);
    Song::factory()->swahili()->create(['title' => 'Swahili Grace', 'number' => 300]);

    $response = get(route('songs.index', ['search' => 'Grace', 'type' => 2]));

    $response->assertSuccessful();
    $response->assertSee('French Grace');
    $response->assertDontSee('French Love');
    $response->assertDontSee('Swahili Grace');
});

it('displays a specific song', function () {
    $song = Song::factory()->create([
        'title' => 'Amazing Grace',
        'content' => 'Amazing grace, how sweet the sound',
        'author' => 'John Newton',
    ]);

    $response = get(route('songs.show', $song));

    $response->assertSuccessful();
    $response->assertViewIs('songs.show');
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

it('orders songs by number and title', function () {
    Song::factory()->create(['title' => 'Zebra', 'number' => 1]);
    Song::factory()->create(['title' => 'Apple', 'number' => 1]);
    Song::factory()->create(['title' => 'Banana', 'number' => 2]);

    $response = get(route('songs.index'));

    $response->assertSuccessful();
    $content = $response->getContent();
    $posApple = strpos($content, 'Apple');
    $posZebra = strpos($content, 'Zebra');
    $posBanana = strpos($content, 'Banana');

    expect($posApple)->toBeLessThan($posZebra);
    expect($posZebra)->toBeLessThan($posBanana);
});

it('paginates songs', function () {
    Song::factory()->count(25)->create();

    $response = get(route('songs.index'));

    $response->assertSuccessful();
    $response->assertViewHas('songs', function ($songs) {
        return $songs->count() === 20; // First page should have 20 songs
    });
});

it('provides previous and next song links', function () {
    $song1 = Song::factory()->french()->create(['number' => 1]);
    $song2 = Song::factory()->french()->create(['number' => 2]);
    $song3 = Song::factory()->french()->create(['number' => 3]);

    $response = get(route('songs.show', $song2));

    $response->assertSuccessful();
    $response->assertViewHas('previousSong', function ($prev) use ($song1) {
        return $prev->id === $song1->id;
    });
    $response->assertViewHas('nextSong', function ($next) use ($song3) {
        return $next->id === $song3->id;
    });
});

it('handles first song with no previous', function () {
    $song1 = Song::factory()->french()->create(['number' => 1]);
    $song2 = Song::factory()->french()->create(['number' => 2]);

    $response = get(route('songs.show', $song1));

    $response->assertSuccessful();
    $response->assertViewHas('previousSong', null);
    $response->assertViewHas('nextSong', function ($next) use ($song2) {
        return $next->id === $song2->id;
    });
});

it('handles last song with no next', function () {
    $song1 = Song::factory()->french()->create(['number' => 1]);
    $song2 = Song::factory()->french()->create(['number' => 2]);

    $response = get(route('songs.show', $song2));

    $response->assertSuccessful();
    $response->assertViewHas('previousSong', function ($prev) use ($song1) {
        return $prev->id === $song1->id;
    });
    $response->assertViewHas('nextSong', null);
});
