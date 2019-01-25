<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\Category;
use App\PostReport;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    protected $pagination = 10;

    public function index()
    {
        $title = 'Posts Index';
        if (Auth::user()->can('manage-all-posts')) {
            $posts = Post::with('User')->orderBy('date_published', 'desc')->paginate($this->pagination);
        } else {
            $posts = Post::with('User')->where('user_id', Auth::user()->id)->orderBy('date_published', 'desc')->paginate($this->pagination);
        }


        return view('posts.index', compact('posts', 'title'));
    }

    public function published()
    {
        $title = 'Published Posts';
        if (Auth::user()->can('manage-all-posts')) {
            $posts = Post::with('User')->isPublished()->orderBy('date_published', 'desc')->paginate($this->pagination);
        } else {
            $posts = Post::with('User')->isPublished()->where('user_id', Auth::user()->id)->orderBy('date_published', 'desc')->paginate($this->pagination);
        }

        return view('posts.index', compact('posts', 'title'));
    }

    public function scheduled()
    {

        $title = 'Scheduled Posts';

        if (Auth::user()->can('manage-all-posts')) {
            $posts = Post::with('User')->isScheduled()->orderBy('date_published', 'desc')->paginate($this->pagination);
        } else {
            $posts = Post::with('User')->isScheduled()->where('user_id', Auth::user()->id)->orderBy('date_published', 'desc')->paginate($this->pagination);
        }

        return view('posts.index', compact('posts', 'title'));
    }

    public function drafts()
    {
        $title = 'Draft Posts';
        if (Auth::user()->can('manage-all-posts')) {
            $posts = Post::with('User')->isDraft()->orderBy('date_published', 'desc')->paginate($this->pagination);
        } else {
            $posts = Post::with('User')->isDraft()->where('user_id', Auth::user()->id)->orderBy('date_published', 'desc')->paginate($this->pagination);
        }

        return view('posts.index', compact('posts', 'title'));
    }

    public function pending()
    {
        $title = 'Pending Posts';
        if (Auth::user()->can('manage-all-posts')) {
            $posts = Post::with('User')->isPending()->orderBy('date_published', 'desc')->paginate($this->pagination);
        } else {
            $posts = Post::with('User')->isPending()->where('user_id', Auth::user()->id)->orderBy('date_published', 'desc')->paginate($this->pagination);
        }

        return view('posts.index', compact('posts', 'title'));
    }

    public function declined()
    {
        $title = 'Declined Posts';
        if (Auth::user()->can('manage-all-posts')) {
            $posts = Post::with('User')->isDeclined()->orderBy('date_published', 'desc')->paginate($this->pagination);
        } else {
            $posts = Post::with('User')->isDeclined()->where('user_id', Auth::user()->id)->orderBy('date_published', 'desc')->paginate($this->pagination);
        }

        return view('posts.index', compact('posts', 'title'));
    }

    public function uncategorized()
    {
        $posts = Post::with('User')->uncategorized()->paginate($this->pagination);
        return view('posts', compact('posts'));
    }

    public function show(Post $post)
    {
        $categories = Category::latest()->get();

        $comments = Comment::byPost($post->id)->approved()->get();

        return view('posts.show', compact('post', 'categories', 'comments'));

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
        if (Auth::user()->cannot('manage-all-posts') && $post->user_id != auth()->user()->id) {
            return view('errors.403');
        }
        $categories = Category::latest()->get();
        return view('posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        if (Auth::user()->cannot('manage-all-posts') && $post->user_id != auth()->user()->id) {
            return view('errors.403');
        }

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
        return redirect('/posts/' . $post->id)->with(['success' => 'Successfully updated ' . $post->title]);
    }

    public function addCategory(Request $request)
    {
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

    public function reportPost(Post $post, Request $request){
        $validator = Validator::make($request->all(),[
            'category' => 'required',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => true, 'message' => $validator->messages()->all()]);
        }

        $report = PostReport::create([
            'post_id' => $post->id,
            'category' => $request->input('category'),
            'description' => $request->input('description'),
        ]);
        return response()->json(['report' => $report]);
    }
}
