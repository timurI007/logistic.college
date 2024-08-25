<?php

namespace Database\Seeders;

use App\Models\Chapter;
use App\Models\Course;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Course::factory(5)->create()->each(function ($course) {
            $chapters = Chapter::factory(10)->create(['course_id' => $course->id]);

            $chapters->each(function ($chapter) use ($course) {
                $chapters2 = Chapter::factory(2)->create([
                    'course_id' => $course->id,
                    'parent_id' => $chapter->id,
                ]);

                $chapters2->each(function ($chapter2) use ($course) {
                    Chapter::factory(1)->create([
                        'course_id' => $course->id,
                        'parent_id' => $chapter2->id,
                    ]);
                });
            });
        });
    }
}
