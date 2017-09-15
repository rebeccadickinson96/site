<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Post;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required',
            'commenter_name' => 'required'
        ]);

        Comment::create([
            'post_id' => $request->input('post_id'),
            'body' => $request->input('body'),
            'user_id' => Auth::id(),
            'commenter_name' => Auth::guest() ? $request->input('commenter_name') : Auth::user()->name

        ]);
        return back();
    }
}
