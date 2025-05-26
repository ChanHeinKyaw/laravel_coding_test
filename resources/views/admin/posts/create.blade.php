@extends('adminlte::page')

@section('title', 'Create Post')

@section('content_header')
    <h1>Create New Post</h1>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card">
                    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" value="{{ old('title') }}" class="form-control"
                                    placeholder="Enter post title">
                            </div>

                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea name="content" rows="5" class="form-control"
                                    placeholder="Enter post content">{{ old('content') }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="media">Upload Media (optional)</label>
                                <input type="file" name="media" class="form-control">
                            </div>

                        </div>

                        <div class="card-footer">
                            <a href="{{ route('posts.index') }}" class="btn btn-secondary">Back</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-1"></i> Save
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
