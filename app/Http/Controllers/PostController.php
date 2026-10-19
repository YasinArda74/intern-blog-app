<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\CreatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function getCreate()
    {
        $categories = Category::all();

        return view('posts.create', [
            'categories' => $categories,
        ]);
    }

    public function postCreate(CreatePostRequest $request)
    {
        Post::query()->create($request->validated());

        return redirect()->route('home');

    }

    public function postImage(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:4096'],
        ]);

        $path = $validated['image']->store('posts', 'public');

        return response()->json([
            'url' => Storage::disk('public')->url($path),
        ]);
    }

    public function getShow(User $user, $postSlug)
    {
        $post = Post::query()
            ->with(['user', 'category'])
            ->where('user_id', $user->id)
            ->where('slug', $postSlug)
            ->firstOrFail();

        return view('posts.show', [
            'post' => $post,
        ]);
    }

    public function getEdit(User $user, $post)
    {
        $categories = Category::all();
        $post = Post::query()
            ->where('user_id', $user->id)
            ->where('slug', $post)
            ->firstOrFail();

        return view('posts.create', [
            'post' => $post,
            'categories' => $categories,
        ]);
    }

    public function putUpdate() {}
}
