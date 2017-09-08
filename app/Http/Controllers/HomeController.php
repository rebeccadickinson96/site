<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    protected $pagination = 10;
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate($this->pagination);
        $categories = Category::orderBy('category','desc')->get();
        return view('posts', compact('posts','categories','name','surname'));
    }
}
