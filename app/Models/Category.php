<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Category extends Model {

    use Filterable;
    use AsSource;

    public $fillable = [
        'parent_id',
        'title',
        'slug',
        'created_at',
        'updated_at'
    ];

    public $dates = [
        'created_at',
        'updated_at'
    ];

    public function getRouteKeyName() {
        return 'slug';
    }

    // RELATIONS
    public function posts() {
        return $this->hasMany(Post::class, 'category_id');
    }

    public function child() {
        return $this->hasMany(self::class, 'parent_id');
    }
}