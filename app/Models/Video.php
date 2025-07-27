<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'slug', 'description', 'file_path'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(VideoLike::class)->where('type', 'like');
    }

    public function dislikes()
    {
        return $this->hasMany(VideoLike::class)->where('type', 'dislike');
    }
}

