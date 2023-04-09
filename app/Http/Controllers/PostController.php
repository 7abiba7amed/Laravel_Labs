<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Mime\Part\File;
use App\Jobs\PruneOldPostsJob;
use Illuminate\Support\Facades\Queue;

Queue::push(new PruneOldPostsJob);

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
        $comments = Comment::where('commentable_id', $id)->get();
        foreach ($comments as $comment) {
            if ($comment['user_id'])
                $comment['user_id'] = User::find($comment['user_id'])['name'];
        }
        return view('posts.show', ['post' => $post, 'user' => $user, 'comments' => $comments]);
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

        $postImage = Post::find($id)->image;
        if ($postImage) {
            $file_path = "Images/posts/" . $postImage;
            unlink($file_path);
        }
        Post::destroy($id);
        return redirect()->route('posts.index');
    }
    public function edit(int $id)
    {
        $users = User::all();
        $post = Post::find($id);
        return view('posts.update', ['post' => $post, 'users' => $users]);
    }
    public function update(StorePostRequest $request)
    {
        $post = Post::find($request->id);
        if ($post) {
            $post->update($request->except('image'));
            if ($request->hasFile('image')) {
                $old_image = $post->image;
                $image = $request->image;
                $image_new_name = time() . '.' . $image->getClientOriginalExtension();
                if ($image->move('Images/posts', $image_new_name)) {
                    unlink('Images/posts/' . $old_image);
                }
                $post->image = $image_new_name;
            }
        }
        $post->save();
        return redirect()->route('posts.index');
    }
    public function store(StorePostRequest $request)
    {
        $data = $request->all();
        $file_ext = $request->image->getClientOriginalExtension();
        $file_name = time() . '.' . $file_ext;
        $path = 'Images/posts';
        $request->image->move($path, $file_name);
        Post::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'user_id' => $data['user_id'],
            'image' => $file_name

        ]);
        return redirect()->route('posts.index');
    }
}
