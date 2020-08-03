<?php

namespace App\Orchid\Screens\Post;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use App\Orchid\Layouts\Post\PostEditLayout;
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

        $categories = $this->children($category->with('child')->where('parent_id', 0)->get());

        return [
            'post' => $post,
            'post.category' => $categories
        ];
    }

    /**
     * Button commands.
     *
     * @return Action[]
     */
    public function commandBar(): array
    {
        return [
            Button::make('Опубликовать')
                ->icon('icon-check')
                ->method('create'),

            Button::make('Отменить')
                ->icon('icon-close')
                ->method('create'),
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
        $request->validate([
            'role.slug' => 'required|unique:roles,slug,' . $post->id,
        ]);

        $post->fill($request->get('post'));

        $post->save();

        Toast::info(__('Role was saved'));

        return redirect()->route('platform.systems.roles');
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
                $result = array_merge($result, $this->children($category->child, $prefix . '<span style="color:#79849e;"> &bull; </span>'));
            } else {
                array_push($result, $category);
            }
        }
        return $result;
    }
}
