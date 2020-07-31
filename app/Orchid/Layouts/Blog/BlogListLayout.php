<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Blog;

use App\Models\Post;
use Orchid\Platform\Models\User;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Layouts\Persona;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class BlogListLayout extends Table
{
    protected $target = 'article_active';

    protected function columns(): array
{
    return [
        TD::set('image', '')
            ->width(150)
            ->render(function (Post $article) {
                $img_src = $article->image ? $article->image: 'no-photo.png';
                return "<img src='{$img_src}' alt='{$article->title}' class='mw-100 d-block img-fluid border'>";
            }),

        TD::set('title', 'Заголовок')
            ->sort()
            ->render(function (Post $article) {
                $route = route('platform.blogs.edit', $article);
                $title = e($article->title);
                return "<a href='{$route}' class='font-weight-bold'>{$title}</a>";
            }),

        TD::set('created_at', 'Дата размещения')
            ->align(TD::ALIGN_CENTER)
            ->width('170px')
            ->sort()
            ->render(function (Post $article) {
                return date("d.m.Y H:i:s", $article->created_at->timestamp) ;
            }),

        TD::set('created_at', '')
            ->align(TD::ALIGN_CENTER)
            ->width('85px')
            ->sort()
            ->render(function (Post $article) {
                $route = route('platform.blogs.edit', $article);
                return "<a href='{$route}' class='d-inline-block text-primary p-2'><i class='icon-pencil'></i></a><a href='{$route}' class='text-danger p-2'><i class='icon-trash'></i></a>";

            })


    ];
}
}