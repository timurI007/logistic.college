<?php

declare(strict_types=1);

namespace App\MoonShine\Controllers;

use App\MoonShine\Controllers\BaseControllers\BaseCourseController;
use App\MoonShine\Pages\Courses\Chapters\ChapterDetailPage;
use MoonShine\Pages\Page;

final class ChapterController extends BaseCourseController
{
    public function detail(string $courseSlug, int $chapterId): Page
    {
        $course = $this->getCourseBySlug($courseSlug, ['id', 'slug', 'title']);
        $chapter = $this->getChapterByIdAndCourseId($chapterId, $course->id, ['id', 'title', 'subtitle', 'parent_id']);
        return ChapterDetailPage::make()
            ->setCourse($course)
            ->setChapter($chapter);
    }
}
