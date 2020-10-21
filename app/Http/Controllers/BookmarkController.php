<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function index()
    {
        return view('tweets.bookmarks', [
            'tweets' => auth()->user()->bookmarkTimeline()
        ]);
    }

    public function store(Tweet $tweet)
    {
        $tweet->saveTweet(current_user());

        return back();
    }

    public function destroy(Tweet $tweet)
    {
        $tweet->unSaveTweet(current_user());

        return back();
    }
}
