<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Post;
use App\Category;

class HomeController extends Controller
{
    protected $pagination = 10;

    public function index()
    {
        $posts = Post::with('user')
            ->where('date_published', '<', Carbon::now())
            ->orderBy('date_published', 'desc')
            ->filter()
            ->get();

        $archives = Post::selectRaw('year(date_published) year, monthname(date_published) month, count(*) published')
            ->groupBy('year', 'month')
            ->orderByRaw('min(date_published) desc')
            ->get()
            ->toArray();
        $categories = Category::latest()->get();
        return view('posts', compact('posts', 'categories', 'archives'));
    }
}
