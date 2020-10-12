<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;

class BookmarksController extends Controller
{
    public function index()
    {
//        dd(auth()->user()->bookmarkTimeline()[0]->tweet());
//        $tweets = [];
//        foreach (auth()->user()->bookmarkTimeline() as $tweet) {
//            array_push($tweets, $tweet->tweet);
//        }
//        dd(auth()->user()->bookmarkTimeline());
        return view('tweets.bookmarks', [
            'tweets' => auth()->user()->bookmarkTimeline()
        ]);
    }
}
