<table class="table mt-4">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Body</th>
            <th scope="col">User Name</th>
            <th scope="col">Created At</th>
        </tr>
    </thead>
    <tbody>
        @if ($comments)
            @foreach ($comments as $comment)
                <tr>
                    <td>{{ $comment['id'] }}</td>
                    <td>{{ $comment['body'] }}</td>
                    <td>{{ $comment['user_id'] }}</td>
                    <td>{{ \Carbon\Carbon::parse($comment->created_at)->format('D-M-Y') }}</td>
                    <td>
                        {{-- <a href="/comments/{{$comment['id']}}" class="btn btn-info">View</a> --}}
                        <a href="/comments/{{ $comment['id'] }}/edit" class="btn btn-warning">Edit</a>
                        <form action="{{ route('comments.destroy', $comment['id']) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
<div class="d-flex justify-content-center align-items-bottom fixed-bottom">
</div>
