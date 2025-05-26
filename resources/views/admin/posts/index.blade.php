@extends('adminlte::page')

@section('title', 'Post List')

@section('content_header')
    <h1>Post List</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-between">
            <div class="col">
                <a href="{{ route('posts.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus-circle mr-1"></i>
                    Create
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mt-4">
                <div class="card">
                    <div class="card-body table-responsive p-0">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Content</th>
                                    <th>Media</th>
                                    <th style="width: 350px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($posts as $post)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->content }}</td>
                                    <td>
                                        @if ($post->media)
                                            @php
                                                $mime = $post->media->type;
                                                $url = asset('storage/' . $post->media->url);
                                            @endphp

                                            @if (str_starts_with($mime, 'image'))
                                                <img src="{{ $url }}" alt="Media" style="max-width: 100px; max-height: 80px;">
                                            @elseif (str_starts_with($mime, 'video'))
                                                <video width="150" height="80" controls>
                                                    <source src="{{ $url }}" type="{{ $mime }}">
                                                    Your browser does not support the video tag.
                                                </video>
                                            @else
                                                <a href="{{ $url }}" target="_blank">View Media</a>
                                            @endif
                                            @else
                                                No Media
                                            @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('posts.edit' , $post->id)}}"
                                            class="btn btn-success ml-2">
                                            <i class="fas fa-edit"></i>
                                            Edit
                                        </a>
                                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger ml-2" onclick="return confirm('Are you sure you want to delete this post?')">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5">No Posts</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if ($posts->hasPages())
                        <div class="card-footer">
                            {{ $posts->links() }}
                        </div>
                    @endif
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection