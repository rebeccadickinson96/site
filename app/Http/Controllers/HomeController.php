<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class HomeController extends Controller
{
    protected $pagination = 10;
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate($this->pagination);

        return view('posts', compact('posts','name','surname'));
    }
}
