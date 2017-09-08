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
        $posts = Post::orderBy('updated_at','desc')->paginate($this->pagination);

        return view('posts.index', compact('posts', 'name', 'surname'));
    }

    public function show(Post $post)
    {


        return view('posts.show', compact('post'));

    }

    public function create()
    {

        return view('posts.create');

    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required|max:100',
            'body' => 'required'
        ]);

        $post = Post::create([
            'title' => $request->input('title'),
            'body' => $request->input('body')
        ]);

        return redirect('/posts');
    }
}
