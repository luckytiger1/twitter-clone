<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;

class RetweetController extends Controller
{
    public function store(Tweet $tweet)
    {
        $tweet->retweetTweet(current_user());

        return back();
    }

    public function destroy(Tweet $tweet)
    {
        $tweet->unRetweetTweet(current_user());

        return back();
    }
}
