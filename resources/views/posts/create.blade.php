@extends('layouts.app')

@section('title') Create @endsection

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input  type="text" name="title" class="form-control" >
        </div>
        <div class="mb-3">
            <label  class="form-label">Description</label>
            <textarea class="form-control" name="description" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label  class="form-label">Post Creator</label>
            <select class="form-control" name="user_id">
                @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
          <label for="image" class="form-label">Image</label>
          <input type="file" class="form-control" name="image" id="" placeholder="" aria-describedby="fileHelpId">
        </div>
        <button class="btn btn-success">Submit</button>
    </form>
@endsection
