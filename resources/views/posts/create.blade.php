@extends('layouts.app')

@section('title', 'Yeni Yazı')

@section('content')
    <div class="mx-auto max-w-6xl px-4 py-10 sm:px-6">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">@lang('Create a new post')</h1>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">@lang("Write down your ideas, publish them when you're ready.")</p>
            </div>
            <a href="/"
               class="text-sm font-medium text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">@lang('Give up')</a>
        </div>

        <form action="{{route('posts.create')}}" method="POST" class="mt-8 grid gap-8 lg:grid-cols-3">
            @csrf
            <div class="space-y-6 lg:col-span-2">
                <div class="rounded-xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900">
                    <label for="title"
                           class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">@lang('Title')</label>
                    <input type="text" id="title" name="title"
                           placeholder="{{trans('Give your article an attention-grabbing title.')}}"
                           class="block w-full rounded-lg border border-gray-300 bg-white p-3 text-lg font-semibold text-gray-900 focus:border-indigo-600 focus:ring-indigo-600 dark:border-gray-700 dark:bg-gray-950 dark:text-white dark:placeholder-gray-500">
                    <label for="content" class="mb-2 mt-3 block text-sm font-medium text-gray-900 dark:text-white">@lang('Article content')</label>

                    <!-- Content -->
                    <div class="mt-2">
                        @include('posts.partials._tiptap-editor')
                    </div>

                    <label for="excerpt"
                           class="mb-2 mt-5 block text-sm font-medium text-gray-900 dark:text-white">@lang('Brief summary')</label>
                    <textarea id="excerpt" name="excerpt" rows="2"
                              placeholder="{{trans('The brief description readers will see in the list')}}"
                              class="block w-full rounded-lg border border-gray-300 bg-white p-3 text-sm text-gray-900 focus:border-indigo-600 focus:ring-indigo-600 dark:border-gray-700 dark:bg-gray-950 dark:text-white dark:placeholder-gray-500"></textarea>

                    <label for="category"
                           class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">@lang('Category')</label>
                    <select id="category_slug" name="category_slug"
                            class="block w-full rounded-lg border border-gray-300 bg-white p-2.5 text-sm text-gray-900 focus:border-indigo-600 focus:ring-indigo-600 dark:border-gray-700 dark:bg-gray-950 dark:text-white">
                        <option>@lang('Select category')</option>
                        @foreach($categories as $category)
                            <option value="{{$category->slug}}">
                                {{$category->name}}
                            </option>
                        @endforeach
                    </select>
                    <div>
                        <label for="published_at_feature" class="mt-5 flex space-x-2.5 bg-neutral-primary-soft border border-default rounded-base shadow-xs">
                            <input id="published_at_feature" type="checkbox" name="published_at_feature" class="w-4 h-4 mt-5 ms-4 border border-default-medium rounded-xs bg-neutral-secondary-medium focus:ring-2 focus:ring-brand-soft">
                            <div class="py-4 pe-4">
                                <p class="select-none w-full text-sm font-medium text-heading">@lang('Publish later')</p>
                            </div>
                        </label>

                        <div id="scheduled-date-container" class="mt-5" style="display: none;">
                            <input id="scheduled_at" type="date"
                                   name="scheduled_at"
                                   class="block w-full ps-9 pe-3 py-2.5 bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand px-3 py-2.5 shadow-xs placeholder:text-body"
                                   min="{{strtotime('+1 day')}}"
                                   placeholder="Select date">
                        </div>
                    </div>
                </div>
            </div>


            {{-- Ayarlar --}}
            <aside class="space-y-6">
                <div class="rounded-xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900">
                    <h2 class="font-semibold text-gray-900 dark:text-white">@lang('Publish')</h2>
                    <fieldset class="mt-4 space-y-3">
                        <legend class="sr-only">Durum</legend>
                        <label
                            class="flex cursor-pointer items-start gap-3 rounded-lg border border-gray-200 p-3 has-[:checked]:border-indigo-600 has-[:checked]:bg-indigo-50 dark:border-gray-700 dark:has-[:checked]:bg-indigo-900/30">
                            <input type="radio" name="status" value="published" checked
                                   class="mt-0.5 size-4 border-gray-300 text-indigo-600 focus:ring-indigo-500">
                            <span class="text-sm">
                                <span
                                    class="block font-medium text-gray-900 dark:text-white">@lang('Publish immediately')</span>
                                <span class="text-gray-500 dark:text-gray-400">@lang('Everyone can see.')</span>
                            </span>
                        </label>
                        <label
                            class="flex cursor-pointer items-start gap-3 rounded-lg border border-gray-200 p-3 has-[:checked]:border-indigo-600 has-[:checked]:bg-indigo-50 dark:border-gray-700 dark:has-[:checked]:bg-indigo-900/30">
                            <input type="radio" name="status" value="draft"
                                   class="mt-0.5 size-4 border-gray-300 text-indigo-600 focus:ring-indigo-500">
                            <span class="text-sm">
                                <span
                                    class="block font-medium text-gray-900 dark:text-white">@lang('Save as draft')</span>
                                <span class="text-gray-500 dark:text-gray-400">@lang('Only you can see it.')</span>
                            </span>
                        </label>
                    </fieldset>
                    <div class="mt-5 flex gap-3">
                        <button type="button"
                                class="flex-1 rounded-lg border border-gray-300 px-4 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 dark:border-gray-700 dark:text-white dark:hover:bg-gray-800">@lang('Preview')</button>
                        <button type="submit"
                                class="flex-1 rounded-lg bg-indigo-700 px-4 py-2.5 text-sm font-semibold text-white hover:bg-indigo-800 focus:outline-none focus:ring-4 focus:ring-indigo-300 dark:bg-indigo-600 dark:hover:bg-indigo-700">@lang('Save')</button>
                    </div>
                </div>

                <div class="rounded-xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900 ">
                    <h2 class="font-semibold text-gray-900 dark:text-white">@lang('Cover image')</h2>
                    <label for="cover"
                           class="mt-4 flex h-40 w-full cursor-pointer flex-col items-center justify-center rounded-lg border-2 border-dashed border-gray-300 bg-gray-50 hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-950 dark:hover:bg-gray-800">
                        <svg class="size-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                             stroke-width="1.5" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/>
                        </svg>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400"><span
                                class="font-semibold text-indigo-700 dark:text-indigo-400">@lang('Click to install')</span> @lang('or drag')
                        </p>
                        <p class="text-xs text-gray-500 dark:text-gray-500">PNG, JPG (max. 2MB)</p>
                        <input id="cover" name="cover" type="file" accept="image/*" disabled class="hidden">
                    </label>
                </div>

            </aside>
        </form>
    </div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkbox = document.getElementById('published_at_feature');
        const dateContainer = document.getElementById('scheduled-date-container');

        checkbox.addEventListener('change', function () {
            if (this.checked) {
                dateContainer.style.display = 'block'; // Checkbox işaretlendiyse göster
            } else {
                dateContainer.style.display = 'none';  // İşaret kaldırıldıysa gizle
                // İsteğe bağlı: Checkbox kapatıldığında tarih inputunun içini sıfırlamak istersen:
                // dateContainer.querySelector('input').value = '';
            }
        });
    });
</script>
