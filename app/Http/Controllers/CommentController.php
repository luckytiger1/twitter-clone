<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Tweet;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $this->validateComment();
        $tweet = Tweet::find($request->input('tweet_id'));

        $comment = new Comment();
        $comment->body = $request->input('comment-body');
        $comment->author()->associate($request->user());

        $tweet->comments()->save($comment);

        return back();
    }

    public function replyStore(Request $request)
    {
        $this->validateComment();
        $tweet = Tweet::find($request->input('tweet_id'));

        $reply = new Comment();
        $reply->body = $request->input('comment-body');
        $reply->parent_id = $request->input('comment_id');
        $reply->author()->associate($request->user());

        $tweet->comments()->save($reply);

        return back();
    }

    public function validateComment()
    {
        return \request()->validate([
            'comment-body' => 'required|max:255'
        ]);
    }
}
