<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Event;
use Illuminate\Http\Request;

class MainController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index()
    {

        $news = Post::latest()->paginate(20);

        Category::fixTree();

        return view('main.posts.index', [
            //'categories' => $news,
            'posts' => $news,
            'tree' => $tree = Category::get()->toTree()
        ]);
    }
}