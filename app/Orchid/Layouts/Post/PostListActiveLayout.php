<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Post;

use App\Models\Post;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;


class PostListActiveLayout extends Table
{
    protected $target = 'post_active';

    protected function columns(): array
    {
        return [


            TD::set('image', 'Постер')
                ->width('150px')
                ->render(function (Post $post_active) {
                    $img_src = $post_active->image ? $post_active->image : 'no-photo.png';
                    return "<img src='{$img_src}' alt='{$post_active->title}' class='mw-100 d-block img-fluid'>";
                }),

            TD::set('title', 'Заголовок')
                ->sort()
                ->width('100%')
                ->render(function (Post $post_active) {
                    $route = route('platform.posts.edit', $post_active);
                    $title = e($post_active->title);
                    return "<a href='{$route}' class='font-weight-bold'>{$title}</a>";
                }),

            TD::set('created_at', 'Дата размещения')
                ->align(TD::ALIGN_CENTER)
                ->width('170px')
                ->sort()
                ->render(function (Post $post_active) {
                    return date("d.m.Y H:i:s", $post_active->created_at->timestamp);
                }),

            TD::set('action', '-')
                ->align(TD::ALIGN_CENTER)
                ->width('85px')
                ->sort()
                ->render(
                    function (Post $post_active) {
                        return DropDown::make()
                            ->icon('icon-options-vertical')
                            ->style('background: transparent;color: #0b82ff;')
                            ->list([

                                Link::make(__('Edit'))
                                    ->route('platform.posts.edit', $post_active->id)
                                    ->icon('icon-pencil'),

                                Button::make(__('Delete'))
                                    ->method('remove')
                                    ->confirm(__('Вы уверы, что хотите удалить публикацию?'))
                                    ->parameters([
                                        'id' => $post_active->id,
                                    ])
                                    ->icon('icon-trash')
                                    ->style('color: #df0031'),
                            ]);
                    })
        ];
    }
}