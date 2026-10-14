<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

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
                'content' => 'required',
                'excerpt' => 'required',
                'category_slug' => 'required',
                'scheduled_at'=> [Rule::date()->afterToday(),'nullable'],
                'published_at_feature'=> ['nullable'],
            ]
        )->validated();

        $inputs['scheduled_at'] = ! empty($inputs['published_at_feature']) && $inputs['published_at_feature'] == 'on'
            ? $inputs['scheduled_at']
            : null;

        $inputs['user_id'] = $this->authUser->id;
        $inputs['slug']= Str::slug($inputs['title']);
        $category = Category::query()
            ->where('slug', $inputs['category_slug'])
            ->firstOrFail();

        $inputs['category_id'] = $category->id;

        Post::query()->create($inputs);

        return redirect()->back();

    }

    public function getShow(Post $post)
    {
        return view('posts.show', compact('post'));
    }

}
