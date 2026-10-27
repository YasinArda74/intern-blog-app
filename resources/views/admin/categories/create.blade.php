@extends('layouts.admin', ['active' => 'categories'])

@section('title', trans('Create New Category'))

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">@lang('Create New Category')</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400">@lang('Name the role and choose which actions it can perform')</p>
    </div>


    @php $formUrl = isset($category) ? route('admin.categories.update', $category->id) : route('admin.categories.create') @endphp
    <form action="{{ $formUrl }}" method="POST" class="flex max-w-5xl flex-col gap-6">
        @csrf

        @isset($category)
            @method('PUT')
        @endisset

        <section class="rounded-base border border-default bg-neutral-primary-soft p-5 shadow-xs sm:p-6">
            <label for="name" class="mb-2 block text-sm font-medium text-heading">@lang('Role Name')</label>
            <input
                type="text"
                id="name"
                name="name"
                placeholder="@lang('For example, editor')"
                value="{{ $category->name ?? '' }}"
                class="block w-full rounded-base border border-default-medium bg-neutral-secondary-medium px-3.5 py-2.5 text-sm text-heading shadow-xs placeholder:text-body focus:border-brand focus:ring-brand"
            >

            <label for="parent_category_slug" class="mb-2 block text-sm font-medium text-heading">@lang('Parent Category')</label>
            <label for="parent_category_slug" class="block mb-2.5 text-sm font-medium text-heading">Select an option</label>
            <select id="parent_category_slug" name="parent_category_slug" class="block w-full px-3 py-2.5 bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand shadow-xs placeholder:text-body">
                <option selected value="">Choose a country</option>
                @foreach($categories as $category)
                    <option value="{{$category->slug}}">{{$category->name}}</option>
                @endforeach

            </select>
        </section>


        <div class="flex items-center gap-3">
            <button type="submit" class="inline-flex items-center justify-center rounded-base bg-brand px-4 py-2.5 text-sm font-medium text-white shadow-xs hover:bg-brand-strong focus:outline-none focus:ring-4 focus:ring-brand-medium">
                @lang('Create Role')
            </button>

            <a href="{{ route('admin.categories.list') }}" class="inline-flex items-center justify-center rounded-base border border-default-medium bg-neutral-secondary-medium px-4 py-2.5 text-sm font-medium text-body shadow-xs hover:bg-neutral-tertiary-medium hover:text-heading focus:outline-none focus:ring-4 focus:ring-neutral-tertiary">
                @lang('Cancel')
            </a>
        </div>
    </form>
@endsection
