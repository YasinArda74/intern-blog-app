<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function getProfile(){
        return view('profile.show', [
            'user' => $this->authUser,
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
