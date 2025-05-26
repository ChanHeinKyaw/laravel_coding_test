<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\Eloquent\Model;
use App\Services\Contracts\MediaServiceInterface;

class MediaService implements MediaServiceInterface
{
    public function upload(Model $mediaable, UploadedFile $file): void
    {
        $path = $file->store('uploads', 'public');

        if ($mediaable->media) {
            Storage::disk('public')->delete($mediaable->media->url);
            $mediaable->media()->update([
                'url'  => $path,
                'type' => $file->getClientMimeType(),
            ]);
        } else {
            $mediaable->media()->create([
                'url'  => $path,
                'type' => $file->getClientMimeType(),
            ]);
        }
    }

    public function delete(Model $mediaable): void
    {
        if ($mediaable->media) {
            Storage::disk('public')->delete($mediaable->media->url);
            $mediaable->media()->delete();
        }
    }
}
