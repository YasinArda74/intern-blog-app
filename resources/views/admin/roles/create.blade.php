@extends('layouts.admin', ['active' => 'roles'])

@section('title', trans('Create New Role'))

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('btn-form-role').addEventListener('click', function () {
                @isset($role)
                    submitForm('#form-role', '{{ route('admin.roles.update', $role->id) }}', 'PUT');
                @else
                    submitForm('#form-role', '{{ route('admin.roles.create') }}');
                @endisset


            });
        });
    </script>
@endsection

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">@lang('Create New Role')</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400">@lang('Name the role and choose which actions it can perform')</p>
    </div>

    <form id="form-role" class="flex max-w-5xl flex-col gap-6">
        <section class="rounded-base border border-default bg-neutral-primary-soft p-5 shadow-xs sm:p-6">
            <label for="name" class="mb-2 block text-sm font-medium text-heading">@lang('Role Name')</label>
            <input
                type="text"
                id="name"
                name="name"
                placeholder="@lang('For example, editor')"
                value="{{ $role->name ?? '' }}"
                class="block w-full rounded-base border border-default-medium bg-neutral-secondary-medium px-3.5 py-2.5 text-sm text-heading shadow-xs placeholder:text-body focus:border-brand focus:ring-brand"
            >
        </section>

        <section class="rounded-base border border-default bg-neutral-primary-soft shadow-xs">
            <div class="border-b border-default px-5 py-4 sm:px-6">
                <h2 class="text-base font-semibold text-heading">@lang('Permissions')</h2>
                <p class="mt-1 text-sm text-body">@lang('Turn each permission on or off')</p>
            </div>

            <div class="grid gap-4 p-5 sm:p-6 lg:grid-cols-2">
                @foreach ($permissionGroups as $group)
                    <div class="rounded-base border border-default-medium">
                        <div class="border-b border-default-medium px-4 py-3">
                            <h3 class="text-sm font-semibold text-heading">
                                {{ trans(\Illuminate\Support\Str::before($group->first()->name, '.')).' '.trans('Permissions') }}
                            </h3>
                        </div>

                        <div class="divide-y divide-default px-4">
                            @foreach ($group as $item)
                                <div class="flex items-center justify-between gap-4 py-3">
                                    <span class="text-sm text-heading">@lang('permissions.'.$item->name)</span>

                                    <label class="inline-flex shrink-0 cursor-pointer items-center">
                                        <input type="checkbox" name="permissions[{{ $item->name }}]" class="peer sr-only" aria-label="{{ trans($item->name) }}" @if(isset($role) && $role->permissions->contains('name', $item->name)) checked @endif>

                                        <div class="relative h-6 w-11 rounded-full bg-neutral-tertiary-medium peer-focus:ring-4 peer-focus:ring-brand-medium peer-checked:bg-brand after:absolute after:start-0.5 after:top-0.5 after:h-5 after:w-5 after:rounded-full after:border after:border-default after:bg-white after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white after:content-['']"></div>

                                        <span class="ms-3 inline-block w-12 text-sm font-medium text-body peer-checked:hidden">@lang('Passive')</span>

                                        <span class="ms-3 hidden w-12 text-sm font-medium text-fg-brand peer-checked:inline-block">@lang('Active')</span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <div class="flex items-center gap-3">
            <button type="button" id="btn-form-role" class="inline-flex items-center justify-center rounded-base bg-brand px-4 py-2.5 text-sm font-medium text-white shadow-xs hover:bg-brand-strong focus:outline-none focus:ring-4 focus:ring-brand-medium">
                @lang('Create Role')
            </button>

            <a href="{{ route('admin.roles.list') }}" class="inline-flex items-center justify-center rounded-base border border-default-medium bg-neutral-secondary-medium px-4 py-2.5 text-sm font-medium text-body shadow-xs hover:bg-neutral-tertiary-medium hover:text-heading focus:outline-none focus:ring-4 focus:ring-neutral-tertiary">
                @lang('Cancel')
            </a>
        </div>
    </form>
@endsection
