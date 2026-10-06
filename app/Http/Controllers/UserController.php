<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function HomePage()
    {
        $posts = post::all();
        return view('home' , compact('posts'));
    }

    public function create(){
        $categories=Category::all();
        return view('posts.create' , compact('categories'));
    }
    public function app(){
        $user=Auth::user();

        return view('', compact('user'));
    }
    public function createPost(Request $request){
        $validatedData=$request->validate([
            'title' => 'required|max:100',
            'slug' => 'required|max:255',
            'content' => 'required',
            'category_slug' => 'required',

        ]);
        $validatedData['user_id']=auth()->id();

        $category=Category::query()->where('slug',$validatedData['category_slug'])->firstOrFail();

        $validatedData['category_id']=$category->id;

        Post::query()->create($validatedData);
        return redirect()->back()->with('Kayıt Başarılı Şekilde eklendi');

    }



    public function ayarlar(){
        return view('profile.edit');

    }
    public function showProfil(){
        $user=Auth::user();
        return view('profile.show', compact('user'));
    }


    public function profileEdit(){
        $user=Auth::user();
        return view('profile.edit', compact('user'));
    }
    public function updateProfil(Request $request){
        $validatedData=$request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'username' => 'required',
            'email' => 'required',

        ]);
        Auth::user()->update($validatedData);
        return redirect()->back();

    }
}
