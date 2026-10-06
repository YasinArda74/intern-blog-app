@extends('layouts.guest')

@section('title', 'Kayıt Ol')
@section('panel-title', 'Birkaç saniyede aramıza katıl.')
@section('panel-text', 'Ücretsiz hesabını oluştur, tüm özellikleri hemen kullanmaya başla.')

@section('content')
    <div>
        <h1 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white">Hesap oluştur</h1>
        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
            Zaten hesabın var mı?
            <a href="{{ route('login') }}" class="font-medium text-indigo-700 hover:underline dark:text-indigo-400">Giriş yap</a>
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="mt-8 space-y-5" novalidate>
        @csrf

        <x-text-input id="username" name="username" icon="user" label="Kullanıcı Adı" placeholder="" autocomplete="username" autofocus />
        <x-text-input id="firstname" name="firstname" icon="user" label="Ad" placeholder="" autocomplete="firstname" autofocus />
        <x-text-input id="lastname" name="lastname" icon="user" label="Soyad" placeholder="" autocomplete="lastname" autofocus />
        <x-text-input id="email" name="email" type="email" icon="mail" label="E-posta adresi" placeholder="ornek@site.com" autocomplete="email" />
        <div class="grid gap-5 sm:grid-cols-2">
            <x-password-input id="password" name="password" label="Şifre" autocomplete="new-password" />
            <x-password-input id="password_confirmation" name="password_confirmation" label="Şifre tekrar" autocomplete="new-password" />
        </div>
        <p class="-mt-2 text-xs text-gray-500 dark:text-gray-400">En az 6 karakter içermeli.</p>



        <button type="submit"
            class="w-full rounded-lg bg-indigo-700 px-5 py-3 text-center text-sm font-semibold text-white hover:bg-indigo-800 focus:outline-none focus:ring-4 focus:ring-indigo-300 dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">
            Hesap oluştur
        </button>
    </form>
@endsection
