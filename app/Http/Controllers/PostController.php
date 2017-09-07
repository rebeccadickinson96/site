<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $pagination = 10;
    public function index()
    {
        $posts = Post::orderBy('title')->paginate($this->pagination);

        return view('posts.index', compact('posts','name','surname'));
    }

    public function show(Post $post){


        return view('posts.show', compact('post'));

    }
}
