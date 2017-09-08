<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Post;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
//        $this->validate($request, [
//            'body' => 'required'
//        ]);
//
//        Comment::create([
//            'post_id' => $post->id,
//            'body' => $request->input('body')
//
//        ]);
        $this->validate($request, [
            'body' => 'required'
        ]);
        $post->addComment($request->input('body'));
        return back();
    }
}
