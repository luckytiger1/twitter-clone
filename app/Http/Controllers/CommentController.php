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

        $comment = new Comment();
        $comment->body = $request->input('comment-body');
//        $comment->user_id = auth()->user()->id;
        $comment->author()->associate($request->user());
        $tweet = Tweet::find($request->input('tweet_id'));
//        $comment->tweet_id = $tweet_id;
        $tweet->comments()->save($comment);
//        $comment->save();

        return back();
    }

    public function replyStore(Request $request)
    {
        $this->validateComment();

        $reply = new Comment();
        $reply->body = $request->input('comment-body');
        $reply->parent_id = $request->input('comment_id');
//        $comment->user_id = auth()->user()->id;
        $reply->author()->associate($request->user());
        $tweet = Tweet::find($request->input('tweet_id'));
//        $comment->tweet_id = $tweet_id;
        $tweet->comments()->save($reply);
//        $reply->save();

        return back();
    }

    public function validateComment()
    {
        return \request()->validate([
            'comment-body' => 'required|max:255'
        ]);
    }
}
