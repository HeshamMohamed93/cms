@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end mb-2">
        <a href="{{route('categories.create')}}" class="btn btn-success float-right" style="color: white">Add
            Category</a>
    </div>
    <div class="card card-default">
        <div class="card-header">Categories</div>
        <div class="card-body">
            @if($categories->count() > 0)
            <table class="table">
                <thead>
                <th>Name</th>
                <th>Posts Count</th>
                <th>Actions</th>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{$category->name}}</td>
                        <td>{{$category->posts->count()}}</td>
                        <td>
                            <a href="{{route('categories.edit', $category->id)}}" class="btn btn-info btn-sm" style="color: white">Edit</a>
                            <a class="btn btn-danger btn-sm" onclick="handleDelete({{$category->id}})">Delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="DELETE" method="POST" id="deleteCategoryForm">
                        @csrf
                        @method('DELETE')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Delete Category</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want delete this category?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @else
                <h1>
                    No Categories
                </h1>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function handleDelete(id) {
            $('#deleteModal').modal('show')
        const form = $('#deleteCategoryForm')
            form.attr('action', '/categories/' + id)
        }
    </script>
@endsection
