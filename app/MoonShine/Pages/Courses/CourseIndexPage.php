<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\Courses;

use Illuminate\Database\Eloquent\Collection;
use MoonShine\Components\Card;
use MoonShine\Pages\Page;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Decorations\Column;
use MoonShine\Decorations\Grid;

class CourseIndexPage extends Page
{
    protected Collection $courses;

    public function setCourses(Collection $courses): self
    {
        $this->courses = $courses;
        return $this;
    }

    public function breadcrumbs(): array
    {
        return [
            '#' => $this->title()
        ];
    }

    public function title(): string
    {
        return __('moonshine::ui.courses');
    }

    public function subtitle(): string
    {
        return __('moonshine::ui.courses_subtitle');
    }

    /**
     * @return list<MoonShineComponent>
     */
    public function components(): array
	{
        $columns = [];
        foreach ($this->courses as $course) {
            $columns[] = Column::make([
                Card::make(
                    title: $course->title,
                    thumbnail: '/images/image_1.jpg',
                    url: fn() => route('courses.detail', ['slug' => $course->slug]),
                    subtitle: $course->subtitle
                )
            ])->columnSpan(4);
        }
		return [
            Grid::make($columns)
        ];
	}
}
