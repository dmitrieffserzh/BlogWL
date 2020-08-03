<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Category;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class CategoryListLayout extends Table
{
    protected $target = 'categories';

    protected function columns(): array
    {

        return [
            TD::set('title', 'Заголовок')
                ->sort()
                ->render(function ($categories) {
                    return "<a href='' class='font-weight-bold'>{$categories['title']}</a>";
                }),
        ];
    }
}