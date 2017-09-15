<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\Category;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    protected $pagination = 10;

    public function index()
    {
        $posts = Post::latest()->paginate($this->pagination);

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

        Post::create([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'user_id' => Auth::id()

        ]);

        return redirect('/posts');
    }


}
