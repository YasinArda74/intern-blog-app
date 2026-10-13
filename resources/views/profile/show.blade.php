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
                    <x-avatar :initials="$user->getFullNameInitials()" size="xl" />
                    <div class="sm:pb-2">
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{$user->firstname}}</h1>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{'@'}}{{$user->username}}</p>
                    </div>
                </div>
                <div class="flex gap-2 sm:pb-2">
                    <a href="{{route('profile.edit')}}" class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:text-white dark:hover:bg-gray-700">@lang('Edit profile') </a>
                    @role('author|admin')
                        <a href="{{ route('posts.create') }}" class="rounded-lg bg-indigo-700 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-800 dark:bg-indigo-600 dark:hover:bg-indigo-700">@lang('Write something')</a>
                    @endrole
                </div>
            </div>

            <p class="mt-6 max-w-2xl leading-relaxed text-gray-600 dark:text-gray-400">Full-stack geliştirici. Laravel, Tailwind ve sade arayüzler hakkında yazıyorum. Boş zamanlarımda kitap okuyor ve fotoğraf çekiyorum.</p>

            <dl class="mt-6 flex flex-wrap gap-8 text-sm">
                @role('admin|author')
                    <div><dt class="text-gray-500 dark:text-gray-400">@lang('Writing')</dt><dd class="text-lg font-semibold text-gray-900 dark:text-white">{{ Auth::user()?->posts()->count() ?? 0 }}</dd></div>
                @endrole
                <div><dt class="text-gray-500 dark:text-gray-400">@lang('Registration Date')</dt><dd class="text-lg font-semibold text-gray-900 dark:text-white">{{$user->created_at->format('d/m/y')}}</dd></div>
            </dl>
        </div>

        <div class="border-b border-gray-200 dark:border-gray-800">
            <ul class="mx-auto flex max-w-6xl gap-6 px-4 text-sm font-medium sm:px-6">
                @role('author|admin')
                    <li><a href="#" aria-current="page" class="inline-block border-b-2 border-indigo-700 py-3 text-indigo-700 dark:border-indigo-400 dark:text-indigo-400">@lang('Articles')<span class="ms-1 rounded bg-indigo-50 px-1.5 text-xs dark:bg-indigo-900/40">{{ Auth::user()?->posts()->count() ?? 0 }}</span></a></li>
                @endrole
                <li><a href="#" aria-current="page" class="inline-block border-b-2 border-transparent py-3 text-gray-500 hover:border-gray-300 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">@lang('Saved items')</a></li>
            </ul>
        </div>
    </section>

    <div class="mx-auto max-w-6xl px-4 py-10 sm:px-6">
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 ">
                @foreach($posts as $post)
                    <div class="group flex flex-col overflow-hidden rounded-xl border border-gray-200 bg-white transition hover:shadow-md dark:border-gray-800 dark:bg-gray-900">
                        <a href="{{ route('posts.show', $post->id) }}">
                            <x-post-card :post="$post" />
                        </a>

                        <div class="p-3 flex items-center gap-3 text-sm">
                            <x-avatar :initials="$post->user->getFullNameInitials()" size="sm" />
                            <p class="font-medium text-gray-900 dark:text-white">{{$post->user->firstname}}</p>
                            <p class="text-gray-500 dark:text-gray-400">{{ $post->created_at->format('d/m/y H:i') }} </p>
                        </div>
                    </div>
                @endforeach
            </div>
    </div>
@endsection
