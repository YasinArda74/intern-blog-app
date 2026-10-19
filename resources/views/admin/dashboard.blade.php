@extends('layouts.admin', ['active' => 'dashboard'])

@section('title', 'Genel Bakış')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">@lang('Overview')</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">@lang('Summary status of your blog site.').</p>
        </div>

        <div>
            <a
                href="{{ route('admin.dashboard') }}?refreshSummary=1"
                class="inline-flex items-center justify-center  text-white bg-brand hover:bg-brand-strong focus:ring-4 focus:ring-brand-medium shadow-xs rounded-base w-10 h-10 focus:outline-none"
                data-tooltip-target="tooltip-default"
                data-tooltip-placement="left"
            >
                <i class="fa-solid fa-arrows-rotate"></i>
            </a>

            <div id="tooltip-default" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-dark rounded-base shadow-xs opacity-0 tooltip">
                @lang('Refresh Summary')
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
        </div>
    </div>

    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4 mb-6">
        <a href="#"
           class="flex items-center justify-between p-5 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <div>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">@lang('Total Text')</p>
                <p class="mt-1 text-3xl font-bold text-gray-900 dark:text-white">{{ $summary['postCount'] }}</p>
            </div>
            <span
                class="flex items-center justify-center w-12 h-12 rounded-lg bg-blue-100 text-blue-600 dark:bg-blue-900 dark:text-blue-300">
                <x-admin.icon name="document" class="w-6 h-6"/>
            </span>
        </a>

        <a href="{{route('admin.getCategories')}}"
           class="flex items-center justify-between p-5 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <div>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">@lang('Categories')</p>
                <p class="mt-1 text-3xl font-bold text-gray-900 dark:text-white">{{ $summary['categoryCount'] }}</p>
            </div>
            <span
                class="flex items-center justify-center w-12 h-12 rounded-lg bg-blue-100 text-blue-600 dark:bg-blue-900 dark:text-blue-300">
                <x-admin.icon name="tag" class="w-6 h-6"/>
            </span>
        </a>

        <a href="{{route('admin.getUsers')}}"
           class="flex items-center justify-between p-5 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <div>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">@lang('Users')</p>
                <p class="mt-1 text-3xl font-bold text-gray-900 dark:text-white">{{ $summary['userCount'] }}</p>
            </div>
            <span
                class="flex items-center justify-center w-12 h-12 rounded-lg bg-blue-100 text-blue-600 dark:bg-blue-900 dark:text-blue-300">
                <x-admin.icon name="users" class="w-6 h-6"/>
            </span>
        </a>

        <a href="{{route('admin.getRoles')}}"
           class="flex items-center justify-between p-5 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <div>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">@lang('Role')</p>
                <p class="mt-1 text-3xl font-bold text-gray-900 dark:text-white">{{ $summary['roleCount'] }}</p>
            </div>
            <span
                class="flex items-center justify-center w-12 h-12 rounded-lg bg-blue-100 text-blue-600 dark:bg-blue-900 dark:text-blue-300">
                <x-admin.icon name="shield" class="w-6 h-6"/>
            </span>
        </a>
    </div>

    <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
        <div class="flex items-center justify-between p-4 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">@lang('Those who registered today')</h2>
            <a href="{{route('admin.getUsers')}}"
               class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">@lang('See all')</a>
        </div>
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">@lang('Full Name')</th>
                    <th scope="col" class="px-6 py-3">@lang('Email')</th>
                    <th scope="col" class="px-6 py-3">@lang('Role')</th>
                    <th scope="col" class="px-6 py-3">@lang('Registration date')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr class="bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$user->getFullName()}}</th>
                        <td class="px-6 py-4">{{$user->email}}</td>
                        @forelse($user->roles as $role)
                            <td class="px-6 py-4">{{$role->name}}</td>
                        @empty
                            <td class="px-6 py-4">@lang('No Role')</td>
                        @endforelse
                        <td class="px-6 py-4">{{$user->created_at->format('d/m/Y H:m')}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @if ($users->hasPages())
            <div class="mt-8">
                {{ $users->links() }}
            </div>
        @endif
    </div>
@endsection
