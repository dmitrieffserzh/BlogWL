<?php

namespace App\Orchid\Screens\Blog;

use Orchid\Screen\Screen;

class BlogEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'BlogEditScreen';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'BlogEditScreen';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [];
    }

    /**
     * Button commands.
     *
     * @return Action[]
     */
    public function commandBar(): array
    {
        return [];
    }

    /**
     * Views.
     *
     * @return Layout[]
     */
    public function layout(): array
    {
        return [];
    }
}
