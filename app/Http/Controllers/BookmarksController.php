<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;

class BookmarksController extends Controller
{
    public function index()
    {
        dd(auth()->user()->bookmarks());
        return view('tweets.bookmarks', [
            'tweets' => auth()->user()->bookmarks()
        ]);
    }
}
