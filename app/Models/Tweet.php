<?php

namespace App\Models;

use App\Likeable;
use App\Retweetable;
use App\Saveable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    use Likeable;
    use Saveable;
    use Retweetable;

    protected $guarded = [];

    public function getImageAttribute($value)
    {
        return asset($value ? 'storage/' . $value : null);
    }

    public function setImageAttribute($value)
    {
        $attribute_name = "image";
        $disk = "public";
        $destination_path = 'images';

        $this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id')->latest();
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    public function retweets()
    {
        return $this->hasMany(Retweet::class);
    }

}
