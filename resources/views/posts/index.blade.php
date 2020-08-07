@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end mb-2">
        <a href="{{route('posts.create')}}" class="btn btn-success float-right" style="color: white">Add
            Post</a>
    </div>
    <div class="card card-default">
        <div class="card-header">Posts</div>
        <div class="card-body">
            @if($posts->count() > 0)
            <table class="table">
                <thead>
                <th>Image</th>
                <th>Title</th>
                <th>Category</th>
                <th>Actions</th>
                </thead>
                <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td><img src="{{asset('/storage/'.$post->image)}}" width="120px" height="60px"></td>
                        <td>{{$post->title}}</td>
                        <td>{{$post->category->name}}</td>
                        <td>
                        @if(!$post->trashed())
                            <a href="{{route('posts.edit', $post->id)}}" class="btn btn-info btn-sm" style="color: white">Edit</a>
                            <a class="btn btn-danger btn-sm" onclick="handleDelete({{$post->id}})">Trash</a>
                        @endif
                        @if($post->trashed())
                            <a class="btn btn-info btn-sm" onclick="handleRestore({{$post->id}})">Restore</a>
                            <a class="btn btn-danger btn-sm" onclick="handleDelete({{$post->id}}, true)">Delete</a>
                         @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form action="DELETE" method="POST" id="deletePostForm">
                            @csrf
                            @method('DELETE')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel">Trash Post</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" id="modalBody">
                                    Are you sure you want trash this Post?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-danger" id="submitBtn">Trash</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal fade" id="restoreModal" tabindex="-1" role="dialog" aria-labelledby="restoreModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form action="{{route('restore-posts', $post->id)}}" method="POST" id="restorePostForm">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel">Restore Post</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" id="modalBody">
                                    Are you sure you want restore this Post?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-info" id="submitBtn">Restore</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @else
                <h1>
                    No Posts
                </h1>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function handleDelete(id, status = null) {
            if (status == true) {
                $('#deleteModalLabel').text('Delete Post')
                $('#modalBody').text('Are you sure you want delete this Post?')
                $('#submitBtn').text('Delete')
            }
            const form = $('#deletePostForm')
            form.attr('action', '/posts/' + id)
            $('#deleteModal').modal('show')
        }
        function handleRestore(id) {
            $('#restoreModal').modal('show')
        }
    </script>
@endsection
