@extends('layouts.app')

@section('title', 'Yeni Yazı')

@section('content')
    <div class="mx-auto max-w-6xl px-4 py-10 sm:px-6">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">@lang('Create a new post')</h1>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">@lang("Write down your ideas, publish them when you're ready.")</p>
            </div>
            <a href="/" class="text-sm font-medium text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">@lang('Give up')</a>
        </div>

        <form action="{{route('posts.create')}}" method="POST" class="mt-8 grid gap-8 lg:grid-cols-3">
            @csrf
            <div class="space-y-6 lg:col-span-2">
                <div class="rounded-xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900">
                    <label for="title" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">@lang('Title')</label>
                    <input type="text" id="title" name="title" placeholder="{{trans('Give your article an attention-grabbing title.')}}"
                        class="block w-full rounded-lg border border-gray-300 bg-white p-3 text-lg font-semibold text-gray-900 focus:border-indigo-600 focus:ring-indigo-600 dark:border-gray-700 dark:bg-gray-950 dark:text-white dark:placeholder-gray-500">

                    <label for="excerpt" class="mb-2 mt-5 block text-sm font-medium text-gray-900 dark:text-white">@lang('Brief summary')</label>
                    <textarea id="slug" name="slug" rows="2" placeholder="{{trans('The brief description readers will see in the list')}}"
                        class="block w-full rounded-lg border border-gray-300 bg-white p-3 text-sm text-gray-900 focus:border-indigo-600 focus:ring-indigo-600 dark:border-gray-700 dark:bg-gray-950 dark:text-white dark:placeholder-gray-500"></textarea>
                </div>
                <div id="editor"></div>
                <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-900">
                    <div class="flex flex-wrap items-center gap-1 border-b border-gray-200 px-3 py-2 dark:border-gray-800" role="toolbar" aria-label="Biçimlendirme">
                        <button type="button" aria-label="Kalın" class="rounded p-2 text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white"><span class="block size-4 text-sm font-bold leading-4">B</span></button>
                        <button type="button" aria-label="İtalik" class="rounded p-2 text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white"><span class="block size-4 text-sm italic leading-4">I</span></button>
                        <button type="button" aria-label="Başlık" class="rounded p-2 text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white"><span class="block size-4 text-sm font-semibold leading-4">H</span></button>
                        <span class="mx-1 h-5 w-px bg-gray-200 dark:bg-gray-700" aria-hidden="true"></span>
                        <button type="button" aria-label="Bağlantı" class="rounded p-2 text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white">
                            <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244" /></svg>
                        </button>
                        <button type="button" aria-label="Liste" class="rounded p-2 text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white">
                            <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm0 5.25h.007v.008H3.75V12Zm0 5.25h.007v.008H3.75v-.008Z" /></svg>
                        </button>
                        <button type="button" aria-label="Alıntı" class="rounded p-2 text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white">
                            <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" /></svg>
                        </button>
                        <button type="button" aria-label="Kod" class="rounded p-2 text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white">
                            <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M17.25 6.75 22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3-4.5 16.5" /></svg>
                        </button>
                    </div>
                    <label for="body" class="sr-only">@lang('Article content')</label>
                    <textarea id="content" name="content" rows="18" placeholder="{{trans('Start telling your story...')}}"
                        class="block w-full border-0 bg-white p-6 text-base leading-relaxed text-gray-900 focus:ring-0 dark:bg-gray-900 dark:text-white dark:placeholder-gray-500"></textarea>
                    <div class="flex justify-between border-t border-gray-200 px-6 py-3 text-xs text-gray-500 dark:border-gray-800 dark:text-gray-400">
                    </div>
                </div>
            </div>

            {{-- Ayarlar --}}
            <aside class="space-y-6">
                <div class="rounded-xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900">
                    <h2 class="font-semibold text-gray-900 dark:text-white">@lang('Publish')</h2>
                    <fieldset class="mt-4 space-y-3">
                        <legend class="sr-only">Durum</legend>
                        <label class="flex cursor-pointer items-start gap-3 rounded-lg border border-gray-200 p-3 has-[:checked]:border-indigo-600 has-[:checked]:bg-indigo-50 dark:border-gray-700 dark:has-[:checked]:bg-indigo-900/30">
                            <input type="radio" name="status" value="published" checked class="mt-0.5 size-4 border-gray-300 text-indigo-600 focus:ring-indigo-500">
                            <span class="text-sm">
                                <span class="block font-medium text-gray-900 dark:text-white">@lang('Publish immediately')</span>
                                <span class="text-gray-500 dark:text-gray-400">@lang('Everyone can see.')</span>
                            </span>
                        </label>
                        <label class="flex cursor-pointer items-start gap-3 rounded-lg border border-gray-200 p-3 has-[:checked]:border-indigo-600 has-[:checked]:bg-indigo-50 dark:border-gray-700 dark:has-[:checked]:bg-indigo-900/30">
                            <input type="radio" name="status" value="draft" class="mt-0.5 size-4 border-gray-300 text-indigo-600 focus:ring-indigo-500">
                            <span class="text-sm">
                                <span class="block font-medium text-gray-900 dark:text-white">@lang('Save as draft')</span>
                                <span class="text-gray-500 dark:text-gray-400">@lang('Only you can see it.')</span>
                            </span>
                        </label>
                    </fieldset>
                    <div class="mt-5 flex gap-3">
                        <button type="button" class="flex-1 rounded-lg border border-gray-300 px-4 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 dark:border-gray-700 dark:text-white dark:hover:bg-gray-800">@lang('Preview')</button>
                        <button type="submit" class="flex-1 rounded-lg bg-indigo-700 px-4 py-2.5 text-sm font-semibold text-white hover:bg-indigo-800 focus:outline-none focus:ring-4 focus:ring-indigo-300 dark:bg-indigo-600 dark:hover:bg-indigo-700">@lang('Save')</button>
                    </div>
                </div>

                <div class="rounded-xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900 " >
                    <h2 class="font-semibold text-gray-900 dark:text-white">@lang('Cover image')</h2>
                    <label for="cover" class="mt-4 flex h-40 w-full cursor-pointer flex-col items-center justify-center rounded-lg border-2 border-dashed border-gray-300 bg-gray-50 hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-950 dark:hover:bg-gray-800">
                        <svg class="size-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" /></svg>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400"><span class="font-semibold text-indigo-700 dark:text-indigo-400">@lang('Click to install')</span> @lang('or drag')</p>
                        <p class="text-xs text-gray-500 dark:text-gray-500">PNG, JPG (max. 2MB)</p>
                        <input id="cover" name="cover" type="file" accept="image/*" disabled class="hidden">
                    </label>
                </div>

                <div class="rounded-xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900">
                    <label for="category" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">@lang('Category')</label>
                    <select id="category_slug" name="category_slug"
                        class="block w-full rounded-lg border border-gray-300 bg-white p-2.5 text-sm text-gray-900 focus:border-indigo-600 focus:ring-indigo-600 dark:border-gray-700 dark:bg-gray-950 dark:text-white">
                        <option>@lang('Select category')</option>
                        @foreach($categories as $category)
                            <option value="{{$category->slug}}">
                                {{$category->name}}
                            </option>
                        @endforeach
                    </select>

                    <label for="tags" class="mb-2 mt-5 block text-sm font-medium text-gray-900 dark:text-white">@lang('Tags')</label>
                    <input type="text" id="tags" name="tags" placeholder="laravel, php, tailwind"
                        class="block w-full rounded-lg border border-gray-300 bg-white p-2.5 text-sm text-gray-900 focus:border-indigo-600 focus:ring-indigo-600 dark:border-gray-700 dark:bg-gray-950 dark:text-white dark:placeholder-gray-500">
                    <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">@lang('Add up to 5 tags, separated by commas.')</p>
                </div>
            </aside>
        </form>
    </div>
@endsection
