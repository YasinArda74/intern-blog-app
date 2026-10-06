@extends('layouts.app')

@section('title', 'Profil Ayarları')

@section('content')
    <div class="mx-auto max-w-4xl px-4 py-10 sm:px-6">
        <h1 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Profil ayarları</h1>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Profil bilgilerini ve hesap güvenliğini yönet.</p>

        <div class="mt-8 space-y-8">
            {{-- Profil bilgileri --}}
            <form action="{{route('profileEdit')}}" method="post" class="rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-900">
                @method('PUT')
                @csrf
                <div class="border-b border-gray-200 p-6 dark:border-gray-800">
                    <h2 class="font-semibold text-gray-900 dark:text-white">Profil bilgileri</h2>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Bu bilgiler profil sayfanda herkese görünür.</p>
                </div>
                <div class="space-y-5 p-6">
                    <div class="flex items-center gap-5">
                        <x-avatar initials="AY" size="lg" />
                        <div class="flex gap-2">
                            <label for="avatar" class="cursor-pointer rounded-lg border border-gray-300 px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 dark:border-gray-700 dark:text-white dark:hover:bg-gray-800">
                                Fotoğraf yükle
                                <input id="avatar" type="file" accept="image/*" class="hidden">
                            </label>
                            <button type="button" class="rounded-lg px-3 py-2 text-sm font-medium text-red-600 hover:bg-red-50 dark:text-red-400 dark:hover:bg-gray-800">Kaldır</button>
                        </div>
                    </div>

                    <div class="grid gap-5 sm:grid-cols-2">
                        <x-text-input id="firstname" name="firstname" icon="user" label="Ad" value="{{$user->firstname}}" />
                        <x-text-input id="lastname" name="lastname" icon="user" label="Soyad" value="{{$user->lastname}}" />
                        <x-text-input id="email" name="email" type="email" icon="mail" label="E-posta adresi" value="{{$user->email}}" />
                    </div>

                    <div>
                        <label for="username" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Kullanıcı adı</label>
                        <div class="flex">
                            <span class="inline-flex items-center rounded-s-lg border border-e-0 border-gray-300 bg-gray-100 px-3 text-sm text-gray-500 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400">kalem.com/@</span>
                            <input type="text" id="username" name="username" value="{{$user->username}}"
                                class="block w-full min-w-0 flex-1 rounded-e-lg border border-gray-300 bg-white p-2.5 text-sm text-gray-900 focus:border-indigo-600 focus:ring-indigo-600 dark:border-gray-700 dark:bg-gray-900 dark:text-white">
                        </div>
                    </div>

                    <div>
                        <label for="bio" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Hakkımda</label>
                        <textarea id="bio" name="bio" rows="4"
                            class="block w-full rounded-lg border border-gray-300 bg-white p-2.5 text-sm text-gray-900 focus:border-indigo-600 focus:ring-indigo-600 dark:border-gray-700 dark:bg-gray-900 dark:text-white">Full-stack geliştirici. Laravel, Tailwind ve sade arayüzler hakkında yazıyorum.</textarea>
                        <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">En fazla 160 karakter.</p>
                    </div>
                </div>
                <div class="flex justify-end gap-3 border-t border-gray-200 bg-gray-50 px-6 py-4 dark:border-gray-800 dark:bg-gray-900/50">
                    <button type="button" class="rounded-lg px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800">İptal</button>
                    <button type="submit" class="rounded-lg bg-indigo-700 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-800 focus:outline-none focus:ring-4 focus:ring-indigo-300 dark:bg-indigo-600 dark:hover:bg-indigo-700">Değişiklikleri kaydet</button>
                </div>
            </form>

            {{-- Şifre --}}
            <form action="#" class="rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-900">
                <div class="border-b border-gray-200 p-6 dark:border-gray-800">
                    <h2 class="font-semibold text-gray-900 dark:text-white">Şifre değiştir</h2>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Güvenliğin için güçlü bir şifre kullan.</p>
                </div>
                <div class="space-y-5 p-6">
                    <x-password-input id="current_password" name="current_password" label="Mevcut şifre" />
                    <div class="grid gap-5 sm:grid-cols-2">
                        <x-password-input id="new_password" name="password" label="Yeni şifre" autocomplete="new-password" />
                        <x-password-input id="new_password_confirmation" name="password_confirmation" label="Yeni şifre tekrar" autocomplete="new-password" />
                    </div>
                </div>
                <div class="flex justify-end border-t border-gray-200 bg-gray-50 px-6 py-4 dark:border-gray-800 dark:bg-gray-900/50">
                    <button type="submit" class="rounded-lg bg-indigo-700 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-800 focus:outline-none focus:ring-4 focus:ring-indigo-300 dark:bg-indigo-600 dark:hover:bg-indigo-700">Şifreyi güncelle</button>
                </div>
            </form>

            {{-- Tehlikeli alan --}}
            <div class="rounded-xl border border-red-200 bg-white p-6 dark:border-red-900/60 dark:bg-gray-900">
                <h2 class="font-semibold text-red-700 dark:text-red-400">Hesabı sil</h2>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Hesabını sildiğinde tüm yazıların ve verilerin kalıcı olarak silinir. Bu işlem geri alınamaz.</p>
                <button type="button" data-modal-target="delete-modal" data-modal-toggle="delete-modal"
                    class="mt-4 rounded-lg bg-red-600 px-4 py-2 text-sm font-semibold text-white hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">Hesabımı sil</button>
            </div>
        </div>
    </div>

    {{-- Flowbite modal --}}
    <div id="delete-modal" tabindex="-1" aria-hidden="true" class="fixed inset-0 z-50 hidden items-center justify-center bg-gray-900/50 p-4">
        <div class="w-full max-w-md rounded-xl bg-white p-6 shadow-xl dark:bg-gray-800">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Emin misin?</h3>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Devam etmek için şifreni gir. Hesabın kalıcı olarak silinecek.</p>
            <div class="mt-5">
                <x-password-input id="delete_password" name="delete_password" label="Şifre" />
            </div>
            <div class="mt-6 flex justify-end gap-3">
                <button type="button" data-modal-hide="delete-modal" class="rounded-lg px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">Vazgeç</button>
                <button type="button" class="rounded-lg bg-red-600 px-4 py-2 text-sm font-semibold text-white hover:bg-red-700">Evet, sil</button>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('[data-toggle-password]').forEach((button) => {
            button.addEventListener('click', () => {
                const input = document.getElementById(button.dataset.togglePassword);
                const isHidden = input.type === 'password';
                input.type = isHidden ? 'text' : 'password';
                button.setAttribute('aria-pressed', String(isHidden));
                button.querySelector('[data-icon="show"]').classList.toggle('hidden', isHidden);
                button.querySelector('[data-icon="hide"]').classList.toggle('hidden', !isHidden);
            });
        });
    </script>
@endsection
