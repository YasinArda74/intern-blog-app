@extends('layouts.app')

@php
    $categories = $posts->pluck('category')->filter()->unique('id')->values();
    $featuredPost = $posts->first();
@endphp

@section('title', trans('Homepage'))

@section('content')
    <section class="relative overflow-hidden">
        <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_85%_20%,var(--color-brand-softer),transparent_42%)]" aria-hidden="true"></div>

        <div class="relative mx-auto grid max-w-6xl gap-8 px-4 py-8 sm:px-6 sm:py-10 lg:grid-cols-12 lg:items-center lg:gap-10 lg:py-12">
            <div class="flex flex-col items-start gap-4 lg:col-span-7">
                <p class="text-sm font-medium text-fg-brand">
                    @lang(':count new articles were published this week.', ['count' => $postWeaklyCount])
                </p>
                <h1 class="max-w-3xl text-balance text-3xl font-semibold tracking-tight text-heading sm:text-5xl sm:leading-[1.1]">
                    @lang('Write down your ideas and share them with the world.')
                </h1>
                <p class="max-w-xl text-pretty text-base leading-relaxed text-body">
                    @lang('Software, travel, productivity, and more. Discover the latest posts from our community.')
                </p>
                <div class="flex flex-wrap gap-3">
                    @role('author|admin')
                        <a href="{{ route('posts.create') }}"
                           class="inline-flex items-center gap-2 rounded-base border border-transparent bg-brand px-5 py-3 text-sm font-medium text-white shadow-xs transition hover:bg-brand-strong focus:outline-none focus:ring-4 focus:ring-brand-medium">
                            <i class="fa-solid fa-pencil text-xs" aria-hidden="true"></i>
                            @lang('Start writing')
                        </a>
                    @endrole
                    <a href="#son-yazilar"
                       class="inline-flex items-center rounded-base border border-default-medium bg-neutral-primary-soft px-5 py-3 text-sm font-medium text-heading shadow-xs transition hover:bg-neutral-secondary-medium focus:outline-none focus:ring-4 focus:ring-neutral-tertiary">
                        @lang('Discover articles')
                    </a>
                </div>
            </div>

            @if ($featuredPost)
                @php($featuredReadingTime = $featuredPost->readingTimeMinutes())
                <a href="{{ route('posts.show', ['user' => $featuredPost->user->username, 'postSlug' => $featuredPost->slug]) }}"
                   class="group overflow-hidden rounded-2xl border border-default bg-neutral-primary-soft shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg focus:outline-none focus:ring-4 focus:ring-brand-medium lg:col-span-5 lg:ms-auto lg:w-full lg:max-w-sm">
                    <x-category-gradient :category="$featuredPost->category" class="flex aspect-[16/6] items-end p-4">
                        <span class="relative size-8 rounded-full bg-white/50 dark:bg-white/15" aria-hidden="true"></span>
                    </x-category-gradient>
                    <div class="flex flex-col gap-2 p-4">
                        <div class="flex items-center justify-between gap-3">
                            <span class="text-[11px] font-semibold uppercase tracking-[0.16em] text-fg-brand">@lang('Featured post')</span>
                            <x-category-badge :category="$featuredPost->category" />
                        </div>
                        <h2 class="truncate line-clamp-1 text-lg font-semibold leading-snug tracking-tight text-heading transition group-hover:text-fg-brand">
                            {{ $featuredPost->title }}
                        </h2>
                        <p class="line-clamp-2 text-sm leading-relaxed text-body">{{ $featuredPost->excerpt }}</p>
                        <div class="flex items-center gap-2 border-t border-default pt-3">
                            <x-avatar :initials="$featuredPost->user->getFullNameInitials()" size="sm" />
                            <span class="truncate text-sm font-medium text-heading">{{ $featuredPost->user->getFullName() }}</span>
                            <span class="ms-auto shrink-0 text-xs text-body">{{ trans(':count min read', ['count' => $featuredReadingTime]) }}</span>
                        </div>
                    </div>
                </a>
            @endif
        </div>
    </section>

    <section id="son-yazilar" class="mx-auto max-w-6xl scroll-mt-20 px-4 py-14 sm:px-6" aria-labelledby="latest-heading">
        <div class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-sm font-medium text-fg-brand">@lang('Discover articles')</p>
                <h2 id="latest-heading" class="mt-1 text-2xl font-semibold tracking-tight text-heading sm:text-3xl">@lang('Recent posts')</h2>
            </div>
            @if ($categories->isNotEmpty())
                <div class="flex flex-wrap gap-2" aria-label="@lang('Categories')">
                    <a href="#son-yazilar" aria-current="true"
                       class="rounded-full bg-brand px-3.5 py-1.5 text-xs font-semibold text-white shadow-xs transition hover:bg-brand-strong focus:outline-none focus:ring-4 focus:ring-brand-medium">
                        @lang('All')
                    </a>
                    @foreach ($categories as $category)
                        <x-category-badge :category="$category" class="px-3.5 py-1.5" />
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
            <div class="mt-6 flex flex-col gap-2">
                @foreach ($posts as $post)
                    @php($readingTime = $post->readingTimeMinutes())
                    <a href="{{ route('posts.show', ['user' => $post->user->username, 'postSlug' => $post->slug]) }}"
                       class="group grid grid-cols-[5rem_minmax(0,1fr)] items-center gap-x-4 rounded-2xl border border-transparent p-3 text-heading no-underline transition duration-200 hover:border-default hover:bg-neutral-primary-soft hover:shadow-sm focus:outline-none focus-visible:ring-4 focus-visible:ring-brand-medium sm:grid-cols-[7rem_minmax(0,1fr)_auto] sm:gap-6 sm:p-4">
                        <x-category-gradient :category="$post->category" class="row-span-2 flex aspect-square items-center justify-center rounded-xl sm:row-span-1">
                            <span class="relative size-8 rounded-full bg-white/50 dark:bg-white/15" aria-hidden="true"></span>
                        </x-category-gradient>
                        <div class="min-w-0">
                            <div class="mb-2 flex flex-wrap items-center gap-x-2 gap-y-1">
                                <x-category-badge :category="$post->category" />
                                <span class="text-xs text-body">{{ $post->created_at->translatedFormat('d F Y') }}</span>
                                <span class="text-xs text-body" aria-label="{{ trans(':count min read', ['count' => $readingTime]) }}">
                                    · {{ trans(':count min read', ['count' => $readingTime]) }}
                                </span>
                            </div>
                            <h3 class="text-lg font-semibold tracking-tight text-heading transition group-hover:text-fg-brand sm:text-xl">{{ $post->title }}</h3>
                            <p class="mt-1.5 line-clamp-2 text-sm leading-relaxed text-body">{{ $post->excerpt }}</p>
                        </div>
                        <div class="col-start-2 mt-3 flex min-w-0 items-center gap-3 sm:col-start-auto sm:mt-0 sm:justify-end">
                            <x-avatar :initials="$post->user->getFullNameInitials()" size="sm" />
                            <p class="truncate text-xs font-medium text-heading sm:text-sm">{{ $post->user->getFullName() }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif

        @if ($posts->hasPages())
            <div class="mt-8">
                {{ $posts->fragment('son-yazilar')->links() }}
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
