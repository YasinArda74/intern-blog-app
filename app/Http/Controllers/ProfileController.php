<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function getProfile(){
        $user = Auth::user();

        return view('profile.show', compact('user'));
    }

    public function getEdit()
    {
        $user = Auth::user();

        return view('profile.edit', compact('user'));
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

        Auth::user()->update($inputs);

        return redirect()->back();
    }
}
