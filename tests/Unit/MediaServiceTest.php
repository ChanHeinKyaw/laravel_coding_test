<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use App\Services\MediaService;

class MediaServiceTest extends TestCase
{
    public function test_it_can_upload_media_for_a_post()
    {
        Storage::fake('public');

        $post = Post::factory()->create();

        $file = UploadedFile::fake()->image('photo.jpg');

        $mediaService = new MediaService();

        $mediaService->upload($post, $file);

        Storage::disk('public')->assertExists('uploads/' . $file->hashName());

        $this->assertDatabaseHas('media', [
            'mediaable_id' => $post->id,
            'mediaable_type' => Post::class,
            'type' => $file->getClientMimeType(),
        ]);
    }
}
