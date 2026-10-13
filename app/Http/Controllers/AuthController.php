<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function getLogin()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        $credentials = Validator::make(
            $request->all(),
            [
                'username' => ['required'],
                'password' => ['required'],
                'remember' => ['boolean'],
            ],
        )->validated();

        if (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()
            ->withErrors([
                'status' => false,
                'message' => 'Invalid credentials',
            ])
            ->withInput($request->only('username', 'remember'));
    }

    public function getRegister()
    {
        return view('auth.register');
    }

    public function postRegister(Request $request)
    {
        $inputs = Validator::make(
            $request->all(),
            [
                'firstname' => ['required'],
                'lastname' => ['required'],
                'username' => ['required', 'unique:users'],
                'email' => ['required', 'unique:users'],
                'password' => ['required', 'min:6', 'confirmed'],
            ]
        )->validated();

        $user = User::query()->create($inputs);
        $user->assignRole('user');

        return redirect()->route('login');
    }

    public function getLogout(){
        Auth::logout();

        return redirect()->route('login');
    }
}
