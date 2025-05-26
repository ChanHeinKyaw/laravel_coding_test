<?php

namespace App\Models;

use App\Models\Post;
use App\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'content'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function media()
    {
        return $this->morphOne(Media::class, 'mediaable');
    }
}
