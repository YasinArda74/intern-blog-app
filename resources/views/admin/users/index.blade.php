@extends('layouts.admin', ['active' => 'users'])

@section('title', 'Kullanıcılar')

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const userSearch = initTomSelect('#user-search', '{{ route('select-search.users') }}', {maxItems: 1});

            userSearch.on('change', (value) => {
                window.location = '{{ route('admin.getUsers') }}?username='+value
            });
        });
    </script>
@endsection

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Kullanıcılar</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400">Tüm kullanıcıları görüntüleyin, rollerini değiştirin veya silin.</p>
    </div>

    <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
        <div class="flex flex-col gap-3 p-4 sm:flex-row sm:items-center sm:justify-between">
            <div class="relative w-full sm:max-w-lg">
                <input type="text" id="user-search" placeholder="{{ trans('Search username...') }}" class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
            </div>

            <div>
                <label for="role-filter" class="sr-only">Role göre filtrele</label>
                <select id="role-filter" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option selected>Tüm roller</option>
                    <option>Admin</option>
                    <option>Editör</option>
                    <option>Yazar</option>
                    <option>Üye</option>
                </select>
            </div>
        </div>

        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">@lang('User')</th>
                        <th scope="col" class="px-6 py-3">@lang('Rol')</th>
                        <th scope="col" class="px-6 py-3">@lang('Situation')</th>
                        <th scope="col" class="px-6 py-3">@lang('Registration Date')</th>
                        <th scope="col" class="px-6 py-3 text-right">@lang('Options')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr class="bg-white border-b border-gray-200 hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-600">
                            <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                <span class="w-10 h-10 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center font-semibold dark:bg-blue-900 dark:text-blue-300">{{$user->getFullNameInitials()}}</span>
                                <div class="ps-3">
                                    <div class="text-base font-semibold">{{$user->getFullName()}}</div>
                                    <div class="font-normal text-gray-500">{{$user->email}}</div>
                                </div>
                            </th>

                            <td class="px-6 py-4">
                                @forelse($user->roles as $role)
                                    {{ \App\Enums\RoleEnum::getFieldName($role->name) }}
                                @empty
                                    <span class="text-xs font-medium px-2.5 py-0.5 rounded-sm ">@lang('No Role')</span>
                                @endforelse
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center"><span class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></span> Aktif</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">01 Oca 2026</td>
                            <td class="px-12 py-4 text-right">
                                <button id="role-actions-button-{{ $user->id }}"
                                        data-dropdown-toggle="role-actions-menu-{{ $user->id }}"
                                        data-dropdown-placement="bottom-start"
                                        class="cursor-pointer inline-flex items-center justify-center w-9 h-9 text-body rounded-base hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-2 focus:ring-neutral-tertiary focus:outline-none"
                                        type="button" aria-label="@lang('Open actions')"> <i class="fa-solid fa-ellipsis-vertical" aria-hidden="true"></i> </button></td>
                            <div id="role-actions-menu-{{ $user->id }}"
                                 class="z-30 hidden bg-neutral-primary-medium border border-default-medium rounded-base shadow-lg w-44">
                                <ul class="p-2 text-sm text-body font-medium"
                                    aria-labelledby="role-actions-button-{{ $user->id }}">
                                    <li>
                                        <a href="{{ route('admin.getUsersEdit', $user->id) }}"
                                           class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded">@lang('Edit')</a>
                                    </li>

                                </ul>
                            </div>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-3" >
            @if ($users->hasPages())
                <div class="mt-8">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>

    {{-- Rol değiştirme modalı --}}
    <div id="change-role-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Kullanıcı Rolünü Değiştir</h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="change-role-modal">
                        <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 14 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" /></svg>
                        <span class="sr-only">Kapat</span>
                    </button>
                </div>
                <form action="#" class="p-4 md:p-5">
                    <p class="mb-4 text-sm text-gray-500 dark:text-gray-400">
                        <span data-delete-target class="font-semibold text-gray-900 dark:text-white"></span> için yeni bir rol seçin.
                    </p>
                    <div class="mb-5">
                        <label for="new-role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Yeni Rol</label>
                        <select id="new-role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                            <option>Admin</option>
                            <option>Editör</option>
                            <option>Yazar</option>
                            <option>Üye</option>
                        </select>
                    </div>
                    <div class="flex items-center gap-3">
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Rolü Güncelle</button>
                        <button type="button" data-modal-hide="change-role-modal" class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Vazgeç</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
