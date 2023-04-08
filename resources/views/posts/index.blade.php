@extends('layouts.app')

@section('title') Index @endsection

@section('content')
    {{-- <div class="text-center">
        <a type="button" href="/posts/create" class="mt-4 btn btn-success">Create Post</a>
    </div> --}}
    <table class="table mt-4">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Posted By</th>
            <th scope="col">Created At</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>

{{-- <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-body">
         Are you sure you want to delete this post
        </div>
        <div class="modal-footer">
        <form action="{{ route('posts.destroy', $post['id']) }}" method="POST" class="d-inline">
              @csrf
              @method('DELETE')
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary">Delete</button>
          </form>

        </div>
      </div>
    </div>
  </div> --}}
        @foreach($posts as $post)
            <tr>
                <td>{{$post['id']}}</td>
                <td>{{$post['title']}}</td>
                <td>{{$post['user_id']}}</td>
                <td>{{\Carbon\Carbon::parse($post->created_at)->format('D-M-Y')}}</td>
                <td>
                    <a href="/posts/{{$post['id']}}" class="btn btn-info">View</a>
                    <a href="/posts/{{$post['id']}}/edit" class="btn btn-warning">Edit</a>
                    <form action="{{ route('posts.destroy', $post['id']) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('{{ __('Are you sure you want to delete?') }}')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center align-items-bottom fixed-bottom">
    {{ $posts->links() }}
    </div>

@endsection
