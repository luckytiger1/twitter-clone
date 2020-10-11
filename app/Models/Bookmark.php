<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    protected $guarded = [];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tweet()
    {
        return $this->belongsTo(Tweet::class, 'tweet_id');
    }
}
