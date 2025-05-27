@extends('frontend.layouts.app')
@section('title', 'Blog Posts')
@section('content')
    @if($posts->count() > 0)
        <a href="{{ route('posts.index') }}" class="btn btn-primary btn-lg px-4 mb-4">Admin Dashboard</a>
    @endif
  <div class="row g-4">
    @forelse ($posts as $post)
      <div class="col-md-4">
        <div class="card h-100">
          @php
              $mime = $post->media->type;
              $url = asset('storage/' . $post->media->url);
          @endphp
          <div class="mt-3">
              @if (str_starts_with($mime, 'image'))
                  <img src="{{ $url }}" alt="Current Media" style="width: 100%; height: auto;">
              @elseif (str_starts_with($mime, 'video'))
                  <video width="100%" height="240" controls>
                      <source src="{{ $url }}" type="{{ $mime }}">
                      Your browser does not support the video tag.
                  </video>
              @else
                  <a href="{{ $url }}" target="_blank">View Media</a>
              @endif
          </div>
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">{{ $post->title }}</h5>
            <p class="card-text flex-grow-1">{{ Str::limit($post->content, 100) }}</p>
            <a href="{{ route('post.show', $post->id) }}" class="btn btn-primary mt-auto">Read More</a>
          </div>
        </div>
      </div>
    @empty
    <div class="d-flex flex-column justify-content-center align-items-center vh-100 bg-light text-center">
      <h2 class="mb-2">No Posts Available</h2>
      <p class="text-muted mb-4">It looks like there’s nothing here yet. Be the first to create a post!</p>
      <a href="{{ route('posts.index') }}" class="btn btn-primary btn-lg px-4">Create New Post</a>
    </div>
    @endforelse
  </div>
@endsection