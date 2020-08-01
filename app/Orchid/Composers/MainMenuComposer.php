<?php

declare(strict_types=1);

namespace App\Orchid\Composers;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemMenu;
use Orchid\Platform\Menu;

class MainMenuComposer
{

    private $dashboard;

    public function __construct(Dashboard $dashboard)
    {
        $this->dashboard = $dashboard;
    }

    public function compose()
    {
        // Profile
        $this->dashboard->menu
            ->add(Menu::PROFILE,
                ItemMenu::label('Action')
                    ->icon('icon-compass')
                    ->badge(function () {
                        return 6;
                    })
            )
            ->add(Menu::PROFILE,
                ItemMenu::label('Another action')
                    ->icon('icon-heart')
            );

        // Main
        $this->dashboard->menu
            ->add(Menu::MAIN,
                ItemMenu::label('Главная')
                    ->icon('icon-home')
                    ->route('platform.main')
            )
            ->add(Menu::MAIN,
                ItemMenu::label('Публикации')
                    ->route('platform.posts')
                    ->icon('icon-docs')
                    ->title('Блог')
            )
            ->add(Menu::MAIN,
                ItemMenu::label('Категории')
                    ->route('platform.example')
                    ->icon('icon-folder')
            )
            ->add(Menu::MAIN,
                ItemMenu::label('Теги')
                    ->route('platform.example')
                    ->icon('icon-tag')
            )
            ->add(Menu::MAIN,
                ItemMenu::label('Страницы')
                    ->icon('icon-layers')
                    ->route('platform.example')
                    ->title('')
            )
            ->add(Menu::MAIN,
                ItemMenu::label('Все пользователи')
                    ->icon('icon-user')
                    ->route('platform.systems.users')
                    ->title('Пользователи')
            )
            ->add(Menu::MAIN,
                ItemMenu::label('Группы пользователей')
                    ->icon('icon-lock')
                    ->route('platform.systems.roles')
            )
            ->add(Menu::MAIN,
                ItemMenu::label('Настройки')
                    ->icon('icon-settings')
                    ->route('platform.systems.index')
                    ->title('Система')
            )
            ->add(Menu::MAIN,
                ItemMenu::label('Документация')
                    ->icon('icon-doc')
                    ->url('https://orchid.software/en/docs')
            )

            ->add(Menu::MAIN,
                ItemMenu::label('Example screen')
                    ->icon('icon-monitor')
                    ->route('platform.example')
                    ->title('Navigation')
            )
            ->add(Menu::MAIN,
                ItemMenu::label('Dropdown menu')
                    ->slug('example-menu')
                    ->icon('icon-code')
                    ->childs()
            )
            ->add('example-menu',
                ItemMenu::label('Sub element item 1')
                    ->icon('icon-bag')
            )
            ->add('example-menu',
                ItemMenu::label('Sub element item 2')
                    ->icon('icon-heart')
            )
            ->add(Menu::MAIN,
                ItemMenu::label('Basic Elements')
                    ->title('Form controls')
                    ->icon('icon-note')
                    ->route('platform.example.fields')
            )
            ->add(Menu::MAIN,
                ItemMenu::label('Advanced Elements')
                    ->icon('icon-briefcase')
                    ->route('platform.example.advanced')
            )
            ->add(Menu::MAIN,
                ItemMenu::label('Text Editors')
                    ->icon('icon-list')
                    ->route('platform.example.editors')
            )
            ->add(Menu::MAIN,
                ItemMenu::label('Overview layouts')
                    ->title('Layouts')
                    ->icon('icon-layers')
                    ->route('platform.example.layouts')
            )
            ->add(Menu::MAIN,
                ItemMenu::label('Chart tools')
                    ->icon('icon-bar-chart')
                    ->route('platform.example.charts')
            )
            ->add(Menu::MAIN,
                ItemMenu::label('Cards')
                    ->icon('icon-grid')
                    ->route('platform.example.cards')
            );
    }
}
