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
    Route::group(['middleware' => ['can:manage-own-posts']], function () {
        Route::get('/posts/', 'PostController@index');
        Route::group(['middleware' => ['can:manage-all-posts']], function () {
            Route::get('/posts/published', 'PostController@published');
            Route::get('/posts/scheduled', 'PostController@scheduled');
            Route::get('/posts/drafts', 'PostController@drafts');
        });
        Route::get('/posts/create', 'PostController@create');
        Route::post('posts/', 'PostController@store');
        Route::get('posts/{post}/edit', 'PostController@edit');
        Route::post('posts/{post}', 'PostController@update');
        Route::delete('posts/{post}', 'PostController@destroy');
        Route::post('posts/create/categories', 'PostController@addCategory');
    });

    Route::group(['middleware' => ['can:manage-categories']], function () {
        Route::get('/categories', 'CategoryController@index');
        Route::post('/categories', 'CategoryController@store');
        Route::post('categories/{category}', 'CategoryController@update');
        Route::group(['middleware' => ['can:delete-categories']], function () {
            Route::delete('categories/{category}/delete', 'CategoryController@destroy');
        });
    });

    Route::group(['middleware' => ['can:manage-users']], function () {
        Route::get('users', 'UserController@index');
    });

    Route::group(['middleware' => ['can:manage-reports']], function () {
        Route::get('reports', 'ReportController@indexPosts')->name('reports.post-index');
        Route::get('reports/{report}/review', 'ReportController@reviewPostReport')->name('reports.post-review');
    });

    Route::group(['middleware' => ['can:moderate-posts']], function () {
        Route::get('comments', 'CommentController@index')->name('comments.index');
        Route::post('comments/{comment}', 'CommentController@approve')->name('comments.approve');
    });
});


Route::get('/tags/uncategorized', 'PostController@uncategorized');
Route::get('/tags/{tag}', 'CategoryController@filterTag');

Route::get('/posts/{post}', 'PostController@show');
Route::post('posts/{post}/comments', 'CommentController@store');
Route::post('posts/{post}/report', 'PostController@reportPost')->name('posts.report');