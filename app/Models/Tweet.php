<?php

namespace App\Models;

use App\Likeable;
use App\Saveable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use HasFactory;
    use Likeable;
    use Saveable;

    protected $guarded = [];

    public function getImageAttribute($value)
    {
        return asset($value ? 'storage/' . $value : null);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }

}
