<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Blog;

use App\Models\Post;
use Orchid\Screen\Screen;
use Orchid\Screen\Layout;
use App\Orchid\Layouts\Blog\BlogListLayout;
use Orchid\Screen\Actions\Button;

class BlogListScreen extends Screen
{

    public $name = 'Записи';

    public $description = 'Все записи';

    public function query(): array
    {
        return [
            'article_active' => Post::where('published', '1')->filters()->defaultSort('id', 'asc')->paginate(),
            'article_draft'  => Post::where('published', '0')->filters()->defaultSort('id', 'asc')->paginate()
        ];
    }

    public function commandBar(): array
    {
        return [
            Button::make('Добавить статью')
                ->icon('icon-plus')
                ->method('create'),
        ];
    }

    public function layout(): array
    {
        return [
            Layout::tabs([
                'Активные публикации' => BlogListLayout::class,
                'Черновики' => BlogListLayout::class,
            ])

        ];
    }
}
