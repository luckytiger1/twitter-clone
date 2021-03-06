<?php

namespace App\Models;

use App\Followable;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, Followable, HasRoles, CrudTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'avatar', 'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAvatarAttribute($value)
    {
        return asset($value ? 'storage/' . $value : '/images/default-avatar.png');
    }


    public function timeline()
    {
        $friends = $this->follows()->pluck('id');

        return Tweet::whereIn('user_id', $friends)
            ->orWhere('user_id', $this->id)
            ->latest()
            ->get();
    }

    public function bookmarkTimeline()
    {
        return Tweet::join('bookmarks', 'tweets.id', '=', 'bookmarks.tweet_id')
            ->join('comments', 'tweets.id', '=', 'comments.tweet_id')
            ->where('bookmarks.user_id', $this->id)
            ->select('tweets.*')
            ->orderByDesc('bookmarks.created_at')
            ->distinct()
            ->get();
    }

    public function profileTimeline()
    {
//        dd(Tweet::join('retweets', function ($join) {
//            $join->on('tweets.id', '=', 'retweets.tweet_id')
//                ->orOn('tweets.user_id', '=', 'retweets.user_id');
//        })
//            ->select('tweets.*')
//            ->latest()
//            ->get());
//        return Tweet::join('retweets', 'tweets.id', '=', 'retweets.tweet_id')
//            ->join('comments', 'tweets.id', '=', 'comments.tweet_id')
//            ->where('retweets.user_id', $this->id)
//            ->select('tweets.*')
//            ->latest()
//            ->distinct()
//            ->get();
        return Tweet::join('retweets', function ($join) {
            $join->on('tweets.id', '=', 'retweets.tweet_id')
                ->orOn('tweets.user_id', '=', 'retweets.user_id');
        })
            ->where('retweets.user_id', $this->id)
            ->select('tweets.*')
            ->latest()
            ->distinct()
            ->get();
    }

    public function tweets()
    {
        return $this->hasMany(Tweet::class);
    }

    public function savedTweets()
    {
        return $this->hasMany(Tweet::class)->withBookmarks();
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function commentLikes()
    {
        return $this->hasMany(CommentLike::class);
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    public function retweets()
    {
        return $this->hasMany(Retweet::class);
    }

    public function path($append = '')
    {
        $path = route('profile', $this->username);

        return $append ? "{$path}/{$append}" : $path;
    }

    // or for more complicated use cases you can do
    public function identifiableAttribute()
    {
        // process stuff here
        return 'name';
    }

}
