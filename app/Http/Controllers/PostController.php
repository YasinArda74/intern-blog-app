<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\CreatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;

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

    public function getShow(User $user, $postSlug)
    {
        $post = Post::query()
            ->where('user_id', $user->id)
            ->where('slug', $postSlug)
            ->firstOrFail();

        return view('posts.show', [
            'post' => $post
        ]);
    }

}
