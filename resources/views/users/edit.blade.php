@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">My Profile</div>

        <div class="card-body">
            @include('partial.error')
            <form action="{{ route('users.update-profile') }}" method="POST">
            @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" class="form-control" name="name" value="{{$user->name}}">
                </div>
                <div class="form-group">
                    <label for="name">About</label>
                   <textarea rows="5" cols="5" name="about" id="about" class="form-control">{{$user->about}}</textarea>
                </div>
                <button type="submit" class="btn btn-success">Update Profile</button>
            </form>
        </div>
    </div>
@endsection
