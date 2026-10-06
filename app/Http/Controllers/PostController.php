<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function getCreate()
    {
        $categories = Category::all();

        return view('posts.create' , compact('categories'));
    }

    public function postCreate(Request $request)
    {
        $inputs = Validator::make(
            $request->all(),
            [
                'title' => 'required|max:100',
                'slug' => 'required|max:255',
                'content' => 'required',
                'category_slug' => 'required',
            ]
        )->validated();

        $inputs['user_id'] = auth()->id();

        $category = Category::query()
            ->where('slug', $inputs['category_slug'])
            ->firstOrFail();

        $inputs['category_id'] = $category->id;

        Post::query()->create($inputs);

        return redirect()->back();
    }
}
