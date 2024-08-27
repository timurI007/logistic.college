<?php

declare(strict_types=1);

namespace App\MoonShine\Controllers;

use App\Models\Chapter;
use App\Models\Course;
use App\Models\Presentation;
use App\MoonShine\Pages\Courses\Presentations\PresentationDetailPage;
use MoonShine\Http\Controllers\MoonShineController;
use MoonShine\Pages\Page;

final class PresentationController extends MoonShineController
{
    public function detail(string $courseSlug, int $chapterId, int $presentationId): Page
    {
        $course = Course::select('id', 'slug', 'title')
            ->where('slug', $courseSlug)
            ->firstOrFail();
        $chapter = Chapter::select('id', 'title', 'subtitle', 'parent_id')
            ->where('id', $chapterId)
            ->where('course_id', $course->id)
            ->firstOrFail();
        $presentation = Presentation::select('id')
            ->where('id', $presentationId)
            ->where('chapter_id', $chapter->id)
            ->firstOrFail();
        return PresentationDetailPage::make();
    }
}
