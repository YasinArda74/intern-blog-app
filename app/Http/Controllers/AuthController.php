<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
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

    public function postLogin(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();

            return $this->returnSuccessResponse('Welcome again', route('home'));
        }

        return $this->returnErrorResponse('Invalid credentials');
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

        Auth::login($user);

        return $this->returnSuccessResponse('Welcome', route('home'));
    }

    public function getLogout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
