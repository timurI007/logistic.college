<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Chapter>
 */
class ChapterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'course_id' => Course::factory(),
            'parent_id' => null,
            'title' => [
                'ru' => fake()->sentence,
                'uz' => fake()->sentence,
                'en' => fake()->sentence,
            ],
            'subtitle' => [
                'ru' => fake()->sentence,
                'uz' => fake()->sentence,
                'en' => fake()->sentence,
            ],
        ];
    }
}
