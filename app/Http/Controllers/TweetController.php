<?php

namespace App\Http\Controllers;

use App\Http\Requests\TweetRequest;
use App\Models\Tweet;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    public function store(TweetRequest $request)
    {
        $path = null;
        if ($request->image) {
            $path = $request->image->store('images');
        }
        Tweet::create([
            'user_id' => auth()->id(),
            'body' => $request->body,
            'image' => $path
        ]);

        return redirect()->route('home');
    }

    public function index()
    {
        return view('tweets.index', [
            'tweets' => auth()->user()->timeline()
        ]);
    }
}
