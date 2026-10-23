@extends('layouts.auth-master')

@section('title', trans('Sign Up'))

@section('panel-title', trans('Join us in a few seconds.'))

@section('panel-text', trans('Create your free account and start using all the features right away.'))

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('btn-register-form').addEventListener('click', function () {
                submitForm('#form-register', '{{ route('register') }}');
            });
        });
    </script>
@endsection

@section('content')
    <div>
        <h1 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white">@lang('Create an account')</h1>
        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
            @lang('Do you already have an account?')
            <a href="{{ route('login') }}" class="font-medium text-indigo-700 hover:underline dark:text-indigo-400">@lang('Sign In')</a>
        </p>
    </div>

    <form id="form-register" class="mt-8 space-y-5" novalidate>
        <x-text-input id="username" name="username" icon="user" :label="trans('User Name')" placeholder="" autocomplete="username" autofocus />
        <x-text-input id="firstname" name="firstname" icon="user" :label="trans('Name')" placeholder="" autocomplete="firstname" autofocus />
        <x-text-input id="lastname" name="lastname" icon="user" :label="trans('Surname')" placeholder="" autocomplete="lastname" autofocus />
        <x-text-input id="email" name="email" type="email" icon="mail" :label="trans('Email')" placeholder="ornek@site.com" autocomplete="email" />
        <div class="grid gap-5 sm:grid-cols-2">
            <x-password-input id="password" name="password" :label="trans('Password')" autocomplete="new-password" />
            <x-password-input id="password_confirmation" name="password_confirmation" :label="trans('Confirm password')" autocomplete="new-password" />
        </div>
        <p class="-mt-2 text-xs text-gray-500 dark:text-gray-400">@lang('It must contain at least 6 characters.')</p>



        <button type="button"
                id="btn-register-form"
                class="w-full rounded-lg bg-indigo-700 px-5 py-3 text-center text-sm font-semibold text-white hover:bg-indigo-800 focus:outline-none focus:ring-4 focus:ring-indigo-300 dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800"
        >
            @lang('Create an account')
        </button>
    </form>
@endsection
