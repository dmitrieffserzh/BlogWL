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
        $cat = Category::with('child')->where('parent_id', '0')->paginate(15);

        $res = $this->children($cat);
        return [
            'categories' => $res
            //'delimiter'  => ''
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

    public function children($category, $prefix = '')
    {

        //dd($category);
        $gg = [];
        if (isset($category->data))
            $category = $category->data;

        foreach ($category as $cat) {
            $cat->title = $prefix . $cat->title;
            if (isset($cat->child) && count($cat->child) > 0) {
                $elem = unserialize(serialize($cat));
                unset($elem->child);
                array_push($gg, $elem);
                $gg = array_merge($gg, $this->children($cat->child, $prefix . '<span style="color:#79849e;"> &bull; </span>'));
            } else {
                array_push($gg, $cat);
            }
        }
        return $gg;
    }

}
