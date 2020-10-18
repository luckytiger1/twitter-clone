<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $fillable = ['body', 'user_id', 'tweet_id'];

    public function likes()
    {
        return $this->hasMany(CommentLike::class);
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
        return (bool)$user->commentLikes->where('comment_id', $this->id)->count();
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tweet()
    {
        return $this->belongsTo(Tweet::class, 'tweet_id');
    }
}
