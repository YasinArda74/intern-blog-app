@extends('layouts.app')

@section('title', 'Laravel 13 ile modern bir blog altyapısı kurmak')

@section('content')
    <article class="mx-auto max-w-3xl px-4 py-12 sm:px-6">
        <nav aria-label="Breadcrumb" class="text-sm text-gray-500 dark:text-gray-400">
            <ol class="flex items-center gap-2">
                <li><a href="/" class="hover:text-gray-900 dark:hover:text-white">Anasayfa</a></li>
                <li aria-hidden="true">/</li>
                <li><a href="#" class="hover:text-gray-900 dark:hover:text-white">{{$post->category->name}}</a></li>
            </ol>
        </nav>

        <header class="mt-6">
            <span class="rounded-md bg-indigo-50 px-2.5 py-0.5 text-xs font-medium text-indigo-700 dark:bg-indigo-900/40 dark:text-indigo-300">{{$post->category->name}}</span>
            <h1 class="mt-4 text-balance text-3xl font-bold leading-tight tracking-tight text-gray-900 sm:text-4xl dark:text-white">{{$post->title}}</h1>
            <p class="mt-4 text-pretty text-lg leading-relaxed text-gray-600 dark:text-gray-400">{{$post->slug}}</p>

            <div class="mt-8 flex flex-wrap items-center justify-between gap-4 border-y border-gray-200 py-4 dark:border-gray-800">
                <a href="/profile" class="flex items-center gap-3">
                    <x-avatar :initials="$post->user->getFullNameInitials()" />
                    <div class="text-sm">
                        <p class="font-medium text-gray-900 dark:text-white">{{$post->user->getFullName()}}</p>
                        <p class="text-gray-500 dark:text-gray-400">{{$post->created_at->format('d/m/y')}}</p>
                    </div>
                </a>
                <div class="flex items-center gap-1">
                    <button type="button" class="inline-flex items-center gap-1.5 rounded-lg px-3 py-2 text-sm text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800">
                        <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" /></svg>
                        128
                    </button>
                    <button type="button" aria-label="Kaydet" class="rounded-lg p-2 text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800">
                        <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" /></svg>
                    </button>
                    <button type="button" aria-label="Paylaş" class="rounded-lg p-2 text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800">
                        <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z" /></svg>
                    </button>
                </div>
            </div>
        </header>

        <img src="#" alt="Kod açık bir dizüstü bilgisayar ve kahve" class="mt-8 aspect-[16/9] w-full rounded-2xl object-cover">

        <div class="mt-10 space-y-6 text-lg leading-relaxed text-gray-700 dark:text-gray-300">
            {{$post->content}}
        </div>

        <div class="mt-10 flex flex-wrap gap-2">
            <a href="#" class="rounded-md bg-gray-100 px-2.5 py-1 text-xs font-medium text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 dark:bg-gray-800 dark:text-gray-300">#laravel</a>
            <a href="#" class="rounded-md bg-gray-100 px-2.5 py-1 text-xs font-medium text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 dark:bg-gray-800 dark:text-gray-300">#php</a>
            <a href="#" class="rounded-md bg-gray-100 px-2.5 py-1 text-xs font-medium text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 dark:bg-gray-800 dark:text-gray-300">#tailwind</a>
        </div>

        {{-- Yazar kutusu --}}
        <div class="mt-10 flex flex-col gap-4 rounded-2xl border border-gray-200 bg-white p-6 sm:flex-row sm:items-center dark:border-gray-800 dark:bg-gray-900">
            <x-avatar :initials="$post->user->getFullNameInitials()" size="lg" />
            <div class="flex-1">
                <p class="font-semibold text-gray-900 dark:text-white">{{$post->user->getFullName()}}</p>

            </div>
            <a href="/profile" class="rounded-lg border border-gray-300 px-4 py-2 text-center text-sm font-medium text-gray-900 hover:bg-gray-100 dark:border-gray-700 dark:text-white dark:hover:bg-gray-800">Profili gör</a>
        </div>

        {{-- Yorumlar --}}
        <section class="mt-12" aria-labelledby="comments-heading">
            <h2 id="comments-heading" class="text-xl font-bold text-gray-900 dark:text-white">Yorumlar (2)</h2>
            <form action="#" class="mt-6">
                <label for="comment" class="sr-only">Yorumun</label>
                <textarea id="comment" rows="4" placeholder="Düşüncelerini paylaş..."
                    class="block w-full rounded-lg border border-gray-300 bg-white p-3 text-sm text-gray-900 focus:border-indigo-600 focus:ring-indigo-600 dark:border-gray-700 dark:bg-gray-900 dark:text-white dark:placeholder-gray-500"></textarea>
                <div class="mt-3 flex justify-end">
                    <button type="submit" class="rounded-lg bg-indigo-700 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-800 focus:outline-none focus:ring-4 focus:ring-indigo-300 dark:bg-indigo-600 dark:hover:bg-indigo-700">Yorum yap</button>
                </div>
            </form>

            <ul class="mt-8 space-y-6">
                <li class="flex gap-4">
                    <x-avatar initials="EK" size="sm" />
                    <div class="flex-1 rounded-xl bg-white p-4 ring-1 ring-gray-200 dark:bg-gray-900 dark:ring-gray-800">
                        <p class="text-sm"><span class="font-medium text-gray-900 dark:text-white">Elif Kaya</span> <span class="text-gray-500 dark:text-gray-400">· 2 saat önce</span></p>
                        <p class="mt-2 text-sm leading-relaxed text-gray-700 dark:text-gray-300">Çok açıklayıcı bir yazı olmuş, özellikle Blade bileşenleri kısmı işime yaradı.</p>
                    </div>
                </li>
                <li class="flex gap-4">
                    <x-avatar initials="MD" size="sm" />
                    <div class="flex-1 rounded-xl bg-white p-4 ring-1 ring-gray-200 dark:bg-gray-900 dark:ring-gray-800">
                        <p class="text-sm"><span class="font-medium text-gray-900 dark:text-white">Mert Demir</span> <span class="text-gray-500 dark:text-gray-400">· 1 gün önce</span></p>
                        <p class="mt-2 text-sm leading-relaxed text-gray-700 dark:text-gray-300">Devamını bekliyorum, deployment kısmını da anlatır mısın?</p>
                    </div>
                </li>
            </ul>
        </section>
    </article>
@endsection
