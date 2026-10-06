<?php

namespace App\Http\Controllers;

use App\Models\post;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function getHome()
    {
        $posts = post::all();

        return view('home' , compact('posts'));
    }
}
