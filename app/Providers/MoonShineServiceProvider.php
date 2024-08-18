<?php

declare(strict_types=1);

namespace App\Providers;

use App\MoonShine\Pages\Courses\CoursesPage;
use MoonShine\Providers\MoonShineApplicationServiceProvider;
use MoonShine\Menu\MenuItem;
use App\MoonShine\Resources\UserResource;
use MoonShine\Contracts\Resources\ResourceContract;
use MoonShine\Menu\MenuElement;
use MoonShine\Pages\Page;
use MoonShine\Menu\MenuDivider;
use Closure;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    /**
     * @return list<ResourceContract>
     */
    protected function resources(): array
    {
        return [];
    }

    /**
     * @return list<Page>
     */
    protected function pages(): array
    {
        return [];
    }

    /**
     * @return Closure|list<MenuElement>
     */
    protected function menu(): array
    {
        return [
            MenuItem::make(
                static fn() => __('moonshine::ui.dashboard'),
                fn () => route('moonshine.index')
            )->icon('heroicons.outline.squares-2x2'),

            MenuDivider::make(static fn() => __('moonshine::ui.main')),

            MenuItem::make(
                static fn() => __('moonshine::ui.courses'),
                new CoursesPage()
            )->icon('heroicons.outline.book-open'),
            MenuItem::make(
                static fn() => __('moonshine::ui.homework'),
                new UserResource()
            )->icon('heroicons.outline.clipboard-document-check'),

            MenuDivider::make(static fn() => __('moonshine::ui.educational_resources')),

            MenuItem::make(
                static fn() => __('moonshine::ui.tests'),
                new UserResource()
            )->icon('heroicons.outline.document-text'),
            MenuItem::make(
                static fn() => __('moonshine::ui.materials'),
                new UserResource()
            )->icon('heroicons.outline.bookmark'),
            MenuItem::make(
                static fn() => __('moonshine::ui.dictionary'),
                new UserResource()
            )->icon('heroicons.outline.list-bullet'),

            MenuDivider::make(static fn() => __('moonshine::ui.interaction')),

            MenuItem::make(
                static fn() => __('moonshine::ui.events'),
                new UserResource()
            )->icon('heroicons.outline.rocket-launch'),
            MenuItem::make(
                static fn() => __('moonshine::ui.forums'),
                new UserResource()
            )->icon('heroicons.outline.chat-bubble-left-right'),
            MenuItem::make(
                static fn() => __('moonshine::ui.support'),
                new UserResource()
            )->icon('heroicons.outline.question-mark-circle'),
        ];
    }

    /**
     * @return Closure|array{css: string, colors: array, darkColors: array}
     */
    protected function theme(): array
    {
        return [
            'colors' => [
                'primary' => '#54a8c7',
                'secondary' => '#54a8c7',
                'menu-hover-color' => '#54a8c7',
                'menu-active-bg' => '#54a8c7'
                // 'menu-dropdown-bg' => '#C0C0C0',
                // 'menu-link-color' => '#000',
            ]
        ];
    }
}
