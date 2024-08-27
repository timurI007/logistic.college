<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\Courses\Chapters;

use App\Models\Chapter;
use App\Models\Course;
use MoonShine\Components\Card;
use MoonShine\Components\Link;
use MoonShine\Pages\Page;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Column;
use MoonShine\Decorations\Grid;

class ChapterDetailPage extends Page
{
    private Chapter $chapter;
    private Course $course;

    public function setChapter(Chapter $chapter): self
    {
        $this->chapter = $chapter;
        return $this;
    }

    public function setCourse(Course $course): self
    {
        $this->course = $course;
        return $this;
    }

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
        $children = $this->chapter->children()->select('id', 'title', 'subtitle')->get();
        $presentations = $this->chapter->presentations()->select('id')->get();
        $presentationLinks = [];
        $chapterColumns = [];

        // Generating presentations
        if ($presentations) {
            $number = 1;
            foreach ($presentations as $presentation) {
                $url = route('presentations.detail', [
                    'slug' => $this->course->slug,
                    'chapterId' => $this->chapter->id,
                    'presentationId' => $presentation->id
                ]);
                $presentationLinks[] = Link::make($url, __('moonshine::ui.presentation_number', [
                    'number' => $number
                ]))
                    ->icon('heroicons.outline.presentation-chart-bar')
                    ->button()
                    ->filled();
                $number++;
            }
        }

        // Generating children chapters
        if ($children) {
            foreach ($children as $chapter) {
                $chapterColumns[] = Column::make([
                    Card::make(
                        title: $chapter->title,
                        thumbnail: '/images/image_1.jpg',
                        url: fn() => route('chapters.detail', [
                            'slug' => $this->course->slug,
                            'chapterId' => $chapter->id
                        ]),
                        subtitle: $chapter->subtitle
                    )
                ])->columnSpan(12);
            }
        }

        // Decorations
        $columns = [];
        if ($presentationLinks) {
            $columns[] = Column::make([
                Block::make(__('moonshine::ui.presentations'), $presentationLinks)
            ])->columnSpan(12);
        }
        if ($chapterColumns) {
            $columns = array_merge($columns, $chapterColumns);
        }
        
		return [
            Grid::make($columns)
        ];
	}
}
