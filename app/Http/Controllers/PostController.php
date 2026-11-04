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
        $categories = Category::query()
            ->orderBy('name')
            ->limit(5)
            ->get();

        return view('posts.create', [
            'categories' => $categories,
        ]);
    }

    public function postCreate(CreatePostRequest $request)
    {
        Post::query()->create($request->validated());

        return $this->returnSuccessResponse('Post created', route('profile.show'));

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
            'comments' => $post->comments()
                ->whereNull('parent_id')
                ->with('user')
                ->latest()
                ->get(),
        ]);
    }

    public function getEdit(User $user, $post)
    {
        $post = Post::query()
            ->where('user_id', $user->id)
            ->where('slug', $post)
            ->firstOrFail();

        $categories = Category::query()
            ->orderBy('name')
            ->limit(5)
            ->get();

        return view('posts.create', [
            'post' => $post,
            'categories' => $categories,
        ]);
    }

    public function putUpdate(CreatePostRequest $request, User $user, $postSlug)
    {
        $post = Post::query()
            ->where('user_id', $user->id)
            ->where('slug', $postSlug)
            ->firstOrFail();

        abort_unless($post->user_id === $this->authUser->id, 403);

        $post->update($request->safe()->except(['published_at_feature']));

        return $this->returnSuccessResponse(
            'Post updated',
            route('posts.show', ['user' => $user, 'postSlug' => $post->slug])
        );
    }

    public function postDelete(User $user, $postSlug)
    {
        $post = Post::query()
            ->where('user_id', $user->id)
            ->where('slug', $postSlug)
            ->firstOrFail();

        abort_unless($post->user_id === $this->authUser->id, 403);

        $post->delete();

        return $this->returnSuccessResponse('Post deleted', route('home'));

    }
}
