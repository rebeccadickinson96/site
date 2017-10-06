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


Route::get('/', 'HomeController@index');
Auth::routes();


Route::group(['middleware' => ['auth']], function () {

//posts
    Route::get('/posts/', 'PostController@index');
    Route::get('/posts/create', 'PostController@create');
    Route::post('posts/', 'PostController@store');
    Route::get('posts/{post}/edit', 'PostController@edit');
    Route::post('posts/{post}', 'PostController@update');
    Route::delete('posts/{post}', 'PostController@destroy');


//categories
    Route::get('/categories', 'CategoryController@index');
//    Route::get('/posts/category/{category}', 'CategoryController@index');
    Route::post('/categories', 'CategoryController@store');
    Route::post('categories/{category}', 'CategoryController@update');
});

Route::get('/posts/{post}', 'PostController@show');
Route::post('posts/{post}/comments', 'CommentController@store');