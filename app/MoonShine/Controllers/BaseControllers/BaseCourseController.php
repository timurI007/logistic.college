<?php

declare(strict_types=1);

namespace App\MoonShine\Controllers\BaseControllers;

use App\Models\Chapter;
use App\Models\Course;
use App\Models\Presentation;
use MoonShine\Http\Controllers\MoonShineController;

abstract class BaseCourseController extends MoonShineController
{
    protected function getCourseBySlug(string $slug, array $fields = ['*']): Course
    {
        return Course::select($fields)
            ->where('slug', $slug)
            ->firstOrFail();
    }

    protected function getChapterByIdAndCourseId(int $chapterId, int $courseId, array $fields = ['*']): Chapter
    {
        return Chapter::select($fields)
            ->where('id', $chapterId)
            ->where('course_id', $courseId)
            ->firstOrFail();
    }

    protected function getPresentationByIdAndChapterId(int $presentationId, int $chapterId, array $fields = ['*']): Presentation
    {
        return Presentation::select($fields)
            ->where('id', $presentationId)
            ->where('chapter_id', $chapterId)
            ->firstOrFail();
    }
}