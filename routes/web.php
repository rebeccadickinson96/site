<?php

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

Auth::routes();
Route::get('/', 'HomeController@index');

Route::get('/posts/{post}', 'PostController@show');

Route::group(['middleware' => ['auth']], function () {
//posts
    Route::get('/posts/', 'PostController@index');
    Route::get('/posts/create', 'PostController@create');
    Route::post('posts/', 'PostController@store');
    Route::post('posts/{post}/comments', 'CommentController@store');


//categories
    Route::get('/categories', 'CategoryController@index');
    Route::get('/posts/category/{category}', 'CategoryController@index');
});
