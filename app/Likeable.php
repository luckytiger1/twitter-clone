<?php


namespace App;


use App\Models\Like;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

trait Likeable
{

//    public function scopeWithLikes(Builder $query)
//    {
//        $query->leftJoinSub(
//            'select tweet_id, sum(liked) likes, sum(!liked) dislikes from likes group by tweet_id',
//            'likes',
//            'likes.tweet_id',
//            'tweets.id'
//        );
//    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function like($user = null, $liked = true)
    {

        $this->likes()->updateOrCreate([
            'user_id' => $user ? $user->id : auth()->id(),
        ]);
    }

    public function dislike($user)
    {
        $this->likes()->where('user_id', $user->id)->delete();
    }

    public function isLikedBy(User $user)
    {
        return (bool)$user->likes->where('tweet_id', $this->id)->count();
    }

}
