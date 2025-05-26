<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use App\Models\Media;

class PostFeatureTest extends TestCase
{
    /** @test */
    public function it_creates_a_post_with_media()
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->image('post-image.jpg');

        $response = $this->post(route('posts.store'), [
            'title' => 'Test Post',
            'content' => 'This is a test post.',
            'media' => $file,
        ]);

        $response->assertRedirect(route('posts.index'));

        $this->assertDatabaseHas('posts', [
            'title' => 'Test Post',
            'content' => 'This is a test post.',
        ]);

        Storage::disk('public')->assertExists('uploads/' . $file->hashName());

        $this->assertDatabaseHas('media', [
            'type' => $file->getClientMimeType(),
        ]);
    }
}
