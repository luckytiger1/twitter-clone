<?php


namespace App;


use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

trait Saveable
{
    public function scopeWithBookmarks(Builder $query)
    {
        $query->leftJoinSub(
            'select tweet_id, sum(liked) likes, sum(!liked) dislikes from likes group by tweet_id',
            'bookmarks',
            'likes.tweet_id',
            'tweets.id'
        );
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function isDislikedBy(User $user)
    {
        return (bool)$user->likes->where('tweet_id', $this->id)->where('liked', false)->count();
    }

    public function like($user = null, $liked = true)
    {
        $this->likes()->updateOrCreate([
            'user_id' => $user ? $user->id : auth()->id(),
        ], [
            'liked' => $liked
        ]);
    }

    public function dislike($user = null)
    {
        $this->likes()->where('user_id', current_user()->id)->delete();
    }

    public function isLikedBy(User $user)
    {
        return (bool)$user->likes->where('tweet_id', $this->id)->where('liked', true)->count();
    }
}
