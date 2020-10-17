<?php


namespace App;


use App\Models\User;

trait Retweetable
{
    public function retweetTweet($user = null, $saved = true)
    {
        $this->retweets()->updateOrCreate([
            'user_id' => $user ? $user->id : auth()->id(),
        ]);
    }

    public function unRetweetTweet($user)
    {
        $this->retweets()->where('user_id', $user->id)->delete();
    }

    public function isRetweetedBy(User $user)
    {
        return (bool)$user->retweets->where('tweet_id', $this->id)->count();
    }
}
