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

    public function show($id)
    {
        return view('posts.show', ['post' => $this->allPosts[0]]);
    }

    public function create()
    {
        return view('posts.create');
    }
    public function delete()
    {
        return view('posts.index', ['posts' => $this->allPosts]);
    }
    public function update()
    {
        return view('posts.update', ['post' => $this->allPosts[0]]);
    }
    public function restore()
    {
        return view('posts.index', ['posts' => $this->allPosts]);
    }
}
