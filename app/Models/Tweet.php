<?php

namespace App\Models;

use App\Likeable;
use App\Saveable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    use Likeable;
    use Saveable;

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
        return $this->hasMany(Comment::class)->latest();
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

}
