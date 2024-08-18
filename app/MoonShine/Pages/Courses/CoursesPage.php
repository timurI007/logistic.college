<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\Courses;

use App\Models\Course;
use MoonShine\Components\Card;
use MoonShine\Pages\Page;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Decorations\Column;
use MoonShine\Decorations\Grid;
use MoonShine\Fields\Text;

class CoursesPage extends Page
{
    /**
     * @return array<string, string>
     */
    public function breadcrumbs(): array
    {
        return [
            '#' => $this->title()
        ];
    }

    public function title(): string
    {
        return $this->title ?: 'CoursesPage';
    }

    /**
     * @return list<MoonShineComponent>
     */
    public function components(): array
	{
        $courses = Course::select('id', 'title', 'subtitle')->get();
        $columns = [];
        foreach ($courses as $course) {
            $columns[] = Column::make([
                Card::make(
                    title: $course->title,
                    thumbnail: '/images/image_1.jpg',
                    url: fn() => 'https://cutcode.dev',
                    subtitle: date('d.m.Y')
                )
            ])
                ->columnSpan(4);
        }
		return [
            Grid::make($columns)
        ];
	}
}
