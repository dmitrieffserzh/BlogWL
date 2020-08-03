<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Post;

use Orchid\Platform\Models\Role;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Layouts\Rows;
use Orchid\Support\Color;

class PostEditLayout extends Rows
{

    public function fields(): array
    {

        return [
            Input::make('post.title')->size('100')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Заголовок'))
                ->placeholder(__(''))
                ->style('max-width: 100%'),

            Group::make([
                Select::make('post.category_id')
                    ->options($this->getOptionCategory($this->query['categories']))
                    ->value($this->query['post']['category_id'])
                    ->required()
                    ->title(__('Категория'))
                    ->style('max-width: 100% !important'),
                Relation::make('post.tags')
                    ->fromModel(Role::class, 'name')
                    ->multiple()
                    ->title('Теги'),
                Switcher::make('post.published')
                    ->value($this->query['post']['published'])
                    ->placeholder('Опубликовать на сайте')
                    ->title('Видимость')
                    ->help('или сохранить в черновик')
            ])->fullWidth(),

            Cropper::make('post.image')
                ->title(__('Постер'))
                ->maxFileSize(2)
                ->width(900)
                ->height(350)
                ->targetUrl(),

            Quill::make('post.content')->height('500px'),

            Group::make([
                Button::make('Опубликовать')->type(Color::PRIMARY())->icon('icon-check')->method('save'),
                Button::make('Отменить')->type(Color::DEFAULT())->icon('icon-close')
            ])->autoWidth()
        ];
    }

    public function getOptionCategory($categories)
    {
        $options = [];
        foreach ($categories as $category) {
            $value = [(string)$category->id => $category->title];
            $options = array_merge($options, $value);
        }
        return $options;
    }
}
