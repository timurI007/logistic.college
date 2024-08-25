<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => [
                'ru' => fake()->sentence,
                'uz' => fake()->sentence,
                'en' => fake()->sentence,
            ],
            'slug' => Str::slug(fake()->sentence),
            'subtitle' => [
                'ru' => fake()->sentence,
                'uz' => fake()->sentence,
                'en' => fake()->sentence,
            ],
        ];
    }
}
