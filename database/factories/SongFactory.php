<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Song>
 */
class SongFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number' => fake()->numberBetween(1, 500),
            'title' => fake()->sentence(4),
            'type' => fake()->randomElement([1, 2]),
            'content' => fake()->paragraphs(3, true),
            'author' => fake()->name(),
        ];
    }

    /**
     * Indicate that the song is French.
     */
    public function french(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 2,
        ]);
    }

    /**
     * Indicate that the song is Swahili.
     */
    public function swahili(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 1,
        ]);
    }
}
