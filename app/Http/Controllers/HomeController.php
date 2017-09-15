<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;

class HomeController extends Controller
{
    protected $pagination = 10;
    public function index()
    {
        $posts = Post::with('user')->orderBy('created_at', 'desc')->paginate($this->pagination);
        $categories = Category::latest()->get();
        return view('posts', compact('posts','categories','name','surname'));
    }
}
