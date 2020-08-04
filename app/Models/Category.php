<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{

    use Filterable;
    use AsSource;
    use NodeTrait;

    public $fillable = [
        'parent_id',
        'title',
        'slug'
    ];

    public $timestamps = false;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // RELATIONS
    public function posts()
    {
        return $this->hasMany(Post::class, 'category_id');
    }

    public function child()
    {
        return $this->hasMany(self::class, 'parent_id');
    }
}