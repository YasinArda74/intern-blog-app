@extends('layouts.app')

@section('title', trans('Homepage'))

@section('content')
    {{-- Hero --}}
    <section class="border-b border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-900">
        <div class="mx-auto max-w-6xl px-4 py-14 sm:px-6 lg:py-20">
            <div class="max-w-2xl">
                <span class="inline-flex items-center gap-2 rounded-full bg-indigo-50 px-3 py-1 text-xs font-medium text-indigo-700 dark:bg-indigo-900/40 dark:text-indigo-300">
                    <span class="size-1.5 rounded-full bg-indigo-600"></span>

                    @lang(':count new articles were published this week.', ['count' => $postWeaklyCount])
                </span>

                <h1 class="mt-5 text-balance text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl dark:text-white">
                    @lang('Write down your ideas and share them with the world.')
                </h1>

                <p class="mt-4 text-pretty text-lg leading-relaxed text-gray-600 dark:text-gray-400">
                    @lang('Software, travel, productivity, and more. Discover the latest posts from our community.')
                </p>

                <div class="mt-8 flex flex-wrap gap-3">
                    @role('author|admin')
                        <a href="{{route('posts.create')}}"
                           class="rounded-lg bg-indigo-700 px-5 py-3 text-sm font-semibold text-white hover:bg-indigo-800 focus:outline-none focus:ring-4 focus:ring-indigo-300 dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">
                            <i class="fa-solid fa-pencil me-2 text-xs"></i>
                            @lang('Start writing')
                        </a>
                    @endrole
                    <a href="#son-yazilar"
                       class="rounded-lg border border-gray-300 bg-white px-5 py-3 text-sm font-semibold text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:text-white dark:hover:bg-gray-700">
                        @lang('Discover articles')
                    </a>
                </div>
            </div>
        </div>
    </section>


    <div class="mx-auto max-w-6xl px-4 py-12 sm:px-6">
        {{-- Öne çıkan yazı --}}
        <article
            class="group grid overflow-hidden rounded-2xl border border-gray-200 bg-white md:grid-cols-2 dark:border-gray-800 dark:bg-gray-900">
            <a href="#"
               class="block aspect-[16/10] overflow-hidden bg-gray-100 md:aspect-auto dark:bg-gray-800">
                <img src="/images/post-1.png" alt=""
                     class="size-full object-cover transition duration-300 group-hover:scale-105">
            </a>
            <div class="flex flex-col justify-center p-6 sm:p-10">
                <div class="flex items-center gap-2 text-xs font-medium">
                    <span class="rounded-md bg-indigo-700 px-2.5 py-0.5 text-white">Öne çıkan</span>
                    <span
                        class="rounded-md bg-indigo-50 px-2.5 py-0.5 text-indigo-700 dark:bg-indigo-900/40 dark:text-indigo-300">Yazılım</span>
                </div>
                <h2 class="mt-4 text-balance text-2xl font-bold leading-tight text-gray-900 sm:text-3xl dark:text-white">
                    <a href="#" class="hover:text-indigo-700 dark:hover:text-indigo-400">Laravel 13 ile
                        modern bir blog altyapısı kurmak</a>
                </h2>
                <p class="mt-3 leading-relaxed text-gray-600 dark:text-gray-400">Route yapısından Blade bileşenlerine
                    kadar, sıfırdan sade ve hızlı bir blog nasıl kurulur adım adım inceliyoruz.</p>
                <div class="mt-6 flex items-center gap-3">
                    <x-avatar initials="AY"/>
                    <div class="text-sm">
                        <p class="font-medium text-gray-900 dark:text-white">Ahmet Yılmaz</p>
                        <p class="text-gray-500 dark:text-gray-400">30 Eylül 2026 · 8 dk okuma</p>
                    </div>
                </div>
            </div>
        </article>

        <div class="mt-14 grid gap-10 lg:grid-cols-3">
            {{-- Yazı listesi --}}
            <section id="son-yazilar" class="lg:col-span-2" aria-labelledby="latest-heading">
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <h2 id="latest-heading" class="text-xl font-bold text-gray-900 dark:text-white">@lang('Recent posts')</h2>
                    <div class="flex flex-wrap gap-2 text-sm">
                        <a href="#"
                           class="rounded-full bg-gray-900 px-3 py-1 font-medium text-white dark:bg-white dark:text-gray-900">@lang('All')</a>
                        <a href="#"
                           class="rounded-full border border-gray-200 bg-white px-3 py-1 text-gray-700 hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:hover:bg-gray-800">Yazılım</a>
                        <a href="#"
                           class="rounded-full border border-gray-200 bg-white px-3 py-1 text-gray-700 hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:hover:bg-gray-800">Seyahat</a>
                        <a href="#"
                           class="rounded-full border border-gray-200 bg-white px-3 py-1 text-gray-700 hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:hover:bg-gray-800">Üretkenlik</a>
                    </div>
                </div>

                <div>
                    <div class="mt-6 grid gap-6 sm:grid-cols-2">
                        @foreach($posts as $post)
                            <div class="group flex flex-col overflow-hidden rounded-xl border border-gray-200 bg-white transition hover:shadow-md dark:border-gray-800 dark:bg-gray-900">
                                <a href="{{ route('posts.show', $post->id) }}">
                                    @component('components.post-card', [
                                        'image' => '/images/post-1.png',
                                        'post' => $post
                                    ])@endcomponent
                                </a>

                                <div class="p-3 flex items-center gap-3 text-sm">
                                    <x-avatar :initials="$post->user->getFullNameInitials()" size="sm" />

                                    <p class="font-medium text-gray-900 dark:text-white">{{$post->user->firstname}}</p>

                                    <p class="text-gray-500 dark:text-gray-400">{{ $post->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-5">
                        {{ $posts->links() }}
                    </div>
                </div>
            </section>

            {{-- Kenar çubuğu --}}
            <aside class="space-y-6">
                <div class="rounded-xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900">
                    <h2 class="font-semibold text-gray-900 dark:text-white">@lang('Popular posts')</h2>
                    <ol class="mt-4 space-y-4">
                        <li class="flex gap-3">
                            <span class="text-2xl font-bold text-gray-200 dark:text-gray-700">01</span>
                            <div>
                                <a href="#"
                                   class="text-sm font-medium leading-snug text-gray-900 hover:text-indigo-700 dark:text-white dark:hover:text-indigo-400">Laravel
                                    13'te gelen yenilikler</a>
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Ahmet Yılmaz · 2,4B okuma</p>
                            </div>
                        </li>
                    </ol>
                </div>

                <div class="rounded-xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900">
                    <h2 class="font-semibold text-gray-900 dark:text-white">@lang('Tags')</h2>
                    <div class="mt-4 flex flex-wrap gap-2">
                        @foreach (['laravel', 'php', 'tailwind', 'seyahat', 'tasarım', 'kariyer', 'kitap', 'üretkenlik'] as $tag)
                            <a href="#"
                               class="rounded-md bg-gray-100 px-2.5 py-1 text-xs font-medium text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-indigo-900/40 dark:hover:text-indigo-300">#{{ $tag }}</a>
                        @endforeach
                    </div>
                </div>

                <div class="rounded-xl bg-indigo-700 p-6 text-white">
                    <h2 class="font-semibold">@lang('Subscribe to the newsletter')</h2>
                    <p class="mt-2 text-sm text-indigo-100">@lang('The best articles of the week in your inbox every Sunday.')</p>
                    <form action="#" class="mt-4 space-y-3">
                        <label for="newsletter-email" class="sr-only">E-posta adresi</label>
                        <input type="email" id="newsletter-email" placeholder="ornek@site.com"
                               class="block w-full rounded-lg border-0 bg-white/15 p-2.5 text-sm text-white placeholder-indigo-200 focus:ring-2 focus:ring-white">
                        <button type="submit"
                                class="w-full rounded-lg bg-white px-4 py-2.5 text-sm font-semibold text-indigo-700 hover:bg-indigo-50">
                                @lang('Subscribe')
                        </button>
                    </form>
                </div>
            </aside>
        </div>
    </div>
@endsection
