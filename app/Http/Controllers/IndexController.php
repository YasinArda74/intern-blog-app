<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function getHome(Post $posts)
    {
        Post::all()->sortByDesc('created_at');

        return view('home' , compact('posts'));
    }
}
