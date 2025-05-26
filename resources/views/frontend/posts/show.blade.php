@extends('frontend.layouts.app')
@section('title', $post->title)

@section('content')
<div class="container py-4">
  <h1 class="mb-4">{{ $post->title }}</h1>
  @php
      $mime = $post->media->type;
      $url = asset('storage/' . $post->media->url);
  @endphp

  <div class="mb-4">
      @if (str_starts_with($mime, 'image'))
          <img src="{{ $url }}" alt="Post Image" class="img-fluid rounded">
      @elseif (str_starts_with($mime, 'video'))
          <video width="100%" height="400" controls class="rounded">
              <source src="{{ $url }}" type="{{ $mime }}">
              Your browser does not support the video tag.
          </video>
      @else
          <a href="{{ $url }}" target="_blank">View Media</a>
      @endif
  </div>

  <div class="mb-5">
      {!! nl2br(e($post->content)) !!}
  </div>

  @forelse ($post->comments as $comment)
      <div class="border rounded p-3 mb-3">
          <strong>{{ $comment->content }}</strong>
            @if ($comment->media)
                <img src="{{ asset('storage/' . $comment->media->url) }}" alt="" style="max-width: 300px;" class="mt-2 rounded">
            @endif      
    </div>
  @empty
      <p>No comments yet. Be the first to comment!</p>
  @endforelse

  <h5 class="mt-5">Leave a Comment</h5>
  <form action="{{ route('comments.store', $post->id) }}" method="POST" class="mt-3" enctype="multipart/form-data">
      @csrf
      <div class="mb-3">
          <textarea name="content" class="form-control" rows="4" placeholder="Write your comment here..."></textarea>
          @error('content')
              <span class="text-danger">{{ $message }}</span>
          @enderror
      </div>
      <div class="mb-3">
        <label for="media">Upload Image (optional):</label>
        <input type="file" name="media" id="media" class="form-control" accept="image/*">
      </div>
      <button type="submit" class="btn btn-primary">Post Comment</button>
  </form>

</div>
@endsection
