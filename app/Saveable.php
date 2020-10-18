<?php


namespace App;


use App\Models\Bookmark;
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

    public function saves()
    {
        return $this->hasMany(Bookmark::class, 'tweet_id');
    }


    public function saveTweet($user = null, $saved = true)
    {
        $this->saves()->updateOrCreate([
            'user_id' => $user ? $user->id : auth()->id(),
        ]);
    }

    public function unSaveTweet($user = null)
    {
        $this->saves()->where('user_id', current_user()->id)->delete();
    }

    public function isSavedBy(User $user)
    {
        return (bool)$user->bookmarks->where('tweet_id', $this->id)->count();
    }
}
