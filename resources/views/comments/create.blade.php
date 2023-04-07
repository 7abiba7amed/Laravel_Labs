

    <form action="{{ route('comments.store') }}" method="POST">
        {{ csrf_field() }}
        {{-- <div class="mb-3">
            <label class="form-label">Title</label>
            <input  type="text" name="title" class="form-control" >
        </div> --}}
        <div class="mb-3">
            <label  class="form-label">Comment</label>
            <textarea class="form-control" name="body" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <input  type="text" name="user_id" value="1" hidden class="form-control" >

            {{-- <select class="form-control" name="user_id">
                @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select> --}}
        </div>
        <button class="btn btn-success">Add Comment</button>
    </form>

