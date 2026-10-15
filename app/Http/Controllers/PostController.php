<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\CreatePostRequest;
use App\Models\Category;
use App\Models\Post;

class PostController extends Controller
{
    public function getCreate()
    {
        $categories = Category::all();

        return view('posts.create' , [
            'categories' => $categories
        ]);
    }

    public function postCreate(CreatePostRequest $request)
    {
        Post::query()->create($request->validated());

        return redirect()->route('home');

    }

    public function getShow(Post $post)
    {
        return view('posts.show', [
            'post' => $post
        ]);
    }

}
