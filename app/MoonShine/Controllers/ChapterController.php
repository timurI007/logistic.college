<?php

declare(strict_types=1);

namespace App\MoonShine\Controllers;

use App\Models\Chapter;
use App\Models\Course;
use App\MoonShine\Pages\Chapters\ChapterDetailPage;
use MoonShine\Http\Controllers\MoonShineController;
use MoonShine\Pages\Page;

final class ChapterController extends MoonShineController
{
    public function detail(string $courseSlug, int $chapterId): Page
    {
        $course = Course::select('id', 'slug', 'title')
            ->where('slug', $courseSlug)
            ->firstOrFail();
        $chapter = Chapter::select('id', 'title', 'subtitle', 'parent_id')
            ->where('id', $chapterId)
            ->where('course_id', $course->id)
            ->firstOrFail();
        return ChapterDetailPage::make()
            ->setCourse($course)
            ->setChapter($chapter);
    }
}
