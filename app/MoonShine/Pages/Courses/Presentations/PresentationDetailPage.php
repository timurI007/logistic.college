<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\Courses\Presentations;

use MoonShine\Pages\Page;
use MoonShine\Components\MoonShineComponent;

class PresentationDetailPage extends Page
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
        return $this->title ?: 'PresentationDetailPage';
    }

    /**
     * @return list<MoonShineComponent>
     */
    public function components(): array
	{
		return [];
	}
}
