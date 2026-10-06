@extends('layouts.auth-master')

@section('title', trans('Sign In'))

@section('panel-title', trans('Welcome Again'))

@section('panel-text', trans('Log in to your account and continue where you left off'))

@section('content')
    <div>
        <h1 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white">Giriş yap</h1>
        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
            Hesabın yok mu?
            <a href="{{ route('register') }}" class="font-medium text-indigo-700 hover:underline dark:text-indigo-400">Hemen
                kayıt ol</a>
        </p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-5" novalidate>
        @csrf

        <x-text-input id="username" name="username" type="username" icon="username" label="Kullanıcı Adınız"
                      placeholder="örn:ahmet31" autocomplete="username" autofocus/>

        <x-password-input id="password" name="password" :label="trans('Password')" autocomplete="current-password">
            @if (Route::has('password.request'))
                <x-slot:action>
                    <a href="{{ route('password.request') }}"
                       class="text-sm font-medium text-indigo-700 hover:underline dark:text-indigo-400">Şifremi
                        unuttum</a>
                </x-slot:action>
            @endif
        </x-password-input>

        <div class="flex items-center">
            <input id="remember" name="remember" type="checkbox" value="1" @checked(old('remember'))
                class="size-4 rounded-sm border-gray-300 bg-gray-100 text-indigo-600 focus:ring-2 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-800 dark:ring-offset-gray-900">
            <label for="remember" class="ms-2 text-sm text-gray-700 dark:text-gray-300">Beni hatırla</label>
        </div>

        <button type="submit"
            class="w-full rounded-lg bg-indigo-700 px-5 py-3 text-center text-sm font-semibold text-white hover:bg-indigo-800 focus:outline-none focus:ring-4 focus:ring-indigo-300 dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">
            Giriş yap
        </button>
    </form>

    <p class="mt-10 text-center text-xs text-gray-500 dark:text-gray-400">
        Giriş yaparak <a href="#" class="underline hover:text-gray-700 dark:hover:text-gray-200">Kullanım Koşulları</a>'nı kabul etmiş olursun.
    </p>
@endsection
