<?php

namespace App\Http\Controllers;
use App\Http\Requests\StorePostRequest;
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
        $comments = Comment::where('commentable_id',$id)->get();
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
    public function store(StorePostRequest $request)
    {
        Post::create($request->only('title', 'description', 'user_id'));
        return redirect()->route('posts.index');
    }
}
// <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"></head>
// <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

