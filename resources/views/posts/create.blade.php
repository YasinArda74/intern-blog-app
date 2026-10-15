@extends('layouts.app')

@php
    $field = 'block w-full rounded-base border bg-neutral-secondary-medium px-3 py-2.5 text-sm text-heading shadow-xs placeholder:text-body focus:border-brand focus:ring-brand';
    $fieldOk = 'border-default-medium';
    $fieldBad = 'border-danger bg-danger-soft focus:border-danger focus:ring-danger-medium';
    $scheduleEnabled = (bool) old('published_at_feature');
@endphp

@section('title', __('Create a new post'))

@section('content')
    <div class="mx-auto max-w-6xl px-4 py-8 pb-28 sm:px-6 sm:py-12 lg:pb-12">
        <div class="mb-8">
            <a href="{{ route('home') }}"
               class="inline-flex items-center gap-2 text-sm font-medium text-fg-brand hover:underline">
                <i class="fa-solid fa-arrow-left text-xs" aria-hidden="true"></i>
                @lang('Give up')
            </a>
            <h1 class="mt-3 text-3xl font-bold tracking-tight text-heading">@lang('Create a new post')</h1>
            <p class="mt-2 max-w-2xl text-sm text-body">@lang("Write down your ideas, publish them when you're ready.")</p>
        </div>

        @if ($errors->any())
            <div class="mb-6 flex items-start gap-3 rounded-base border border-danger-subtle bg-danger-soft p-4 text-sm text-fg-danger-strong" role="alert">
                <i class="fa-solid fa-circle-exclamation mt-0.5" aria-hidden="true"></i>
                <ul class="space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="create-post-form" action="{{ route('posts.create') }}" method="POST" class="grid items-start gap-6 lg:grid-cols-3">
            @csrf

            <div class="space-y-6 lg:col-span-2">
                <section class="rounded-base border border-default bg-neutral-primary-soft p-5 shadow-xs sm:p-6">
                    <label for="title" class="mb-2.5 block text-sm font-medium text-heading">@lang('Title')</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" required maxlength="255"
                           placeholder="{{ __('Give your article an attention-grabbing title.') }}"
                           @error('title') aria-invalid="true" aria-describedby="title-error" @enderror
                           class="block w-full border-0 bg-transparent p-0 text-2xl font-semibold text-heading placeholder:text-body-subtle focus:ring-0">
                    @error('title')
                        <p id="title-error" class="mt-2 text-sm text-fg-danger">{{ $message }}</p>
                    @enderror

                    <hr class="my-6 border-default">

                    <p class="mb-2.5 text-sm font-medium text-heading">@lang('Article content')</p>
                    @include('posts.partials._tiptap-editor')
                    @error('content')
                        <p class="mt-2 text-sm text-fg-danger">{{ $message }}</p>
                    @enderror

                    <div class="mt-6">
                        <label for="excerpt" class="mb-2.5 block text-sm font-medium text-heading">@lang('Brief summary')</label>
                        <textarea id="excerpt" name="excerpt" rows="3" required
                                  placeholder="{{ __('The brief description readers will see in the list') }}"
                                  @error('excerpt') aria-invalid="true" aria-describedby="excerpt-error" @enderror
                                  class="{{ $field }} {{ $errors->has('excerpt') ? $fieldBad : $fieldOk }}">{{ old('excerpt') }}</textarea>
                        @error('excerpt')
                            <p id="excerpt-error" class="mt-2 text-sm text-fg-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </section>
            </div>

            <aside class="space-y-6 lg:sticky lg:top-24">
                <section class="rounded-base border border-default bg-neutral-primary-soft p-5 shadow-xs">
                    <h2 class="text-base font-semibold text-heading">@lang('Publish')</h2>
                    <p class="mt-1 text-sm text-body">@lang('Everyone can see.')</p>

                    <div class="mt-5 hidden flex-col gap-3 lg:flex">
                        <button type="submit"
                                class="inline-flex w-full items-center justify-center gap-2 rounded-base border border-transparent bg-brand px-4 py-2.5 text-sm font-medium text-white shadow-xs hover:bg-brand-strong focus:outline-none focus:ring-4 focus:ring-brand-medium">
                            <i class="fa-solid fa-paper-plane text-xs" aria-hidden="true"></i>
                            @lang('Publish')
                        </button>
                        <a href="{{ route('home') }}"
                           class="inline-flex w-full items-center justify-center rounded-base border border-default-medium bg-neutral-secondary-medium px-4 py-2.5 text-sm font-medium text-body shadow-xs hover:bg-neutral-tertiary-medium hover:text-heading focus:outline-none focus:ring-4 focus:ring-neutral-tertiary">
                            @lang('Give up')
                        </a>
                    </div>
                </section>

                <section class="space-y-5 rounded-base border border-default bg-neutral-primary-soft p-5 shadow-xs">
                    <div>
                        <label for="category_slug" class="mb-2.5 block text-sm font-medium text-heading">@lang('Category')</label>
                        <select id="category_slug" name="category_slug" required
                                @error('category_id') aria-invalid="true" aria-describedby="category-error" @enderror
                                class="{{ $field }} {{ $errors->has('category_id') ? $fieldBad : $fieldOk }}">
                            <option value="">@lang('Select category')</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->slug }}" @selected(old('category_slug') === $category->slug)>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p id="category-error" class="mt-2 text-sm text-fg-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="published_at_feature" class="flex cursor-pointer items-start rounded-base border border-default bg-neutral-primary-soft shadow-xs">
                            <input id="published_at_feature" type="checkbox" name="published_at_feature" value="on"
                                   @checked($scheduleEnabled)
                                   class="ms-4 mt-5 size-4 rounded-xs border border-default-medium bg-neutral-secondary-medium text-brand focus:ring-2 focus:ring-brand-soft">
                            <span class="py-4 pe-4 ps-3">
                                <span class="block text-sm font-medium text-heading">@lang('Publish later')</span>
                                <span class="mt-1 block text-sm font-normal text-body">@lang('The post goes live on the date you choose.')</span>
                            </span>
                        </label>

                        <div id="scheduled-date-container" @class(['mt-4', 'hidden' => ! $scheduleEnabled])>
                            <label for="scheduled_at" class="mb-2.5 block text-sm font-medium text-heading">@lang('Publication date')</label>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3">
                                    <i class="fa-regular fa-calendar text-sm text-body" aria-hidden="true"></i>
                                </div>
                                <input id="scheduled_at" type="date" name="scheduled_at"
                                       value="{{ old('scheduled_at') }}"
                                       min="{{ now()->addDay()->toDateString() }}"
                                       @error('scheduled_at') aria-invalid="true" aria-describedby="scheduled-at-error" @enderror
                                       class="block w-full rounded-base border bg-neutral-secondary-medium py-2.5 ps-9 pe-3 text-sm text-heading shadow-xs focus:border-brand focus:ring-brand {{ $errors->has('scheduled_at') ? $fieldBad : $fieldOk }}">
                            </div>
                            @error('scheduled_at')
                                <p id="scheduled-at-error" class="mt-2 text-sm text-fg-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </section>
            </aside>
        </form>
    </div>

    <div class="fixed inset-x-0 bottom-0 z-30 border-t border-default bg-neutral-primary-soft p-3 shadow-lg lg:hidden">
        <div class="mx-auto flex max-w-6xl gap-3">
            <a href="{{ route('home') }}"
               class="inline-flex items-center justify-center rounded-base border border-default-medium bg-neutral-secondary-medium px-4 py-2.5 text-sm font-medium text-body shadow-xs hover:bg-neutral-tertiary-medium hover:text-heading">
                @lang('Give up')
            </a>
            <button type="submit" form="create-post-form"
                    class="inline-flex flex-1 items-center justify-center gap-2 rounded-base border border-transparent bg-brand px-4 py-2.5 text-sm font-medium text-white shadow-xs hover:bg-brand-strong focus:outline-none focus:ring-4 focus:ring-brand-medium">
                <i class="fa-solid fa-paper-plane text-xs" aria-hidden="true"></i>
                @lang('Publish')
            </button>
        </div>
    </div>
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const checkbox = document.getElementById('published_at_feature');
            const dateContainer = document.getElementById('scheduled-date-container');
            const dateInput = document.getElementById('scheduled_at');

            if (! checkbox || ! dateContainer) {
                return;
            }

            checkbox.addEventListener('change', () => {
                dateContainer.classList.toggle('hidden', ! checkbox.checked);

                if (! checkbox.checked && dateInput) {
                    dateInput.value = '';
                }
            });
        });
    </script>
@endsection
