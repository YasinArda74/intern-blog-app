@extends('layouts.auth-master')

@section('title', trans('Sign In'))

@section('panel-title', trans('Welcome Again'))

@section('panel-text', trans('Log in to your account and continue where you left off'))

@section('js')
    <script>
        // addEventListener: seçimi yapılan elemana event tanımlar
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('btn-form-login').addEventListener('click', function () {
                submitForm('#form-login', '{{ route('login') }}')
            });
        });
    </script>
@endsection

@section('content')
    <div>
        <h1 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white">
            @lang('Sign In')
        </h1>
        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
            @lang("Don't you have an account?")
            <a href="{{ route('register') }}" class="font-medium text-fg-brand hover:underline">
                @lang('Sign up now')
            </a>
        </p>
    </div>

    <form id="form-login" class="mt-8 space-y-5" novalidate>
        <x-text-input id="username" name="username" type="username" icon="username" :label="trans('User Name')"
                      placeholder="örn:ahmet31" autocomplete="username" autofocus/>

        <x-password-input id="password" name="password" :label="trans('Password')" autocomplete="current-password">
            @if (Route::has('password.request'))
                <x-slot:action>
                    <a href="{{ route('password.request') }}"
                       class="text-sm font-medium text-fg-brand hover:underline">Şifremi
                        unuttum</a>
                </x-slot:action>
            @endif
        </x-password-input>

        <div class="flex items-center">
            <input id="remember" name="remember" type="checkbox" value="1" @checked(old('remember'))
                class="size-4 rounded-sm border-gray-300 bg-gray-100 text-indigo-600 focus:ring-2 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-800 dark:ring-offset-gray-900">
            <label for="remember" class="ms-2 text-sm text-gray-700 dark:text-gray-300">@lang('Remember Me')</label>
        </div>

        <button type="button"
                id="btn-form-login"
            class="w-full rounded-base bg-brand px-5 py-3 text-center text-sm font-semibold text-white shadow-xs transition hover:bg-brand-strong focus:outline-none focus:ring-4 focus:ring-brand-medium">
            @lang('Sign In')
        </button>
    </form>

    <p class="mt-5 text-center text-xs text-gray-500 dark:text-gray-400">
        @lang('By logging in, you agree to the <a href="#" class="underline hover:text-gray-700 dark:hover:text-gray-200">Terms of Use</a>.')
    </p>
@endsection
