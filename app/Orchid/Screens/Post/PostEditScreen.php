<?php

namespace App\Orchid\Screens\Post;

use App\Models\Post;
use Illuminate\Http\Request;
use Orchid\Platform\Models\Role;
use Orchid\Screen\Actions\Button;
use App\Orchid\Layouts\Post\PostEditLayout;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class PostEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Создать публикацию';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Добавление новый публикации';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Post $post): array
    {
        return [
            'post'       => $post,
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
            'role.slug' => 'required|unique:roles,slug,'.$post->id,
        ]);

        $post->fill($request->get('post'));

        $post->save();

        Toast::info(__('Role was saved'));

        return redirect()->route('platform.systems.roles');
    }
}
