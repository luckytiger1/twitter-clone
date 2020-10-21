<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentLikeController extends Controller
{
    public function store(Comment $comment)
    {
        $comment->like(current_user());

        return back();
    }

    public function destroy(Comment $comment)
    {
        $comment->dislike(current_user());

        return back();
    }
}
