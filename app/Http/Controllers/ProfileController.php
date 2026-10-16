<?php

namespace App\Http\Controllers;

use App\Enums\PostStatusEnum;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function getProfile()
    {
        $published_posts = Post::whereUserId($this->authUser->id)
            ->where('posts.status',PostStatusEnum::published)
            ->orderByDesc('created_at')
            ->paginate(6);

        return view('profile.show', [
            'user' => $this->authUser,
            'published_posts' => $published_posts,
        ]);
    }

    public function getEdit()
    {
        return view('profile.edit', [
            'user' => $this->authUser,
        ]);
    }

    public function putEdit(Request $request)
    {
        $inputs = Validator::make(
            $request->all(),
            [
                'firstname' => ['required'],
                'lastname' => ['required'],
                'username' => ['required'],
                'email' => ['required'],
                'about' => ['nullable'],
            ],
        )->validated();

        $this->authUser->update($inputs);

        return redirect()->back();
    }
}
