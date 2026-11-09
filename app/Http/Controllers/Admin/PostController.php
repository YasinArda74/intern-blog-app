<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Contracts\View\View;

class PostController extends Controller
{
    public function getList(): View
    {
        $posts = Post::query()
            ->select(['id', 'title', 'slug', 'status', 'views_count', 'published_at', 'created_at', 'category_id', 'user_id'])
            ->with(['category:id,name', 'user:id,username'])
            ->latest()
            ->paginate(10);

        return view('admin.posts.index', [
            'posts' => $posts,
        ]);
    }
}
