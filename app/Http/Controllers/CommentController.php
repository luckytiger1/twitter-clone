<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $tweet_id = $request->input('tweet_id');

        $this->validateComment();

        $comment = new Comment();
        $comment->user_id = auth()->user()->id;
        $comment->tweet_id = $tweet_id;
        $comment->body = $request->input('comment-body');
        $comment->save();

        return back();
    }

    public function validateComment()
    {
        return \request()->validate([
            'comment-body' => 'required|max:255'
        ]);
    }
}
