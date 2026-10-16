<?php

namespace App\Http\Controllers;

use App\Enums\PostStatusEnum;
use App\Models\Post;

class IndexController extends Controller
{
    public function getHome()
    {
        $posts = Post::query()
            ->where('posts.status',PostStatusEnum::published)
            ->with([
                'category',
                'user',
            ])
            ->orderByDesc('created_at')
            ->paginate(6);

        $postWeaklyCount = Post::query()
            ->whereBetween('created_at', [now()->subWeek(), now()])
            ->count();

        return view('home' , [
            'posts' => $posts,
            'postWeaklyCount' => $postWeaklyCount,
        ]);
    }
}
