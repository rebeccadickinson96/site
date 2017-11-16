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

    public function uncategorized(){
        $posts = Post::with('User')->uncategorized()->paginate($this->pagination);
        return view('posts', compact('posts'));
    }

    public function show(Post $post)
    {
        $categories = Category::latest()->get();

        return view('posts.show', compact('post', 'categories'));

    }

    public function create()
    {
        $categories = Category::latest()->get();
        return view('posts.create', compact('categories'));

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:100',
            'body' => 'required',
            'date_published' => 'required',
            'published' => 'required'
        ]);

        $post = Post::create([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'user_id' => Auth::id(),
            'date_published' => Carbon::createFromFormat('d/m/Y H:i', $request->input('date_published')),
            'published' => $request->input('published')

        ]);
         $post->addCategories($request->input('categories'));
        return redirect('/posts')->with(['success' => 'Successfully created ' . $post->title]);
    }

    public function edit(Post $post)
    {
        $categories= Category::latest()->get();
        return view('posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $this->validate($request, [
            'title' => 'required|max:100',
            'body' => 'required',
            'date_published' => 'required',
            'published' => 'required'
        ]);

        $post->update([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'user_id' => Auth::id(),
            'date_published' => Carbon::createFromFormat('d/m/Y H:i', $request->input('date_published')),
            'published' => $request->input('published')

        ]);
        $post->addCategories($request->input('categories'));
        return redirect('/posts/' . $post->id);
    }

    public function addCategory(Request $request){
        $this->validate($request, [
            'category' => 'required|unique:categories,category',
        ]);

        $category = Category::create([
            'category' => $request->input('category'),
        ]);


        return json_encode(['id' => $category->id, 'category' => $category->category]);
    }

    public function destroy(Post $post)
    {
        $title = $post->title;
        $post->delete();

        return redirect()->back()->with(['success' => 'Successfully deleted ' . $title]);
    }
}
