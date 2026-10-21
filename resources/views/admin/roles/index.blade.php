@extends('layouts.admin', ['active' => 'roles'])

@section('title', 'Roller')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">@lang('Roles')</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">@lang('Manage the roles of users in the system')</p>
        </div>

        <a href="{{ route('admin.roles.create') }}"
           class="inline-flex items-center justify-center  text-white bg-brand hover:bg-brand-strong focus:ring-4 focus:ring-brand-medium shadow-xs rounded-base focus:outline-none py-1.5 px-3 text-sm font-medium">
            @lang('New Role') <i class="fa-solid fa-plus ms-2"></i>
        </a>
        <a href="#" role="button" id="openImportModal"
           class="inline-flex items-center justify-center  text-white bg-brand hover:bg-brand-strong focus:ring-4 focus:ring-brand-medium shadow-xs rounded-base focus:outline-none py-1.5 px-3 text-sm font-medium">
            @lang('New Create Permission')
        </a>
    </div>
    <div id="importModal"
         class="hidden fixed inset-0 z-50 items-center justify-center bg-black/50 p-4">

        <div id="importModalBox" class="w-full max-w-md rounded-xl bg-white p-6 shadow-xl">

            <form action="{{route('permissions.import')}}" method="Post" enctype="multipart/form-data">
                @csrf

                <h3 class="text-lg font-semibold text-gray-900">Excel'den Permission Ekle</h3>

                <div class="mt-4">
                    <input type="file" name="file" accept=".xlsx,.xls,.csv" required
                           class="block w-full rounded-lg border border-gray-300 text-sm
                           file:mr-3 file:border-0 file:bg-gray-100 file:px-4 file:py-2
                           file:text-sm file:font-medium hover:file:bg-gray-200">

                    @error('file')
                    <div class="mt-2 text-sm text-red-600">
                        @if(is_array($message))
                            @foreach($message as $m)
                                <div>{{ $m }}</div>
                            @endforeach
                        @else
                            {{ $message }}
                        @endif
                    </div>
                    @enderror

                    <p class="mt-2 text-xs text-gray-500">
                        Excel'de ilk satır başlık olmalı: <code>name</code>, <code>guard_name</code>
                    </p>
                </div>

                <div class="mt-6 flex justify-end gap-2">
                    <button type="button" id="closeImportModal"
                            class="rounded-lg bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-200">
                        İptal
                    </button>
                    <button type="submit"
                            class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">
                        Yükle ve Ekle
                    </button>
                </div>
            </form>
        </div>
    </div>


    <div class="overflow-visible bg-neutral-primary-soft shadow-xs rounded-base border border-default">
        <table class="w-full text-sm text-left rtl:text-right text-body">
            <thead class="text-sm text-body bg-neutral-secondary-medium border-b border-default-medium">
            <tr>
                <th scope="col" class="px-6 py-3 font-medium" width="30">@lang('Action')</th>
                <th scope="col" class="px-6 py-3 font-medium">@lang('Role Name')</th>
                <th scope="col" class="px-6 py-3 font-medium">@lang('Permission Count')</th>
            </tr>
            </thead>

            <tbody>
            @forelse($roles as $role)
                <tr class="bg-neutral-primary-soft hover:bg-neutral-secondary-medium @if(! $loop->last) border-b border-default @endif">
                    <td class="px-6 py-1.5">
                        <button id="role-actions-button-{{ $role->id }}"
                                data-dropdown-toggle="role-actions-menu-{{ $role->id }}"
                                data-dropdown-placement="bottom-start"
                                class="cursor-pointer inline-flex items-center justify-center w-9 h-9 text-body rounded-base hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-2 focus:ring-neutral-tertiary focus:outline-none"
                                type="button" aria-label="@lang('Open actions')">
                            <i class="fa-solid fa-ellipsis-vertical" aria-hidden="true"></i>
                        </button>

                        <div id="role-actions-menu-{{ $role->id }}"
                             class="z-30 hidden bg-neutral-primary-medium border border-default-medium rounded-base shadow-lg w-44">
                            <ul class="p-2 text-sm text-body font-medium"
                                aria-labelledby="role-actions-button-{{ $role->id }}">
                                <li>
                                    <a href="{{ route('admin.roles.edit', $role->id) }}"
                                       class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded">@lang('Edit')</a>
                                </li>

                                <li>
                                    <a href="{{ route('admin.roles.delete', $role->id) }}"
                                       class="inline-flex items-center w-full p-2 hover:bg-red-100 rounded text-red-600">@lang('Delete')</a>
                                </li>
                            </ul>
                        </div>
                    </td>

                    <td class="px-6 py-1.5 font-medium text-heading whitespace-nowrap">@lang(\App\Enums\RoleEnum::tryFrom($role->name)?->name ?? $role->name)</td>

                    <td class="px-6 py-1.5">{{ $role->permissions->count() }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="h-96 px-6">
                        <div class="flex h-full flex-col items-center justify-center gap-3 text-center">
                            <span
                                class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-neutral-secondary-medium text-body">
                                <i class="fa-solid fa-user-shield text-xl" aria-hidden="true"></i>
                            </span>
                            <div class="max-w-sm">
                                <p class="text-base font-semibold text-heading">@lang('No roles yet')</p>
                                <p class="mt-1 text-sm text-body">@lang('Roles added to the system will be listed in this table.')</p>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal    = document.getElementById('importModal');
        const box      = document.getElementById('importModalBox');
        const openBtn  = document.getElementById('openImportModal');
        const closeBtn = document.getElementById('closeImportModal');

        function openModal() {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeModal() {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        openBtn.addEventListener('click', function (e) {
            e.preventDefault();
            openModal();
        });
        closeBtn.addEventListener('click', closeModal);

        // Modalın dışındaki koyu alana tıklayınca kapat
        modal.addEventListener('click', function (e) {
            if (!box.contains(e.target)) closeModal();
        });

        // ESC tuşuyla kapat
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeModal();
        });

        // Doğrulama hatası varsa modalı tekrar aç
        @if($errors->has('file'))
        openModal();
        @endif
    });
</script>
