@extends('layouts.app')

@section('title') Create @endsection

@section('content')
    <form action="{{ route('posts.update', $post['id']) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <input  type="text" value="{{ $post->id }}" hidden name="id" class="form-control" >
        </div>
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input  type="text" name="title" value="{{ $post->title }}" class="form-control" >
        </div>
        <div class="mb-3">
            <label  class="form-label">Description</label>
            <textarea class="form-control" name="description"  rows="3">{{ $post->description }}</textarea>
        </div>
        <div class="mb-3">
            <label  class="form-label">Post Creator</label>
            <select class="form-control" name="user_id">
                @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-success">Update</button>
    </form>
@endsection
