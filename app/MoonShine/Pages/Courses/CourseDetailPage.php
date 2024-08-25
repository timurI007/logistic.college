<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\Courses;

use App\Models\Course;
use MoonShine\Components\Card;
use MoonShine\Pages\Page;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Decorations\Column;
use MoonShine\Decorations\Grid;

class CourseDetailPage extends Page
{
    private Course $course;

    public function setCourse(Course $course): self
    {
        $this->course = $course;
        return $this;
    }
    
    public function breadcrumbs(): array
    {
        return [
            route('courses.index') => __('moonshine::ui.courses'),
            '#' => $this->title()
        ];
    }

    public function title(): string
    {
        return $this->course->title;
    }

    public function subtitle(): string
    {
        return $this->course->subtitle;
    }

    /**
     * @return list<MoonShineComponent>
     */
    public function components(): array
	{
        $columns = [];
        foreach ($this->course->chapters as $chapter) {
            $columns[] = Column::make([
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
		return [
            Grid::make($columns)
        ];
	}
}
