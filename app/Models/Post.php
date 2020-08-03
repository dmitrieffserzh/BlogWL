<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;

class Post extends Model
{
    use Filterable;
    use AsSource;

    protected $allowedFilters = [
        'id',
        'title',
        'published',
        'created_at',
        'deleted_at',
    ];

    protected $allowedSorts = [
        'id',
        'title',
        'published',
        'created_at',
        'deleted_at',
    ];

    public $fillable = [
        'title',
        'content',
        'author_id',
        'slug',
        'image',
        'category_id',
        'published',
        'created_at',
        'updated_at'
    ];
    public $dates = [
        'created_at',
        'updated_at'
    ];

}
