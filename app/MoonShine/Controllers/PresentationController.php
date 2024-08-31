<?php

declare(strict_types=1);

namespace App\MoonShine\Controllers;

use App\MoonShine\Controllers\BaseControllers\BaseCourseController;
use App\MoonShine\Pages\Courses\Presentations\PresentationDetailPage;
use MoonShine\Pages\Page;

final class PresentationController extends BaseCourseController
{
    public function detail(string $courseSlug, int $chapterId, int $presentationId): Page
    {
        $course = $this->getCourseBySlug($courseSlug, ['id', 'slug', 'title']);
        $chapter = $this->getChapterByIdAndCourseId($chapterId, $course->id, ['id', 'title', 'subtitle', 'parent_id']);
        $presentation = $this->getPresentationByIdAndChapterId($presentationId, $chapter->id, ['id', 'title']);
        return PresentationDetailPage::make($course, $chapter, $presentation);
    }
}
