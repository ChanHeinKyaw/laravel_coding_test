@extends('adminlte::page')

@section('title', 'Post List')

@section('content_header')
    <h1>Comment List</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mt-4">
                <div class="card">
                    <div class="card-body table-responsive p-0">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Post Name</th>
                                    <th>Comment</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($comments as $comment)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $comment->post?->title }}</td>
                                    <td>{{ $comment->content }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5">No Comment</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if ($comments->hasPages())
                        <div class="card-footer">
                            {{ $comments->links() }}
                        </div>
                    @endif
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection