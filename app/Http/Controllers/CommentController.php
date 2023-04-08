<?php



namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //


    public function show(int $id)
    {
        $comment = Comment::find($id);
        $user = User::find($comment->user_id);
        return view('comments.show', ['comment' => $comment , 'user'=>$user]);
    }
    public function create()
    {
        $users = User::all();

        return view('comments.create', [
            'users' => $users
        ]);
    }
    public function destroy(int $id)
    {
        $postID = Comment::find($id)->commentable_id;
        Comment::destroy($id);
        return redirect()->route('posts.show', ['post' => $postID]);

    }
    public function edit(int $id)
    {
        $users = User::all();
        $comment = Comment::find($id);
        return view('comments.update', ['comment' => $comment, 'users' => $users]);
    }
    public function update(Request $request)
    {
        $comment = $request->all();
        $postID = Comment::find($comment['id'])->commentable_id;
        Comment::where('id', $comment['id'])
            ->update([
                'body' => $comment['body']
            ]);
            return redirect()->route('posts.show', ['post' => $postID]);
    }
    public function store(Request $request)
    {
       $post= Post::find($request->post_id);
       $post->comments()->create($request->only('body', 'user_id'));

        return redirect()->route('posts.show', ['post' => $post->id]);

    }
}
