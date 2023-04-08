<form action="{{ route('comments.store') }}" method="POST">
    @csrf
    <input type="text" name="post_id" value="{{ $post->id }}" hidden class="form-control">

    <div class="mb-3">
        <label class="form-label">Comment</label>
        <textarea class="form-control" name="body" rows="3"></textarea>
    </div>
    <div class="mb-3">
        <input type="text" name="user_id" value="1" hidden class="form-control">
    </div>
    <button class="btn btn-success">Add Comment</button>
</form>
