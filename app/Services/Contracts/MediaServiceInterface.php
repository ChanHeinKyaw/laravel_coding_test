<?php

namespace App\Services\Contracts;

use Illuminate\Http\UploadedFile;
use App\Models\Post;

interface MediaServiceInterface
{
    public function upload(Post $post, UploadedFile $file): void;
    public function delete(Post $post): void;
}
