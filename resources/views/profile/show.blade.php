@extends('layouts.app')

@section('title',''.auth()->user()->firstname)

@section('content')
    <section class="bg-white dark:bg-gray-900">
        <div class="h-40 bg-indigo-700 sm:h-52" aria-hidden="true">
            <div class="h-full w-full bg-[radial-gradient(circle_at_80%_20%,rgba(56,189,248,0.35),transparent_50%)]"></div>
        </div>
        <div class="mx-auto max-w-6xl px-4 pb-8 sm:px-6">
            <div class="-mt-14 flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-end">
                    <x-avatar initials="AY" size="xl" />
                    <div class="sm:pb-2">
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{$user->firstname}}</h1>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{'@'}}{{$user->username}}</p>
                    </div>
                </div>
                <div class="flex gap-2 sm:pb-2">
                    <a href="{{route('profileEdit')}}" class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:text-white dark:hover:bg-gray-700">Profili düzenle</a>
                    <a href="/posts/create" class="rounded-lg bg-indigo-700 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-800 dark:bg-indigo-600 dark:hover:bg-indigo-700">Yazı yaz</a>
                </div>
            </div>

            <p class="mt-6 max-w-2xl leading-relaxed text-gray-600 dark:text-gray-400">Full-stack geliştirici. Laravel, Tailwind ve sade arayüzler hakkında yazıyorum. Boş zamanlarımda kitap okuyor ve fotoğraf çekiyorum.</p>

            <dl class="mt-6 flex flex-wrap gap-8 text-sm">
                <div><dt class="text-gray-500 dark:text-gray-400">Yazı</dt><dd class="text-lg font-semibold text-gray-900 dark:text-white">24</dd></div>
                <div><dt class="text-gray-500 dark:text-gray-400">Takipçi</dt><dd class="text-lg font-semibold text-gray-900 dark:text-white">1.280</dd></div>
                <div><dt class="text-gray-500 dark:text-gray-400">Takip</dt><dd class="text-lg font-semibold text-gray-900 dark:text-white">312</dd></div>
                <div><dt class="text-gray-500 dark:text-gray-400">Katılım</dt><dd class="text-lg font-semibold text-gray-900 dark:text-white">{{$user->created_at}}</dd></div>
            </dl>
        </div>

        <div class="border-b border-gray-200 dark:border-gray-800">
            <ul class="mx-auto flex max-w-6xl gap-6 px-4 text-sm font-medium sm:px-6">
                <li><a href="#" aria-current="page" class="inline-block border-b-2 border-indigo-700 py-3 text-indigo-700 dark:border-indigo-400 dark:text-indigo-400">Yazılar <span class="ms-1 rounded bg-indigo-50 px-1.5 text-xs dark:bg-indigo-900/40">24</span></a></li>
                <li><a href="#" class="inline-block border-b-2 border-transparent py-3 text-gray-500 hover:border-gray-300 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">Taslaklar <span class="ms-1 rounded bg-gray-100 px-1.5 text-xs dark:bg-gray-800">3</span></a></li>
                <li><a href="#" class="inline-block border-b-2 border-transparent py-3 text-gray-500 hover:border-gray-300 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">Kaydedilenler</a></li>
            </ul>
        </div>
    </section>

    <div class="mx-auto max-w-6xl px-4 py-10 sm:px-6">
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <x-post-card image="/images/post-1.png" category="Yazılım" title="Laravel 13 ile modern bir blog altyapısı kurmak"
                excerpt="Route yapısından Blade bileşenlerine kadar adım adım." date="30 Eylül 2026" readTime="8 dk" />
            <x-post-card image="/images/post-4.png" category="Tasarım" title="Arayüz tasarımında renk seçimi rehberi"
                excerpt="Az renkle güçlü bir görsel kimlik oluşturmanın püf noktaları." date="25 Eylül 2026" readTime="7 dk" />
            <x-post-card image="/images/post-3.png" category="Üretkenlik" title="Tailwind CSS ile hızlı arayüz geliştirme"
                excerpt="Utility-first yaklaşımı ve Flowbite bileşenleriyle zamandan tasarruf et." date="22 Eylül 2026" readTime="5 dk" />
        </div>

        {{-- Taslak satırı örneği --}}
        <h2 class="mt-12 text-lg font-bold text-gray-900 dark:text-white">Taslaklar</h2>
        <ul class="mt-4 divide-y divide-gray-200 overflow-hidden rounded-xl border border-gray-200 bg-white dark:divide-gray-800 dark:border-gray-800 dark:bg-gray-900">
            <li class="flex flex-wrap items-center justify-between gap-3 p-4">
                <div>
                    <p class="font-medium text-gray-900 dark:text-white">Vite ile asset yönetimi</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Son düzenleme: 2 gün önce</p>
                </div>
                <div class="flex items-center gap-2">
                    <span class="rounded-md bg-yellow-100 px-2 py-0.5 text-xs font-medium text-yellow-800 dark:bg-yellow-900/40 dark:text-yellow-300">Taslak</span>
                    <a href="/posts/create" class="rounded-lg px-3 py-1.5 text-sm font-medium text-indigo-700 hover:bg-indigo-50 dark:text-indigo-400 dark:hover:bg-gray-800">Düzenle</a>
                </div>
            </li>
            <li class="flex flex-wrap items-center justify-between gap-3 p-4">
                <div>
                    <p class="font-medium text-gray-900 dark:text-white">Kitap önerileri: 2026 listem</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Son düzenleme: 1 hafta önce</p>
                </div>
                <div class="flex items-center gap-2">
                    <span class="rounded-md bg-yellow-100 px-2 py-0.5 text-xs font-medium text-yellow-800 dark:bg-yellow-900/40 dark:text-yellow-300">Taslak</span>
                    <a href="/posts/create" class="rounded-lg px-3 py-1.5 text-sm font-medium text-indigo-700 hover:bg-indigo-50 dark:text-indigo-400 dark:hover:bg-gray-800">Düzenle</a>
                </div>
            </li>
        </ul>
    </div>
@endsection
