@extends('layouts.app')

@section('title')
    Create
@endsection

@section('content')
    <form action="{{ route('comments.update', $comment['id']) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <input type="text" name="id" hidden value="{{ $comment->id }}" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="body" rows="3">{{ $comment->body }}</textarea>
        </div>
        <button class="btn btn-success">Update Comment</button>
    </form>
@endsection
