<?php

namespace App\Models;

use App\Models\Media;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content'];

    public function media()
    {
        return $this->morphOne(Media::class, 'mediaable');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
