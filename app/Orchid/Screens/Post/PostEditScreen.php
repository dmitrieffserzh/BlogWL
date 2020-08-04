<?php

namespace App\Orchid\Screens\Post;

use Auth;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use App\Orchid\Layouts\Post\PostEditLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class PostEditScreen extends Screen
{

    public $name = 'Создать публикацию';

    public $description = 'Добавление новый публикации';

    public $exists = false;

    public function query(Post $post, Category $category): array
    {
        $this->exists = $post->exists;

        if ($this->exists) {
            $this->name = 'Редактирование публикации';
            $this->description = '';
        }

        $categories = $this->children(Category::get()->toTree());

        return [
            'post' => $post,
            'categories' => $categories
        ];
    }

    public function commandBar(): array
    {
        return [
            Button::make('Опубликовать')
                ->icon('icon-check')
                ->method('save'),

            Button::make('Отменить')
                ->icon('icon-close')
                ->method('cancel'),
        ];
    }

    public function layout(): array
    {
        return [
            PostEditLayout::class
        ];
    }

    public function save(Post $post, Request $request)
    {
        $post->fill($request->get('post'));
        isset($request['post']['published']) ? $post->published = 1 : $post->published = 0;
        $post->slug = Str::slug($request['post']['title']);
        $post->user_id = Auth::id();
        if ($post->save()) {
            Toast::info(__('Публикация успешно сохранена!'));
        }
        return redirect()->route('platform.posts');
    }


    public function children($categories, $prefix = '')
    {
        $result = [];
        if (isset($category->data))
            $categories = $categories->data;

        foreach ($categories as $category) {
            $category->title = $prefix . $category->title;
            if (isset($category->child) && count($category->child) > 0) {
                $elem = unserialize(serialize($category));
                unset($elem->child);
                array_push($result, $elem);
                $result = array_merge($result, $this->children($category->child, $prefix . '-'));
            } else {
                array_push($result, $category);
            }
        }
        return $result;
    }

    public function cancel()
    {
        return redirect()->route('platform.posts');
    }
}
