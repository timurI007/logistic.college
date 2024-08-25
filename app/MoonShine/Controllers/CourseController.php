<?php

declare(strict_types=1);

namespace App\MoonShine\Controllers;

use App\Models\Course;
use App\MoonShine\Pages\Courses\CourseIndexPage;
use App\MoonShine\Pages\Courses\CourseDetailPage;
use MoonShine\Http\Controllers\MoonShineController;
use MoonShine\Pages\Page;

final class CourseController extends MoonShineController
{
    public function index(): Page
    {
        $courses = Course::select('title', 'subtitle', 'slug', 'image')->get();
        return CourseIndexPage::make()->setCourses($courses);
    }

    public function detail(string $slug): Page
    {
        $course = Course::select('id', 'title', 'subtitle', 'image', 'slug')
            ->with(['chapters' => function ($query) {
                $query->select('id', 'course_id', 'title', 'subtitle')
                    ->whereNull('parent_id');
            }])
            ->where('slug', $slug)
            ->firstOrFail();
        return CourseDetailPage::make()->setCourse($course);
    }
}
