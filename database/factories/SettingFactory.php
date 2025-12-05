<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Setting>
 */
class SettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'session_id' => fake()->uuid(),
            'song_id' => null,
            'font_size' => fake()->randomElement([50, 60, 70, 80, 90, 100]),
            'night_mode' => fake()->boolean(),
        ];
    }

    /**
     * Indicate that the setting is for a specific song
     */
    public function forSong(): static
    {
        return $this->state(fn (array $attributes) => [
            'song_id' => \App\Models\Song::factory(),
        ]);
    }

    /**
     * Indicate that night mode is enabled
     */
    public function nightModeEnabled(): static
    {
        return $this->state(fn (array $attributes) => [
            'night_mode' => true,
        ]);
    }

    /**
     * Indicate that night mode is disabled
     */
    public function nightModeDisabled(): static
    {
        return $this->state(fn (array $attributes) => [
            'night_mode' => false,
        ]);
    }
}
