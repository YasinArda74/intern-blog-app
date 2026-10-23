@extends('layouts.admin', ['active' => 'categories'])

@section('title', 'Kategoriler')

@section('content')
    <div class="flex flex-col gap-4 mb-6 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Kategoriler</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Blog yazılarınız için kategorileri yönetin.</p>
        </div>
        <a href="{{ route('admin.categories.create') }}"
           class="inline-flex items-center justify-center  text-white bg-brand hover:bg-brand-strong focus:ring-4 focus:ring-brand-medium shadow-xs rounded-base focus:outline-none py-1.5 px-3 text-sm font-medium">
            @lang('New Category') <i class="fa-solid fa-plus ms-2"></i>
        </a>
    </div>

    <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">

        <div class="relative">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3"></th>
                        <th scope="col" class="px-6 py-3">Kategori Adı</th>
                        <th scope="col" class="px-6 py-3">Yazı Sayısı</th>
                        <th scope="col" class="px-6 py-3">Oluşturulma</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr class="bg-white border-b border-gray-200 hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-600">
                            <td class="px-6 py-1.5">
                                <button id="role-actions-button-{{ $category->id }}"
                                        data-dropdown-toggle="role-actions-menu-{{ $category->id }}"
                                        data-dropdown-placement="bottom-start"
                                        class="cursor-pointer inline-flex items-center justify-center w-9 h-9 text-body rounded-base hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-2 focus:ring-neutral-tertiary focus:outline-none"
                                        type="button" aria-label="@lang('Open actions')">
                                    <i class="fa-solid fa-ellipsis-vertical" aria-hidden="true"></i>
                                </button>

                                <div id="role-actions-menu-{{ $category->id }}"
                                     class="z-30 hidden bg-neutral-primary-medium border border-default-medium rounded-base shadow-lg w-44">
                                    <ul class="p-2 text-sm text-body font-medium"
                                        aria-labelledby="role-actions-button-{{ $category->id }}">
                                        <li>
                                            <a href="{{ route('admin.categories.edit', $category->id) }}"
                                               class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded">@lang('Edit')</a>
                                        </li>

                                        <li>
                                            <a href="{{ route('admin.categories.delete', $category->id) }}"
                                               class="inline-flex items-center w-full p-2 hover:bg-red-100 rounded text-red-600">@lang('Delete')</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$category->name}}</th>
                            <td class="px-6 py-4">
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-sm dark:bg-blue-900 dark:text-blue-300">42</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{$category->created_at->format('d/m/Y')}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="p-3" >
                @if ($categories->hasPages())
                    <div class="mt-8">
                        {{ $categories->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
