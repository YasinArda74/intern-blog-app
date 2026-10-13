<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function getProfile()
    {
        $posts = Post::whereUserId($this->authUser->id)
            ->orderByDesc('created_at')
            ->get();

        return view('profile.show', [
            'user' => $this->authUser,
            'posts' => $posts,
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
                'firstname' => 'required',
                'lastname' => 'required',
                'username' => 'required',
                'email' => 'required',
            ],
        )->validated();

        $this->authUser->update($inputs);

        return redirect()->back();
    }
}
