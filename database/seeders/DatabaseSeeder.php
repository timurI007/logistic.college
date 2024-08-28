<?php

namespace Database\Seeders;

use App\Models\Chapter;
use App\Models\Course;
use App\Models\Presentation;
use App\Models\Slide;
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
            $chapters = Chapter::factory(12)->create(['course_id' => $course->id]);

            $chapters->each(function ($chapter) {

                $presentations = Presentation::factory()->count(2)->create(['chapter_id' => $chapter->id]);
                
                $presentations->each(function ($presentation) {
                    Slide::factory()->count(5)->create(['presentation_id' => $presentation->id]);
                });
            });
        });
    }
}
