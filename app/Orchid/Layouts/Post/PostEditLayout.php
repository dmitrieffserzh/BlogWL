<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Post;

use App\Models\Category;
use App\Models\Post;
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
                Select::make('post.category_id.$categories')
                    ->options($this->getCategory())
                    ->value($this->query["post"]['category_id'])
                    ->required()
                    ->title(__('Категория'))
                    ->style('max-width: 100% !important'),
                Relation::make('post.tags')
                    ->fromModel(Role::class, 'name')
                    ->multiple()
                    ->title('Теги'),
                Switcher::make('post.published')
                    ->value(1)
                    ->placeholder('Опубликовать на сайте')
                    ->title('Видимость')
                    ->help('или сохранить в черновик')
            ])->fullWidth(),

            Cropper::make('post.picture')
                ->title(__('Постер'))
                ->width(900)
                ->height(350)
                ->targetRelativeUrl(),

            Quill::make('post.content')->height('500px'),

            Group::make([
                Button::make('Опубликовать')->type(Color::PRIMARY())->icon('icon-check'),
                Button::make('Отменить')->type(Color::DEFAULT())->icon('icon-close')
            ])->autoWidth()
        ];
    }


    public function getChildrenCategory($categories, $prefix = '')
    {
        $result = [];
        if (isset($category->data))
            $categories = $categories->data;

        foreach ($categories as $category) {
            $category->title = $prefix . ' ' . $category->title;
            if (isset($category->child) && count($category->child) > 0) {
                $elem = unserialize(serialize($category));
                unset($elem->child);
                array_push($result, $elem);
                $result = array_merge($result, $this->getChildrenCategory($category->child, $prefix . '-'));
            } else {
                array_push($result, $category);
            }
        }
        return $result;
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

    function getCategory()
    {
        $categories = Category::with('child')->where('parent_id', '0')->get();
        $result = $this->getChildrenCategory($categories);
        $result = $this->getOptionCategory($result);
        return (object)$result;
    }
}
