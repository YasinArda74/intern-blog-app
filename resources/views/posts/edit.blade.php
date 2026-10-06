@extends('layouts.app')

@section('title', 'Yazıyı düzenle')

@section('content')
    <div class="mx-auto max-w-6xl px-4 py-10 sm:px-6">
        <div class="mb-8">
            <a href="{{ route('posts.update', $post) }}"
               class="inline-flex items-center gap-1 text-sm text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                     aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/>
                </svg>
                Yazıya dön
            </a>
            <h1 class="mt-3 text-3xl font-bold tracking-tight text-gray-900 dark:text-white">Yazıyı düzenle</h1>
        </div>

        @include('posts.form', ['action' => route('posts.update', $post)])
    </div>
@endsection
