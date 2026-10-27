@extends('layouts.admin', ['active' => 'tags'])

@section('title', trans('Create New Tag'))
@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('btn-form-tag').addEventListener('click', function () {
                @isset($tag)
                submitForm('#form-tag', '{{ route('admin.tags.update', $tag->id) }}', 'PUT');
                @else
                submitForm('#form-tag', '{{ route('admin.tags.create') }}');
                @endisset
            });
        });
    </script>
@endsection

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">@lang('Create New Tag')</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400">@lang('Name the Tag and Choose Whether It Should Be Visible')</p>
    </div>


    <form id="form-tag" method="POST" class="flex max-w-5xl flex-col gap-6">

        <section class="rounded-base border border-default bg-neutral-primary-soft p-5 shadow-xs sm:p-6">
            <label for="name" class="mb-2 block text-sm font-medium text-heading">@lang('Tag Name')</label>
            <input
                type="text"
                id="name"
                name="name"
                placeholder="@lang('For example, editor')"
                value="{{ $tag->name ?? '' }}"
                class="block w-full rounded-base border border-default-medium bg-neutral-secondary-medium px-3.5 py-2.5 text-sm text-heading shadow-xs placeholder:text-body focus:border-brand focus:ring-brand"
            >
            <div class="mt-3 flex items-center">
                <input id="is_active" name="is_active" type="checkbox" value="1" @checked($tag->is_active ?? true) class="w-4 h-4 border border-default-medium rounded-xs bg-neutral-secondary-medium focus:ring-2 focus:ring-brand-soft">
                <label for="checked-checkbox" class="select-none ms-2 text-sm font-medium text-heading">@lang('Active')</label>
            </div>

        </section>


        <div class="flex items-center gap-3">
            <button id="btn-form-tag" type="button" class="inline-flex items-center justify-center rounded-base bg-brand px-4 py-2.5 text-sm font-medium text-white shadow-xs hover:bg-brand-strong focus:outline-none focus:ring-4 focus:ring-brand-medium">
                @lang('Create Tag')
            </button>

            <a href="{{ route('admin.tags.list') }}" class="inline-flex items-center justify-center rounded-base border border-default-medium bg-neutral-secondary-medium px-4 py-2.5 text-sm font-medium text-body shadow-xs hover:bg-neutral-tertiary-medium hover:text-heading focus:outline-none focus:ring-4 focus:ring-neutral-tertiary">
                @lang('Cancel')
            </a>
        </div>
    </form>
@endsection
