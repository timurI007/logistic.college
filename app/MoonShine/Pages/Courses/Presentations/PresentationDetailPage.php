<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\Courses\Presentations;

use App\Models\Chapter;
use App\Models\Course;
use App\Models\Presentation;
use MoonShine\Pages\Page;
use MoonShine\Components\MoonShineComponent;

class PresentationDetailPage extends Page
{
    private Presentation $presentation;
    private Chapter $chapter;
    private Course $course;

    public function setPresentation (Presentation $presentation): self
    {
        $this->presentation = $presentation;
        return $this;
    }

    public function setChapter (Chapter $chapter): self
    {
        $this->chapter = $chapter;
        return $this;
    }

    public function setCourse (Course $course): self
    {
        $this->course = $course;
        return $this;
    }
    
    /**
     * @return array<string, string>
     */
    public function breadcrumbs(): array
    {
        // Begin
        $breadcrumbs = [
            route('courses.index') => __('moonshine::ui.courses'),
            route('courses.detail', ['slug' => $this->course->slug]) => $this->course->title
        ];

        // parent chapters
        if($this->chapter->parent_id){
            foreach ($this->chapter->parents() as $parent) {
                $url = route('chapters.detail', [
                    'slug' => $this->course->slug,
                    'chapterId' => $parent->id
                ]);
                $breadcrumbs[$url] = $parent->title;
            }
        }

        // current chapter
        $url = route('chapters.detail', [
            'slug' => $this->course->slug,
            'chapterId' => $this->chapter->id
        ]);
        $breadcrumbs[$url] = $this->chapter->title;

        // current presentation
        $breadcrumbs['#'] = $this->title();

        return $breadcrumbs;
    }

    public function title(): string
    {
        return $this->presentation->title;
    }

    /**
     * @return list<MoonShineComponent>
     */
    public function components(): array
	{
		return [];
	}
}
