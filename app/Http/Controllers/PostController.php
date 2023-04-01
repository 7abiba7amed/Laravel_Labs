<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    private $allPosts = [
        [
            'id' => 1,
            'title' => 'Laravel',
            'description' => 'hello laravel',
            'posted_by' => 'Ahmed',
            'created_at' => '2023-04-01 10:00:00',
        ],

        [
            'id' => 2,
            'title' => 'PHP',
            'description' => 'hello php',
            'posted_by' => 'Mohamed',
            'created_at' => '2023-04-01 10:00:00',
        ],

        [
            'id' => 3,
            'title' => 'Javascript',
            'description' => 'hello javascript',
            'posted_by' => 'Mohamed',
            'created_at' => '2023-04-01 10:00:00',
        ],
    ];

    public function index()
    {
        return view('posts.index', ['posts' => $this->allPosts]);
    }

    public function show(int $id)
    {
        return view('posts.show', ['post' => $this->allPosts[0]]);
    }
    public function create()
    {
        return view('posts.create');
    }
    public function delete(int $id)
    {
        return redirect()->route('posts.index');
    }
    public function edit(int $id)
    {
        return view('posts.update');
    }
    public function update(Request $request)
    {
        return redirect()->route('posts.index');
    }
    public function store(Request $request)
    {
        return redirect()->route('posts.index');
    }
}
