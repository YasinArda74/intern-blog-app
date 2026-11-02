@extends('layouts.app')

@section('title', __('Create a new post'))

@section('content')
    <div class="mx-auto w-full min-w-0 max-w-6xl px-4 py-10 pb-28 sm:px-6 sm:py-14 lg:pb-14">
        <div class="mb-8 max-w-2xl">
            <a href="{{ route('home') }}"
               class="inline-flex items-center gap-2 text-sm font-medium text-body hover:text-heading">
                <i class="fa-solid fa-arrow-left text-xs" aria-hidden="true"></i>
                @lang('Give up')
            </a>
            <h1 class="mt-4 text-3xl font-semibold tracking-tight text-heading sm:text-4xl">@lang('Create a new post')</h1>
            <p class="mt-2 text-base leading-relaxed text-body">@lang("Write down your ideas, publish them when you're ready.")</p>
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

        <form id="create-post-form" action="{{ route('posts.create') }}" method="POST" class="grid items-start gap-6 lg:grid-cols-[minmax(0,1fr)_22rem]">
            @csrf

            <section class="min-w-0 rounded-base border border-default bg-neutral-primary-soft p-5 shadow-xs sm:p-8">
                <div class="flex flex-col gap-7">
                    <div>
                        <label for="title" class="mb-2 block text-sm font-medium text-heading">@lang('Title')</label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}" maxlength="255"
                               placeholder="@lang('Give your article an attention-grabbing title.')"
                               @error('title') aria-invalid="true" aria-describedby="title-error" @enderror
                               @class([
                                   'block w-full rounded-base border px-3.5 py-3 text-base font-medium text-heading shadow-xs placeholder:font-normal placeholder:text-body',
                                   'border-default-medium bg-neutral-secondary-medium focus:border-brand focus:ring-brand' => ! $errors->has('title'),
                                   'border-danger bg-danger-soft focus:border-danger focus:ring-danger-medium' => $errors->has('title'),
                               ])>
                        @error('title')
                            <p id="title-error" class="mt-2 text-sm text-fg-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <p class="mb-2 block text-sm font-medium text-heading">@lang('Article content')</p>
                        <p class="mb-3 text-sm text-body">@lang('Start telling your story...')</p>
                        @include('posts.partials._tiptap-editor')
                        @error('content')
                            <p class="mt-2 text-sm text-fg-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="excerpt" class="mb-2 block text-sm font-medium text-heading">@lang('Brief summary')</label>
                        <textarea id="excerpt" name="excerpt" rows="4"
                                  placeholder="@lang('The brief description readers will see in the list')"
                                  @error('excerpt') aria-invalid="true" aria-describedby="excerpt-error" @enderror
                                  @class([
                                      'block w-full rounded-base border px-3.5 py-3 text-sm leading-relaxed text-heading shadow-xs placeholder:text-body',
                                      'border-default-medium bg-neutral-secondary-medium focus:border-brand focus:ring-brand' => ! $errors->has('excerpt'),
                                      'border-danger bg-danger-soft focus:border-danger focus:ring-danger-medium' => $errors->has('excerpt'),
                                  ])>{{ old('excerpt') }}</textarea>
                        @error('excerpt')
                            <p id="excerpt-error" class="mt-2 text-sm text-fg-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </section>

            <aside class="flex min-w-0 flex-col gap-4 lg:sticky lg:top-24">
                <!-- Category Field -->
                <section class="rounded-base border border-default bg-neutral-primary-soft p-5 shadow-xs">
                    <label for="category_slug" class="mb-2 block text-sm font-medium text-heading">
                        @lang('Category')
                    </label>

                    <select id="category_slug"
                            name="category_slug"
                            @class([
                                'block w-full appearance-none rounded-base border py-3 ps-3.5 pe-10 text-sm text-heading shadow-xs',
                                'border-default-medium bg-neutral-secondary-medium focus:border-brand focus:ring-brand' => ! $errors->has('category_id'),
                                'border-danger bg-danger-soft focus:border-danger focus:ring-danger-medium' => $errors->has('category_id'),
                            ])
                    >
                        <option value="">@lang('Select category')</option>

                        @foreach ($categories as $category)
                            <option value="{{ $category->slug }}">
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </section>

                <section class="rounded-base border border-default bg-neutral-primary-soft p-5 shadow-xs">
                    <label for="published_at_feature" class="flex cursor-pointer items-start gap-3">
                        <input id="published_at_feature" type="checkbox" name="published_at_feature" value="on"
                               @checked(old('published_at_feature'))
                               class="mt-0.5 size-4 shrink-0 rounded-xs border border-default-medium bg-neutral-secondary-medium text-brand focus:ring-2 focus:ring-brand-soft">
                        <span>
                            <span class="block text-sm font-medium text-heading">@lang('Publish later')</span>
                            <span class="mt-1 block text-sm leading-relaxed text-body">@lang('The post goes live on the date you choose.')</span>
                        </span>
                    </label>

                    <div id="scheduled-date-container" @class(['mt-4', 'hidden' => old('published_at_feature') !== 'on'])>
                        <label for="scheduled_at" class="mb-2 block text-sm font-medium text-heading">@lang('Publication date')</label>
                        <input id="scheduled_at" type="date" name="scheduled_at"
                               value="{{ old('scheduled_at') }}"
                               min="{{ now()->addDay()->toDateString() }}"
                               @error('scheduled_at') aria-invalid="true" aria-describedby="scheduled-at-error" @enderror
                               @class([
                                   'block w-full rounded-base border px-3.5 py-3 text-sm text-heading shadow-xs',
                                   'border-default-medium bg-neutral-secondary-medium focus:border-brand focus:ring-brand' => ! $errors->has('scheduled_at'),
                                   'border-danger bg-danger-soft focus:border-danger focus:ring-danger-medium' => $errors->has('scheduled_at'),
                               ])>
                        @error('scheduled_at')
                            <p id="scheduled-at-error" class="mt-2 text-sm text-fg-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </section>

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
            initTomSelect('#category_slug', '{{ route('select-search.categories') }}');
        });
    </script>

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
