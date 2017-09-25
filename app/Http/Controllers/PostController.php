<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\Category;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    protected $pagination = 10;

    public function index()
    {
        $posts = Post::with('User')->orderBy('date_published', 'desc')->paginate($this->pagination);

        return view('posts.index', compact('posts', 'name', 'surname'));
    }

    public function show(Post $post)
    {
        $categories = Category::latest()->get();

        return view('posts.show', compact('post', 'categories'));

    }

    public function create()
    {

        return view('posts.create');

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:100',
            'body' => 'required',
            'date_published' => 'required'
        ]);

        Post::create([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'user_id' => Auth::id(),
            'date_published' => Carbon::createFromFormat('d/m/Y H:i', $request->input('date_published'))

        ]);

        return redirect('/posts');
    }


}
