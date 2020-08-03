<?php
declare(strict_types=1);

namespace App\Orchid\Screens\Category;

use App\Models\Category;
use App\Orchid\Layouts\Category\CategoryListLayout;
use Orchid\Screen\Screen;
use phpDocumentor\Reflection\Types\Collection;

class CategoryListScreen extends Screen
{
    public $name = 'Категории';

    public $description = 'Список категорий';

    public $arr = [];

    public function query(): array
    {
        $categories = Category::with('child')->where('parent_id', '0')->paginate(15);

        $result = $this->children($categories);
        return [
            'categories' => $result
        ];
    }

    public function commandBar(): array
    {
        return [];
    }

    public function layout(): array
    {
        return [
            CategoryListLayout::class
        ];
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
