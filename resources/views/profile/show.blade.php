@extends('layouts.app')

@php
    $articleCount = $published_posts->total();
@endphp

@section('title', $authUser->getFullName())

@section('content')
    <section>
        <div class="bg-neutral-primary-soft">
            <div class="relative h-40 overflow-hidden bg-brand sm:h-52" aria-hidden="true">
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_80%_15%,rgba(255,255,255,0.35),transparent_46%)]"></div>
                <div class="absolute -bottom-20 -start-10 size-64 rounded-full bg-white/10"></div>
                <div class="absolute -top-16 end-10 size-48 rounded-full bg-white/10"></div>
            </div>

            <div class="mx-auto max-w-6xl px-4 sm:px-6">
                <div class="flex flex-col gap-5 pb-8 sm:flex-row sm:items-start sm:justify-between">
                    <div class="flex items-start gap-4">
                        <x-avatar :initials="$authUser->getFullNameInitials()" size="xl" class="relative z-10 -mt-14 shrink-0 shadow-xs" />
                        <div class="min-w-0 pt-4">
                            <h1 class="text-2xl font-bold tracking-tight text-heading sm:text-3xl">{{ $authUser->getFullName() }}</h1>
                            <p class="mt-1 text-sm text-body">{{ '@'.$authUser->username }}</p>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-2 pt-4">
                        <a href="{{ route('profile.edit') }}"
                           class="inline-flex items-center gap-2 rounded-base border border-default-medium bg-neutral-secondary-medium px-4 py-2.5 text-sm font-medium text-body shadow-xs hover:bg-neutral-tertiary-medium hover:text-heading focus:outline-none focus:ring-4 focus:ring-neutral-tertiary">
                            <i class="fa-solid fa-pen text-xs" aria-hidden="true"></i>
                            @lang('Edit profile')
                        </a>
                        @role('author|admin')
                            <a href="{{ route('posts.create') }}"
                               class="inline-flex items-center gap-2 rounded-base border border-transparent bg-brand px-4 py-2.5 text-sm font-medium text-white shadow-xs hover:bg-brand-strong focus:outline-none focus:ring-4 focus:ring-brand-medium">
                                <i class="fa-solid fa-pencil text-xs" aria-hidden="true"></i>
                                @lang('Write something')
                            </a>
                        @endrole
                    </div>
                </div>

                <div class="flex flex-col gap-6 pb-8">
                    @if (filled($authUser->about))
                        <p class="max-w-2xl text-base leading-relaxed text-body">{{ $authUser->about }}</p>
                    @endif

                    <dl class="flex flex-wrap gap-3">
                        <div class="rounded-base border border-default bg-neutral-secondary-soft px-4 py-3">
                            <dt class="text-sm text-body">@lang('Writing')</dt>
                            <dd class="mt-1 text-2xl font-semibold text-heading">{{ $articleCount }}</dd>
                        </div>
                        <div class="rounded-base border border-default bg-neutral-secondary-soft px-4 py-3">
                            <dt class="text-sm text-body">@lang('Registration Date')</dt>
                            <dd class="mt-1 text-lg font-semibold whitespace-nowrap text-heading">{{ $authUser->created_at->translatedFormat('d F Y') }}</dd>
                        </div>
                    </dl>
                </div>
            </div>

            <div class="border-t border-default">
                <ul class="mx-auto flex max-w-6xl gap-1 px-4 text-sm font-medium sm:px-6">
                    <li>
                        <a href="{{ route('profile.show') }}" @if ($activeTab === 'articles') aria-current="page" @endif
                           @class([
                               'inline-flex items-center gap-2 border-b-2 px-3 py-3',
                               'border-brand text-fg-brand' => $activeTab === 'articles',
                               'border-transparent text-body hover:border-default-medium hover:text-heading' => $activeTab !== 'articles',
                           ])>
                            @lang('Articles')
                            <span class="rounded-base bg-brand-soft px-1.5 py-0.5 text-xs font-medium text-fg-brand-strong">{{ $articleCount }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="#"
                           class="inline-block border-b-2 border-transparent px-3 py-3 text-body hover:border-default-medium hover:text-heading">
                            @lang('Saved items')
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('profile.show', ['tab' => 'scheduled']) }}" @if ($activeTab === 'scheduled') aria-current="page" @endif
                           @class([
                               'inline-flex items-center gap-2 border-b-2 px-3 py-3',
                               'border-brand text-fg-brand' => $activeTab === 'scheduled',
                               'border-transparent text-body hover:border-default-medium hover:text-heading' => $activeTab !== 'scheduled',
                           ])>
                            Planlanmış
                            <span class="rounded-base bg-brand-soft px-1.5 py-0.5 text-xs font-medium text-fg-brand-strong">{{ $scheduled_posts->total() }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="mx-auto max-w-6xl px-4 py-10 sm:px-6">
            @if ($activeTab === 'scheduled')
                @if ($scheduled_posts->isEmpty())
                    <div class="rounded-base border border-dashed border-default-medium bg-neutral-primary-soft px-6 py-16 text-center shadow-xs">
                        <span class="mx-auto flex size-12 items-center justify-center rounded-full bg-brand-soft text-fg-brand">
                            <i class="fa-regular fa-calendar" aria-hidden="true"></i>
                        </span>
                        <h2 class="mt-4 text-lg font-semibold text-heading">Planlanmış yazı yok</h2>
                        <p class="mx-auto mt-2 max-w-md text-sm leading-relaxed text-body">Yayınlanması için ileri bir tarih belirlediğiniz yazılar burada görünür.</p>
                        @role('author|admin')
                            <a href="{{ route('posts.create') }}"
                               class="mt-6 inline-flex items-center gap-2 rounded-base border border-transparent bg-brand px-4 py-2.5 text-sm font-medium text-white shadow-xs hover:bg-brand-strong focus:outline-none focus:ring-4 focus:ring-brand-medium">
                                <i class="fa-solid fa-pencil text-xs" aria-hidden="true"></i>
                                @lang('Write something')
                            </a>
                        @endrole
                    </div>
                @else
                    <a class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach ($scheduled_posts as $post)
                            <article class="group flex flex-col overflow-hidden rounded-base border border-default bg-neutral-primary-soft shadow-xs transition hover:shadow-md">
                                <a href="{{ route('posts.show', ['user' => $post->user->username, 'postSlug' => $post->slug]) }}" class="flex flex-1 flex-col">
                                    @component('components.post-card', [
                                        'image' => '/images/post-1.png',
                                        'post' => $post,
                                    ])@endcomponent
                                </a>
                                <div class="flex items-center gap-2 border-t border-default px-5 py-3 text-sm text-body">
                                    <i class="fa-regular fa-calendar text-xs" aria-hidden="true"></i>
                                    <span>Yayınlanma zamanı: {{ \Illuminate\Support\Carbon::parse($post->scheduled_at)->translatedFormat('d F Y H:i') }}</span>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    @if ($scheduled_posts->hasPages())
                        <div class="mt-8">
                            {{ $scheduled_posts->links() }}
                        </div>
                    @endif
                @endif
            @elseif ($published_posts->isEmpty())
                <div class="rounded-base border border-dashed border-default-medium bg-neutral-primary-soft px-6 py-16 text-center shadow-xs">
                    <span class="mx-auto flex size-12 items-center justify-center rounded-full bg-brand-soft text-fg-brand">
                        <i class="fa-solid fa-feather-pointed" aria-hidden="true"></i>
                    </span>
                    <h2 class="mt-4 text-lg font-semibold text-heading">@lang('No published articles yet.')</h2>
                    <p class="mx-auto mt-2 max-w-md text-sm leading-relaxed text-body">@lang("Write down your ideas, publish them when you're ready.")</p>
                    @role('author|admin')
                        <a href="{{ route('posts.create') }}"
                           class="mt-6 inline-flex items-center gap-2 rounded-base border border-transparent bg-brand px-4 py-2.5 text-sm font-medium text-white shadow-xs hover:bg-brand-strong focus:outline-none focus:ring-4 focus:ring-brand-medium">
                            <i class="fa-solid fa-pencil text-xs" aria-hidden="true"></i>
                            @lang('Write something')
                        </a>
                    @endrole
                </div>
            @else
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($published_posts as $post)
                        <article class="group flex flex-col overflow-hidden rounded-base border border-default bg-neutral-primary-soft shadow-xs transition hover:shadow-md">
                            <a href="{{ route('posts.show', ['user' => $post->user->username, 'postSlug' => $post->slug]) }}" class="flex flex-1 flex-col">
                                @component('components.post-card', [
                                    'image' => '/images/post-1.png',
                                    'post' => $post,
                                ])@endcomponent
                            </a>
                            <div class="flex items-center gap-2 border-t border-default px-5 py-3 text-sm text-body">
                                <i class="fa-regular fa-clock text-xs" aria-hidden="true"></i>
                                <time datetime="{{ $post->created_at->toAtomString() }}">{{ $post->created_at->diffForHumans() }}</time>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $published_posts->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection
