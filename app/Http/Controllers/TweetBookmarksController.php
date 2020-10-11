<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;

class TweetBookmarksController extends Controller
{

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
