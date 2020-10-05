<?php


namespace App;


use App\Models\Like;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

trait Likeable
{

    public function scopeWithLikes(Builder $query)
    {
        $query->leftJoinSub(
            'select tweet_id, sum(liked) likes, sum(!liked) dislikes from likes group by tweet_id',
            'likes',
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

        if ($this->likes()->first() != null && $this->likes()->firstOrFail()->liked != $liked) {

            $this->likes()->updateOrCreate([
                'user_id' => $user ? $user->id : auth()->id(),
            ], [
                'liked' => $liked
            ]);

        } else {
            if ($this->likes()->first() == null) {
                $this->likes()->updateOrCreate([
                    'user_id' => $user ? $user->id : auth()->id(),
                ], [
                    'liked' => $liked
                ]);
            } else {

                $this->likes()->first()->delete();
            }
        }
    }

    public function dislike($user = null)
    {
        $this->like($user, false);
    }

    public function isLikedBy(User $user)
    {
        return (bool)$user->likes->where('tweet_id', $this->id)->where('liked', true)->count();
    }

}
