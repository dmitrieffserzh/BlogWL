<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', 'MainController@index')->name('main');

// POSTS
Route::group([
    'prefix' => 'blog',
    /*'middleware' => 'filter.view.counts'*/], function() {
    Route::get('/',                             [ 'as' => 'blog',                         'uses' => 'PostController@index' ]);
    Route::get('/{route}',                      [ 'as' => 'blog.url',                     'uses' => 'PostController@getURL' ])->where('route', '(.+)');
});