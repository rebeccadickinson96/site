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
            'commenter_name' => Auth::guest() ? $request->input('commenter_name') : Auth::user()->name,
            'approved' => Auth::user() && Auth::user()->hasRole('admin') ? 2 : 0
        ]);

        return back();
    }

    public function index() {
        $comments = Comment::pending()->paginate(10);

        return view('comments.index', compact('comments'));
    }

    public function approve(Comment $comment, Request $request) {

        if($request->input('action') === "approve") {
            $comment->update([
                'approved' => 2,
                'reviewed_by' => auth()->user()->id
            ]);
        } else if ($request->input('action') === "decline") {
            $comment->update([
                'approved' => 1,
                'reviewed_by' => auth()->user()->id
            ]);
        }
        else {
            $comment->update([
                'approved' => 0,
            ]);
        }

        return back()->with('success', 'Comment successfully moderated');
    }
}