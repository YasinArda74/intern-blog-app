@extends('layouts.app')

@php
    $categories = $posts->pluck('category')->filter()->unique('id')->values();
    $highlights = [
        ['01', __('Simple and focused writing editor')],
        ['02', __('Personal profile and author page')],
        ['03', __('Flawless appearance on all devices')],
    ];
@endphp

@section('title', trans('Homepage'))

@section('content')
    <section class="relative overflow-hidden">
        <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_85%_20%,var(--color-brand-softer),transparent_42%)]" aria-hidden="true"></div>

        <div class="relative mx-auto flex max-w-6xl flex-col gap-8 px-4 py-20 sm:px-6 sm:py-28">
            <p class="text-sm font-medium text-fg-brand">
                @lang(':count new articles were published this week.', ['count' => $postWeaklyCount])
            </p>
            <h1 class="max-w-4xl text-balance text-4xl font-semibold tracking-tight text-heading sm:text-6xl sm:leading-[1.05]">
                @lang('Write down your ideas and share them with the world.')
            </h1>
            <p class="max-w-xl text-pretty text-lg leading-relaxed text-body">
                @lang('Software, travel, productivity, and more. Discover the latest posts from our community.')
            </p>
            <div class="flex flex-wrap gap-3">
                @role('author|admin')
                    <a href="{{ route('posts.create') }}"
                       class="inline-flex items-center gap-2 rounded-base border border-transparent bg-brand px-5 py-3 text-sm font-medium text-white shadow-xs hover:bg-brand-strong focus:outline-none focus:ring-4 focus:ring-brand-medium">
                        <i class="fa-solid fa-pencil text-xs" aria-hidden="true"></i>
                        @lang('Start writing')
                    </a>
                @endrole
                <a href="#son-yazilar"
                   class="inline-flex items-center rounded-base border border-default-medium bg-neutral-primary-soft px-5 py-3 text-sm font-medium text-heading shadow-xs hover:bg-neutral-secondary-medium focus:outline-none focus:ring-4 focus:ring-neutral-tertiary">
                    @lang('Discover articles')
                </a>
            </div>
        </div>
    </section>

    <section class="border-y border-default" aria-label="@lang('About')">
        <div class="mx-auto grid max-w-6xl gap-10 px-4 py-12 sm:px-6 md:grid-cols-3">
            @foreach ($highlights as [$number, $label])
                <div class="flex gap-4">
                    <span class="text-sm font-semibold text-fg-brand">{{ $number }}</span>
                    <p class="text-base font-medium leading-relaxed text-heading">{{ $label }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <section id="son-yazilar" class="mx-auto max-w-6xl px-4 py-14 sm:px-6" aria-labelledby="latest-heading">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <h2 id="latest-heading" class="text-2xl font-semibold tracking-tight text-heading">@lang('Recent posts')</h2>
            @if ($categories->isNotEmpty())
                <div class="flex flex-wrap gap-2">
                    @foreach ($categories as $category)
                        <span class="rounded-full bg-neutral-secondary-medium px-3 py-1 text-xs font-medium text-body">{{ $category->name }}</span>
                    @endforeach
                </div>
            @endif
        </div>

        @if ($posts->isEmpty())
            <div class="mt-8 rounded-base border border-dashed border-default-medium px-6 py-16 text-center">
                <h3 class="text-lg font-semibold text-heading">@lang('No published articles yet.')</h3>
                <p class="mx-auto mt-2 max-w-md text-sm leading-relaxed text-body">@lang("Write down your ideas, publish them when you're ready.")</p>
            </div>
        @else
            <div class="mt-4 divide-y divide-default">
                @foreach ($posts as $post)
                    <a href="{{ route('posts.show', ['user' => $post->user->username, 'postSlug' => $post->slug]) }}"
                       class="group grid gap-4 py-7 text-heading no-underline sm:grid-cols-12 sm:items-center">
                        <div class="sm:col-span-3">
                            <p class="text-sm font-medium text-fg-brand">{{ $post->category->name }}</p>
                            <p class="mt-1 text-sm text-body">{{ $post->created_at->translatedFormat('d F Y') }}</p>
                        </div>
                        <div class="sm:col-span-6">
                            <h3 class="text-xl font-semibold tracking-tight text-heading transition group-hover:text-fg-brand">{{ $post->title }}</h3>
                            <p class="mt-2 line-clamp-2 text-sm leading-relaxed text-body">{{ $post->excerpt }}</p>
                        </div>
                        <div class="flex items-center gap-3 sm:col-span-3 sm:justify-end">
                            <x-avatar :initials="$post->user->getFullNameInitials()" size="sm" />
                            <p class="truncate text-sm font-medium text-heading">{{ $post->user->getFullName() }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif

        @if ($posts->hasPages())
            <div class="mt-8">
                {{ $posts->links() }}
            </div>
        @endif
    </section>

    <section class="border-t border-default">
        <div class="mx-auto flex max-w-6xl flex-col gap-6 px-4 py-12 sm:px-6 lg:flex-row lg:items-center lg:justify-between">
            <div class="max-w-md">
                <h2 class="text-xl font-semibold text-heading">@lang('Subscribe to the newsletter')</h2>
                <p class="mt-2 text-sm leading-relaxed text-body">@lang('The best articles of the week in your inbox every Sunday.')</p>
            </div>
            <form action="#" class="flex w-full max-w-md flex-col gap-3 sm:flex-row">
                <label for="newsletter-email" class="sr-only">@lang('Email')</label>
                <input type="email" id="newsletter-email" placeholder="name@example.com"
                       class="block w-full rounded-base border border-default-medium bg-neutral-primary-soft px-3 py-2.5 text-sm text-heading shadow-xs placeholder:text-body focus:border-brand focus:ring-brand">
                <button type="submit"
                        class="shrink-0 rounded-base bg-brand px-5 py-2.5 text-sm font-medium text-white shadow-xs hover:bg-brand-strong focus:outline-none focus:ring-4 focus:ring-brand-medium">
                    @lang('Subscribe')
                </button>
            </form>
        </div>
    </section>
@endsection
