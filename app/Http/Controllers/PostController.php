<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $allPosts = Post::paginate(10);
        foreach ($allPosts as $post) {
            if ($post['user_id'])
                $post['user_id'] = User::find($post['user_id'])['name'];
        }
        return view('posts.index', [
            'posts' => $allPosts,
        ]);
    }

    public function show(int $id)
    {
        $post = Post::find($id);
        $user = User::find($post->user_id);
        $comments = Comment::all();
        foreach ($comments as $comment) {
            if ($comment['user_id'])
                $comment['user_id'] = User::find($comment['user_id'])['name'];
        }
        return view('posts.show', ['post' => $post , 'user'=>$user , 'comments'=>$comments]);
    }
    public function create()
    {
        $users = User::all();

        return view('posts.create', [
            'users' => $users
        ]);
    }
    public function destroy(int $id)
    {
        Post::destroy($id);
        return redirect()->route('posts.index');
    }
    public function edit(int $id)
    {
        $users = User::all();
        $post = Post::find($id);
        return view('posts.update', ['post' => $post, 'users' => $users]);
    }
    public function update(Request $request)
    {
        $post = $request->all();
        Post::where('id', $post['id'])
            ->update([
                'title' => $post['title'],
                'description' => $post['description'],
                'user_id' => $post['user_id']
            ]);
        return redirect()->route('posts.index');
    }
    public function store(Request $request)
    {
        Post::create($request->only('title', 'description', 'user_id'));
        return redirect()->route('posts.index');
    }
}
