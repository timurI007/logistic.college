<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\Chapters;

use App\Models\Chapter;
use App\Models\Course;
use MoonShine\Components\Link;
use MoonShine\Pages\Page;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Decorations\Block;

class ChapterDetailPage extends Page
{
    private Chapter $chapter;
    private Course $chosenCourse;

    public function setChapter(Chapter $chapter): self
    {
        $this->chapter = $chapter;
        return $this;
    }

    public function setCourse(Course $chosenCourse): self
    {
        $this->chosenCourse = $chosenCourse;
        return $this;
    }

    public function breadcrumbs(): array
    {
        // Begin
        $breadcrumbs = [
            route('courses.index') => __('moonshine::ui.courses'),
            route('courses.detail', ['slug' => $this->chosenCourse->slug]) => $this->chosenCourse->title
        ];

        // parent chapters
        if($this->chapter->parent_id){
            foreach ($this->chapter->parents() as $parent) {
                $url = route('chapters.detail', [
                    'slug' => $this->chosenCourse->slug,
                    'chapterId' => $parent->id
                ]);
                $breadcrumbs[$url] = $parent->title;
            }
        }

        // current chapter
        $breadcrumbs['#'] = $this->title();

        return $breadcrumbs;
    }

    public function title(): string
    {
        return $this->chapter->title;
    }

    public function subtitle(): string
    {
        return $this->chapter->subtitle;
    }

    /**
     * @return list<MoonShineComponent>
     */
    public function components(): array
	{
		return [
            Block::make('Presentations', [
                Link::make('#', 'Hello World')
                    ->icon('heroicons.outline.pencil')
                    ->button()
                    ->filled(),
                Link::make('#', 'Hello World')
                    ->icon('heroicons.outline.pencil')
                    ->button(),
            ])
        ];
	}
}
