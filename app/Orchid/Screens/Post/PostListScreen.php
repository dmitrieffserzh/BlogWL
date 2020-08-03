<?php

namespace App\Orchid\Screens\Post;


use App\Models\Post;
use App\Orchid\Layouts\Post\PostListActiveLayout;
use App\Orchid\Layouts\Post\PostListArchiveLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;


class PostListScreen extends Screen
{
    public $name = 'Публикации';

    public $description = 'Все публикации';

    public function query(): array
    {
        return [
            'post_active' => Post::where('published', '1')->filters()->defaultSort('created_at', 'asc')->paginate(),
            'post_archive' => Post::where('published', '0')->filters()->defaultSort('created_at', 'asc')->paginate()
        ];
    }

    public function commandBar(): array
    {
        return [
            Button::make('Добавить')
                ->icon('icon-plus')
                ->method('create')->class('btn btn-primary'),
        ];
    }

    /**
     * Views.
     *
     * @return Layout[]
     */
    public function layout(): array
    {
        return [
            Layout::tabs([
                'Активные публикации' => PostListActiveLayout::class,
                'Черновики' => PostListArchiveLayout::class,
            ])
        ];
    }

    public function remove(Request $request)
    {
        Post::findOrFail($request->get('id'))
            ->delete();

        Toast::info(__('Публикация успешно удалена!'));

        return back();
    }
}
