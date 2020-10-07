<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;

class TweetsController extends Controller
{
    public function store()
    {
        $attributes = $this->validateTweet();

        $path = null;
        if (\request('image')) {
            $path = \request('image')->store('images');
        }
        Tweet::create([
            'user_id' => auth()->id(),
            'body' => $attributes['body'],
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

    public function validateTweet()
    {
        return \request()->validate([
            'body' => 'required|max:255',
            'image' => 'file'
        ]);
    }
}
