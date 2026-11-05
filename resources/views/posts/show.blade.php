@extends('layouts.app')

@section('title', $post->title)

@php
@endphp
@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('btn-delete-post')?.addEventListener('click', () => {
                if (!confirm('@lang('Are you sure you want to delete this post?')')) return;

                submitForm('#delete-post-form',
                    '{{ route('posts.delete', [$post->user, $post->slug]) }}',
                    'DELETE');
            });
            document.getElementById('btn-create-comment-form')?.addEventListener('click', () => {
                submitForm('#create-comment-form', '{{ route('comment.store') }}', 'POST');
            });

            document.querySelectorAll('#btn-delete-comment').forEach(btn => {
                btn.addEventListener('click', () => {
                    if (!confirm('@lang('Are you sure you want to delete this comment?')')) return;

                    submitForm('#delete-comment-form',
                        '{{ route('comment.delete', ':id') }}'.replace(':id', btn.dataset.commentId),
                        'DELETE');
                });
            });
        });
    </script>
@endsection

@section('content')
    <div class="mx-auto flex w-full min-w-0 max-w-6xl flex-col gap-8 px-4 py-10 sm:px-6 sm:py-14">
        <article class="min-w-0 wrap-break-word overflow-hidden rounded-base border border-default bg-neutral-primary-soft shadow-xs">
            <img src="{{ asset('images/post-cover.svg') }}" alt="@lang('Cover image')" class="aspect-[2/1] w-full object-cover sm:aspect-[2.6/1]">

            <div class="px-6 pb-8 sm:px-8">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                    <div class="flex items-start gap-4">
                        <x-avatar :initials="$post->user->getFullNameInitials()" size="xl" class="relative z-10 -mt-16 shadow-xs" />
                        <div class="min-w-0 pt-4">
                            <p class="text-2xl font-semibold tracking-tight text-heading">{{ $post->user->getFullName() }}</p>
                            <p class="mt-1 text-sm text-body">{{ '@'.$post->user->username }} · {{ $post->created_at->translatedFormat('d F Y') }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2" >
                        @if ($authUser?->id === $post->user_id)
                            <a href="{{ route('posts.edit', [$authUser->username, $post->slug]) }}"
                                    class="inline-flex shrink-0 items-center gap-2 self-start rounded-base border border-transparent bg-brand px-4 py-2.5 text-sm font-medium text-white shadow-xs hover:bg-brand-strong focus:outline-none focus:ring-4 focus:ring-brand-medium sm:mt-4">
                                <i class="fa-solid fa-pen text-xs" aria-hidden="true"></i>
                                @lang('Edit post')
                            </a>
                            <form id="delete-post-form">
                                <button type="button" id="btn-delete-post"
                                        class="inline-flex shrink-0 items-center gap-2 self-start rounded-base border border-transparent bg-danger px-4 py-2.5 text-sm font-medium text-white shadow-xs hover:opacity-90 focus:outline-none focus:ring-4 sm:mt-4">
                                    <i class="fa-solid fa-trash-can"></i>
                                    @lang('Delete')
                                </button>
                            </form>
                        @endif
                    </div>
                </div>

                <header class="mt-8 flex flex-col gap-4">
                    <p class="text-sm font-medium text-fg-brand">{{ $post->category->name }}</p>
                    <h1 class="text-balance text-4xl font-semibold tracking-tight text-heading sm:text-5xl sm:leading-[1.1]">{{ $post->title }}</h1>

                    @if (filled($post->excerpt))
                        <p class="max-w-3xl text-pretty text-lg leading-relaxed text-body">{{ $post->excerpt }}</p>
                    @endif
                </header>

                @if (($content = $post->contentHtml()) !== '')
                    <div class="prose prose-lg mt-8 max-w-full wrap-break-word prose-headings:font-semibold prose-headings:tracking-tight prose-a:text-fg-brand">
                        {!! $content !!}
                    </div>
                @endif
            </div>
        </article>

        <section aria-labelledby="comments-heading" class="flex min-w-0 flex-col gap-4">
            <div>
                <h2 id="comments-heading" class="text-xl font-semibold tracking-tight text-heading">@lang('Comments')</h2>
                <p class="mt-1 text-sm text-body">@lang('Share what you think about this article.')</p>
            </div>

            <form id="create-comment-form" class="rounded-base border border-default bg-neutral-primary-soft p-5 shadow-xs sm:p-6" onsubmit="return false;">
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <label for="comment" class="mb-2.5 block text-sm font-medium text-heading">@lang('Write a comment')</label>
                <textarea id="content" name="content" rows="4" placeholder="@lang('Write your comment here')"
                          class="block w-full rounded-base border border-default-medium bg-neutral-secondary-medium px-3 py-2.5 text-sm text-heading shadow-xs placeholder:text-body focus:border-brand focus:ring-brand"></textarea>
                <div class="mt-2 flex justify-end">
                    <button type="button"
                            id="btn-create-comment-form"
                            class="inline-flex items-center justify-center gap-2 rounded-base border border-transparent bg-brand px-4 py-2.5 text-sm font-medium text-white shadow-xs hover:bg-brand-strong focus:outline-none focus:ring-4 focus:ring-brand-medium">
                        <i class="fa-solid fa-paper-plane text-xs" aria-hidden="true"></i>
                        @lang('Send')
                    </button>
                </div>
            </form>
                <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                    @foreach ($comments as $comment)
                        <article class="min-w-0 wrap-break-word rounded-base border border-default bg-neutral-primary-soft p-5 shadow-xs">
                            <div class="flex items-center gap-3">
                                <x-avatar :initials="$comment->user->getFullNameInitials()" size="sm" />
                                <div class="text-sm">
                                    <p class="font-medium text-heading">{{ $comment->user->getFullName() }}</p>
                                    <p class="text-body">{{ $comment->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <p class="mt-4 text-sm leading-relaxed text-body">{{ $comment->content }}</p>
                            @if ($authUser?->id === $comment->user_id)
                                    <button type="button" data-comment-id="{{ $comment->id }}" id="btn-delete-comment"
                                            class="mt-4 inline-flex shrink-0 items-center gap-2 self-start rounded-base border border-transparent bg-danger px-4 py-2.5 text-sm font-medium text-white shadow-xs hover:opacity-90 focus:outline-none focus:ring-4">
                                        <i class="fa-solid fa-trash-can"></i>
                                        @lang('Delete')
                                    </button>
                            @endif
                        </article>
                    @endforeach
                </div>
            <form id="delete-comment-form"></form>
        </section>
    </div>
@endsection
