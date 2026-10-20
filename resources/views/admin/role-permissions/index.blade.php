@extends('layouts.admin', ['active' => 'role-permissions'])

@section('title', 'Rol İzinleri')

@section('content')
    <div class="flex flex-col gap-4 mb-6 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Rol İzinleri</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Rolleri oluşturun, düzenleyin ve her rol için hangi işlemlerin yapılabileceğini belirleyin.</p>
        </div>
        <button type="button" data-modal-target="create-role-modal" data-modal-toggle="create-role-modal" class="inline-flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <x-admin.icon name="plus" class="w-4 h-4 me-2" />
            Yeni Rol Ekle
        </button>
    </div>

    {{-- Rol listesi --}}
    <div class="mb-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
        <div class="p-4 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Roller</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">Sistemde tanımlı tüm roller.</p>
        </div>
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Rol</th>
                        <th scope="col" class="px-6 py-3">Açıklama</th>
                        <th scope="col" class="px-6 py-3">Kullanıcı</th>
                        <th scope="col" class="px-6 py-3">Aktif izin</th>
                        <th scope="col" class="px-6 py-3"><span class="sr-only">İşlemler</span></th>
                    </tr>
                </thead>
                <tbody>
                        <tr class="bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap"><span class="text-sm font-medium px-2.5 py-0.5 rounded-sm bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300">Admin</span></th>
                            <td class="px-6 py-4">Sitenin tüm bölümlerine tam erişim.</td>
                            <td class="px-6 py-4">2</td>
                            <td class="px-6 py-4">12 / 12</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <button type="button" data-modal-target="edit-role-modal" data-modal-toggle="edit-role-modal" class="p-2 text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800">
                                        <x-admin.icon name="pencil" class="w-4 h-4" />
                                        <span class="sr-only">Admin rolünü düzenle</span>
                                    </button>
                                    <button type="button" data-modal-target="delete-role-modal" data-modal-toggle="delete-role-modal" class="p-2 text-red-700 border border-red-700 hover:bg-red-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-red-300 rounded-lg dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                                        <x-admin.icon name="trash" class="w-4 h-4" />
                                        <span class="sr-only">Admin rolünü sil</span>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr class="bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap"><span class="text-sm font-medium px-2.5 py-0.5 rounded-sm bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300">Editör</span></th>
                            <td class="px-6 py-4">Tüm yazıları ve kategorileri yönetebilir.</td>
                            <td class="px-6 py-4">5</td>
                            <td class="px-6 py-4">8 / 12</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <button type="button" data-modal-target="edit-role-modal" data-modal-toggle="edit-role-modal" class="p-2 text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800">
                                        <x-admin.icon name="pencil" class="w-4 h-4" />
                                        <span class="sr-only">Editör rolünü düzenle</span>
                                    </button>
                                    <button type="button" data-modal-target="delete-role-modal" data-modal-toggle="delete-role-modal" class="p-2 text-red-700 border border-red-700 hover:bg-red-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-red-300 rounded-lg dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                                        <x-admin.icon name="trash" class="w-4 h-4" />
                                        <span class="sr-only">Editör rolünü sil</span>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr class="bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap"><span class="text-sm font-medium px-2.5 py-0.5 rounded-sm bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">Yazar</span></th>
                            <td class="px-6 py-4">Kendi yazılarını oluşturur ve düzenler.</td>
                            <td class="px-6 py-4">18</td>
                            <td class="px-6 py-4">4 / 12</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <button type="button" data-modal-target="edit-role-modal" data-modal-toggle="edit-role-modal" class="p-2 text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800">
                                        <x-admin.icon name="pencil" class="w-4 h-4" />
                                        <span class="sr-only">Yazar rolünü düzenle</span>
                                    </button>
                                    <button type="button" data-modal-target="delete-role-modal" data-modal-toggle="delete-role-modal" class="p-2 text-red-700 border border-red-700 hover:bg-red-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-red-300 rounded-lg dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                                        <x-admin.icon name="trash" class="w-4 h-4" />
                                        <span class="sr-only">Yazar rolünü sil</span>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr class="bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap"><span class="text-sm font-medium px-2.5 py-0.5 rounded-sm bg-gray-100 text-gray-800 dark:bg-gray-600 dark:text-gray-300">Üye</span></th>
                            <td class="px-6 py-4">Yorum yapabilir ve profilini yönetebilir.</td>
                            <td class="px-6 py-4">1.229</td>
                            <td class="px-6 py-4">2 / 12</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <button type="button" data-modal-target="edit-role-modal" data-modal-toggle="edit-role-modal" class="p-2 text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800">
                                        <x-admin.icon name="pencil" class="w-4 h-4" />
                                        <span class="sr-only">Üye rolünü düzenle</span>
                                    </button>
                                    <button type="button" data-modal-target="delete-role-modal" data-modal-toggle="delete-role-modal" class="p-2 text-red-700 border border-red-700 hover:bg-red-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-red-300 rounded-lg dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                                        <x-admin.icon name="trash" class="w-4 h-4" />
                                        <span class="sr-only">Üye rolünü sil</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- İzin yönetimi --}}
    <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
        <div class="p-4 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">İzinleri Düzenle</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">Bir rol seçin ve her izin için Evet veya Hayır olarak belirleyin.</p>
        </div>

        <div class="p-4">
            <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                <ul id="role-tabs" data-tabs-toggle="#role-tab-content" role="tablist" class="flex flex-wrap -mb-px text-sm font-medium text-center" data-tabs-active-classes="text-blue-600 hover:text-blue-600 dark:text-blue-500 dark:hover:text-blue-500 border-blue-600 dark:border-blue-500" data-tabs-inactive-classes="dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300">
                <li class="me-2" role="presentation">
                    <button type="button" id="admin-tab" data-tabs-target="#admin-panel" role="tab" aria-controls="admin-panel" aria-selected="false" class="inline-block p-4 border-b-2 rounded-t-lg">Admin</button>
                </li>
                <li class="me-2" role="presentation">
                    <button type="button" id="editor-tab" data-tabs-target="#editor-panel" role="tab" aria-controls="editor-panel" aria-selected="false" class="inline-block p-4 border-b-2 rounded-t-lg">Editör</button>
                </li>
                <li class="me-2" role="presentation">
                    <button type="button" id="author-tab" data-tabs-target="#author-panel" role="tab" aria-controls="author-panel" aria-selected="false" class="inline-block p-4 border-b-2 rounded-t-lg">Yazar</button>
                </li>
                <li class="me-2" role="presentation">
                    <button type="button" id="member-tab" data-tabs-target="#member-panel" role="tab" aria-controls="member-panel" aria-selected="false" class="inline-block p-4 border-b-2 rounded-t-lg">Üye</button>
                </li>
                </ul>
            </div>

            <div id="role-tab-content">
            {{-- Admin izinleri --}}
            <div id="admin-panel" class="hidden" role="tabpanel" aria-labelledby="admin-tab">
                <form action="#">
                    <div class="grid gap-4 lg:grid-cols-2">
                        <div class="bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
                            <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                                <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Yazılar</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Blog yazıları üzerindeki işlemler</p>
                            </div>
                            <div class="px-4">
                                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                                    <div class="flex items-center justify-between py-3">
                                        <span class="text-sm text-gray-900 dark:text-white">Yazıları görüntüle</span>
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="checkbox" checked class="sr-only peer" aria-label="Admin - Yazıları görüntüle">
                                            <div class="relative w-11 h-6 bg-gray-200 rounded-full peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-0.5 after:start-0.5 after:bg-white after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                                            <span class="ms-3 inline-block w-9 text-sm font-medium text-gray-500 dark:text-gray-400 peer-checked:hidden">Hayır</span>
                                            <span class="hidden ms-3 w-9 text-sm font-medium text-blue-600 dark:text-blue-500 peer-checked:inline-block">Evet</span>
                                        </label>
                                    </div>
                                    <div class="flex items-center justify-between py-3">
                                        <span class="text-sm text-gray-900 dark:text-white">Yazı oluştur</span>
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="checkbox" checked class="sr-only peer" aria-label="Admin - Yazı oluştur">
                                            <div class="relative w-11 h-6 bg-gray-200 rounded-full peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-0.5 after:start-0.5 after:bg-white after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                                            <span class="ms-3 inline-block w-9 text-sm font-medium text-gray-500 dark:text-gray-400 peer-checked:hidden">Hayır</span>
                                            <span class="hidden ms-3 w-9 text-sm font-medium text-blue-600 dark:text-blue-500 peer-checked:inline-block">Evet</span>
                                        </label>
                                    </div>
                                    <div class="flex items-center justify-between py-3">
                                        <span class="text-sm text-gray-900 dark:text-white">Yazı düzenle</span>
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="checkbox" checked class="sr-only peer" aria-label="Admin - Yazı düzenle">
                                            <div class="relative w-11 h-6 bg-gray-200 rounded-full peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-0.5 after:start-0.5 after:bg-white after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                                            <span class="ms-3 inline-block w-9 text-sm font-medium text-gray-500 dark:text-gray-400 peer-checked:hidden">Hayır</span>
                                            <span class="hidden ms-3 w-9 text-sm font-medium text-blue-600 dark:text-blue-500 peer-checked:inline-block">Evet</span>
                                        </label>
                                    </div>
                                    <div class="flex items-center justify-between py-3">
                                        <span class="text-sm text-gray-900 dark:text-white">Yazı sil</span>
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="checkbox" checked class="sr-only peer" aria-label="Admin - Yazı sil">
                                            <div class="relative w-11 h-6 bg-gray-200 rounded-full peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-0.5 after:start-0.5 after:bg-white after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                                            <span class="ms-3 inline-block w-9 text-sm font-medium text-gray-500 dark:text-gray-400 peer-checked:hidden">Hayır</span>
                                            <span class="hidden ms-3 w-9 text-sm font-medium text-blue-600 dark:text-blue-500 peer-checked:inline-block">Evet</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
                            <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                                <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Kategoriler</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Kategori listesi ve yönetimi</p>
                            </div>
                            <div class="px-4">
                                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                                    <div class="flex items-center justify-between py-3">
                                        <span class="text-sm text-gray-900 dark:text-white">Kategorileri görüntüle</span>
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="checkbox" checked class="sr-only peer" aria-label="Admin - Kategorileri görüntüle">
                                            <div class="relative w-11 h-6 bg-gray-200 rounded-full peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-0.5 after:start-0.5 after:bg-white after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                                            <span class="ms-3 inline-block w-9 text-sm font-medium text-gray-500 dark:text-gray-400 peer-checked:hidden">Hayır</span>
                                            <span class="hidden ms-3 w-9 text-sm font-medium text-blue-600 dark:text-blue-500 peer-checked:inline-block">Evet</span>
                                        </label>
                                    </div>
                                    <div class="flex items-center justify-between py-3">
                                        <span class="text-sm text-gray-900 dark:text-white">Kategori yönet</span>
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="checkbox" checked class="sr-only peer" aria-label="Admin - Kategori yönet">
                                            <div class="relative w-11 h-6 bg-gray-200 rounded-full peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-0.5 after:start-0.5 after:bg-white after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                                            <span class="ms-3 inline-block w-9 text-sm font-medium text-gray-500 dark:text-gray-400 peer-checked:hidden">Hayır</span>
                                            <span class="hidden ms-3 w-9 text-sm font-medium text-blue-600 dark:text-blue-500 peer-checked:inline-block">Evet</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
                            <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                                <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Kullanıcılar</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Kullanıcı hesapları üzerindeki işlemler</p>
                            </div>
                            <div class="px-4">
                                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                                    <div class="flex items-center justify-between py-3">
                                        <span class="text-sm text-gray-900 dark:text-white">Kullanıcıları görüntüle</span>
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="checkbox" checked class="sr-only peer" aria-label="Admin - Kullanıcıları görüntüle">
                                            <div class="relative w-11 h-6 bg-gray-200 rounded-full peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-0.5 after:start-0.5 after:bg-white after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                                            <span class="ms-3 inline-block w-9 text-sm font-medium text-gray-500 dark:text-gray-400 peer-checked:hidden">Hayır</span>
                                            <span class="hidden ms-3 w-9 text-sm font-medium text-blue-600 dark:text-blue-500 peer-checked:inline-block">Evet</span>
                                        </label>
                                    </div>
                                    <div class="flex items-center justify-between py-3">
                                        <span class="text-sm text-gray-900 dark:text-white">Kullanıcı düzenle</span>
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="checkbox" checked class="sr-only peer" aria-label="Admin - Kullanıcı düzenle">
                                            <div class="relative w-11 h-6 bg-gray-200 rounded-full peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-0.5 after:start-0.5 after:bg-white after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                                            <span class="ms-3 inline-block w-9 text-sm font-medium text-gray-500 dark:text-gray-400 peer-checked:hidden">Hayır</span>
                                            <span class="hidden ms-3 w-9 text-sm font-medium text-blue-600 dark:text-blue-500 peer-checked:inline-block">Evet</span>
                                        </label>
                                    </div>
                                    <div class="flex items-center justify-between py-3">
                                        <span class="text-sm text-gray-900 dark:text-white">Kullanıcı sil</span>
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="checkbox" checked class="sr-only peer" aria-label="Admin - Kullanıcı sil">
                                            <div class="relative w-11 h-6 bg-gray-200 rounded-full peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-0.5 after:start-0.5 after:bg-white after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                                            <span class="ms-3 inline-block w-9 text-sm font-medium text-gray-500 dark:text-gray-400 peer-checked:hidden">Hayır</span>
                                            <span class="hidden ms-3 w-9 text-sm font-medium text-blue-600 dark:text-blue-500 peer-checked:inline-block">Evet</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
                            <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                                <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Roller</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Rol atama ve rol yönetimi</p>
                            </div>
                            <div class="px-4">
                                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                                    <div class="flex items-center justify-between py-3">
                                        <span class="text-sm text-gray-900 dark:text-white">Rol ata</span>
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="checkbox" checked class="sr-only peer" aria-label="Admin - Rol ata">
                                            <div class="relative w-11 h-6 bg-gray-200 rounded-full peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-0.5 after:start-0.5 after:bg-white after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                                            <span class="ms-3 inline-block w-9 text-sm font-medium text-gray-500 dark:text-gray-400 peer-checked:hidden">Hayır</span>
                                            <span class="hidden ms-3 w-9 text-sm font-medium text-blue-600 dark:text-blue-500 peer-checked:inline-block">Evet</span>
                                        </label>
                                    </div>
                                    <div class="flex items-center justify-between py-3">
                                        <span class="text-sm text-gray-900 dark:text-white">Rol yönet</span>
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="checkbox" checked class="sr-only peer" aria-label="Admin - Rol yönet">
                                            <div class="relative w-11 h-6 bg-gray-200 rounded-full peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-0.5 after:start-0.5 after:bg-white after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                                            <span class="ms-3 inline-block w-9 text-sm font-medium text-gray-500 dark:text-gray-400 peer-checked:hidden">Hayır</span>
                                            <span class="hidden ms-3 w-9 text-sm font-medium text-blue-600 dark:text-blue-500 peer-checked:inline-block">Evet</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
                            <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                                <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Yorumlar</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Yorum moderasyonu</p>
                            </div>
                            <div class="px-4">
                                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                                    <div class="flex items-center justify-between py-3">
                                        <span class="text-sm text-gray-900 dark:text-white">Yorum moderasyonu</span>
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="checkbox" checked class="sr-only peer" aria-label="Admin - Yorum moderasyonu">
                                            <div class="relative w-11 h-6 bg-gray-200 rounded-full peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-0.5 after:start-0.5 after:bg-white after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                                            <span class="ms-3 inline-block w-9 text-sm font-medium text-gray-500 dark:text-gray-400 peer-checked:hidden">Hayır</span>
                                            <span class="hidden ms-3 w-9 text-sm font-medium text-blue-600 dark:text-blue-500 peer-checked:inline-block">Evet</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between gap-3 mt-4">
                        <p class="text-sm text-gray-500 dark:text-gray-400"><span class="font-medium text-gray-900 dark:text-white">Admin</span> rolü için yapılan değişiklikler kaydedilene kadar uygulanmaz.</p>
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">İzinleri Kaydet</button>
                    </div>
                </form>
            </div>

            {{-- Editör izinleri --}}
            <div id="editor-panel" class="hidden" role="tabpanel" aria-labelledby="editor-tab">
                <form action="#">
                    <div class="grid gap-4 lg:grid-cols-2">
                        <div class="bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
                            <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                                <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Yazılar</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Blog yazıları üzerindeki işlemler</p>
                            </div>
                            <div class="px-4">
                                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                                    <div class="flex items-center justify-between py-3">
                                        <span class="text-sm text-gray-900 dark:text-white">Yazıları görüntüle</span>
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="checkbox" checked class="sr-only peer" aria-label="Editör - Yazıları görüntüle">
                                            <div class="relative w-11 h-6 bg-gray-200 rounded-full peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-0.5 after:start-0.5 after:bg-white after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                                            <span class="ms-3 inline-block w-9 text-sm font-medium text-gray-500 dark:text-gray-400 peer-checked:hidden">Hayır</span>
                                            <span class="hidden ms-3 w-9 text-sm font-medium text-blue-600 dark:text-blue-500 peer-checked:inline-block">Evet</span>
                                        </label>
                                    </div>
                                    <div class="flex items-center justify-between py-3">
                                        <span class="text-sm text-gray-900 dark:text-white">Yazı oluştur</span>
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="checkbox" checked class="sr-only peer" aria-label="Editör - Yazı oluştur">
                                            <div class="relative w-11 h-6 bg-gray-200 rounded-full peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-0.5 after:start-0.5 after:bg-white after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                                            <span class="ms-3 inline-block w-9 text-sm font-medium text-gray-500 dark:text-gray-400 peer-checked:hidden">Hayır</span>
                                            <span class="hidden ms-3 w-9 text-sm font-medium text-blue-600 dark:text-blue-500 peer-checked:inline-block">Evet</span>
                                        </label>
                                    </div>
                                    <div class="flex items-center justify-between py-3">
                                        <span class="text-sm text-gray-900 dark:text-white">Yazı düzenle</span>
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="checkbox" checked class="sr-only peer" aria-label="Editör - Yazı düzenle">
                                            <div class="relative w-11 h-6 bg-gray-200 rounded-full peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-0.5 after:start-0.5 after:bg-white after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                                            <span class="ms-3 inline-block w-9 text-sm font-medium text-gray-500 dark:text-gray-400 peer-checked:hidden">Hayır</span>
                                            <span class="hidden ms-3 w-9 text-sm font-medium text-blue-600 dark:text-blue-500 peer-checked:inline-block">Evet</span>
                                        </label>
                                    </div>
                                    <div class="flex items-center justify-between py-3">
                                        <span class="text-sm text-gray-900 dark:text-white">Yazı sil</span>
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="checkbox" checked class="sr-only peer" aria-label="Editör - Yazı sil">
                                            <div class="relative w-11 h-6 bg-gray-200 rounded-full peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-0.5 after:start-0.5 after:bg-white after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                                            <span class="ms-3 inline-block w-9 text-sm font-medium text-gray-500 dark:text-gray-400 peer-checked:hidden">Hayır</span>
                                            <span class="hidden ms-3 w-9 text-sm font-medium text-blue-600 dark:text-blue-500 peer-checked:inline-block">Evet</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
                            <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                                <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Kategoriler</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Kategori listesi ve yönetimi</p>
                            </div>
                            <div class="px-4">
                                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                                    <div class="flex items-center justify-between py-3">
                                        <span class="text-sm text-gray-900 dark:text-white">Kategorileri görüntüle</span>
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="checkbox" checked class="sr-only peer" aria-label="Editör - Kategorileri görüntüle">
                                            <div class="relative w-11 h-6 bg-gray-200 rounded-full peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-0.5 after:start-0.5 after:bg-white after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                                            <span class="ms-3 inline-block w-9 text-sm font-medium text-gray-500 dark:text-gray-400 peer-checked:hidden">Hayır</span>
                                            <span class="hidden ms-3 w-9 text-sm font-medium text-blue-600 dark:text-blue-500 peer-checked:inline-block">Evet</span>
                                        </label>
                                    </div>
                                    <div class="flex items-center justify-between py-3">
                                        <span class="text-sm text-gray-900 dark:text-white">Kategori yönet</span>
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="checkbox" checked class="sr-only peer" aria-label="Editör - Kategori yönet">
                                            <div class="relative w-11 h-6 bg-gray-200 rounded-full peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-0.5 after:start-0.5 after:bg-white after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                                            <span class="ms-3 inline-block w-9 text-sm font-medium text-gray-500 dark:text-gray-400 peer-checked:hidden">Hayır</span>
                                            <span class="hidden ms-3 w-9 text-sm font-medium text-blue-600 dark:text-blue-500 peer-checked:inline-block">Evet</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
                            <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                                <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Kullanıcılar</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Kullanıcı hesapları üzerindeki işlemler</p>
                            </div>
                            <div class="px-4">
                                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                                    <div class="flex items-center justify-between py-3">
                                        <span class="text-sm text-gray-900 dark:text-white">Kullanıcıları görüntüle</span>
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="checkbox" checked class="sr-only peer" aria-label="Editör - Kullanıcıları görüntüle">
                                            <div class="relative w-11 h-6 bg-gray-200 rounded-full peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-0.5 after:start-0.5 after:bg-white after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                                            <span class="ms-3 inline-block w-9 text-sm font-medium text-gray-500 dark:text-gray-400 peer-checked:hidden">Hayır</span>
                                            <span class="hidden ms-3 w-9 text-sm font-medium text-blue-600 dark:text-blue-500 peer-checked:inline-block">Evet</span>
                                        </label>
                                    </div>
                                    <div class="flex items-center justify-between py-3">
                                        <span class="text-sm text-gray-900 dark:text-white">Kullanıcı düzenle</span>
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="checkbox" class="sr-only peer" aria-label="Editör - Kullanıcı düzenle">
                                            <div class="relative w-11 h-6 bg-gray-200 rounded-full peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-0.5 after:start-0.5 after:bg-white after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                                            <span class="ms-3 inline-block w-9 text-sm font-medium text-gray-500 dark:text-gray-400 peer-checked:hidden">Hayır</span>
                                            <span class="hidden ms-3 w-9 text-sm font-medium text-blue-600 dark:text-blue-500 peer-checked:inline-block">Evet</span>
                                        </label>
                                    </div>
                                    <div class="flex items-center justify-between py-3">
                                        <span class="text-sm text-gray-900 dark:text-white">Kullanıcı sil</span>
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="checkbox" class="sr-only peer" aria-label="Editör - Kullanıcı sil">
                                            <div class="relative w-11 h-6 bg-gray-200 rounded-full peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-0.5 after:start-0.5 after:bg-white after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                                            <span class="ms-3 inline-block w-9 text-sm font-medium text-gray-500 dark:text-gray-400 peer-checked:hidden">Hayır</span>
                                            <span class="hidden ms-3 w-9 text-sm font-medium text-blue-600 dark:text-blue-500 peer-checked:inline-block">Evet</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
                            <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                                <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Roller</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Rol atama ve rol yönetimi</p>
                            </div>
                            <div class="px-4">
                                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                                    <div class="flex items-center justify-between py-3">
                                        <span class="text-sm text-gray-900 dark:text-white">Rol ata</span>
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="checkbox" class="sr-only peer" aria-label="Editör - Rol ata">
                                            <div class="relative w-11 h-6 bg-gray-200 rounded-full peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-0.5 after:start-0.5 after:bg-white after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                                            <span class="ms-3 inline-block w-9 text-sm font-medium text-gray-500 dark:text-gray-400 peer-checked:hidden">Hayır</span>
                                            <span class="hidden ms-3 w-9 text-sm font-medium text-blue-600 dark:text-blue-500 peer-checked:inline-block">Evet</span>
                                        </label>
                                    </div>
                                    <div class="flex items-center justify-between py-3">
                                        <span class="text-sm text-gray-900 dark:text-white">Rol yönet</span>
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="checkbox" class="sr-only peer" aria-label="Editör - Rol yönet">
                                            <div class="relative w-11 h-6 bg-gray-200 rounded-full peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-0.5 after:start-0.5 after:bg-white after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                                            <span class="ms-3 inline-block w-9 text-sm font-medium text-gray-500 dark:text-gray-400 peer-checked:hidden">Hayır</span>
                                            <span class="hidden ms-3 w-9 text-sm font-medium text-blue-600 dark:text-blue-500 peer-checked:inline-block">Evet</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
                            <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                                <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Yorumlar</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Yorum moderasyonu</p>
                            </div>
                            <div class="px-4">
                                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                                    <div class="flex items-center justify-between py-3">
                                        <span class="text-sm text-gray-900 dark:text-white">Yorum moderasyonu</span>
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="checkbox" checked class="sr-only peer" aria-label="Editör - Yorum moderasyonu">
                                            <div class="relative w-11 h-6 bg-gray-200 rounded-full peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-0.5 after:start-0.5 after:bg-white after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                                            <span class="ms-3 inline-block w-9 text-sm font-medium text-gray-500 dark:text-gray-400 peer-checked:hidden">Hayır</span>
                                            <span class="hidden ms-3 w-9 text-sm font-medium text-blue-600 dark:text-blue-500 peer-checked:inline-block">Evet</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between gap-3 mt-4">
                        <p class="text-sm text-gray-500 dark:text-gray-400"><span class="font-medium text-gray-900 dark:text-white">Editör</span> rolü için yapılan değişiklikler kaydedilene kadar uygulanmaz.</p>
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">İzinleri Kaydet</button>
                    </div>
                </form>
            </div>

            {{-- Yazar izinleri --}}
            <div id="author-panel" class="hidden" role="tabpanel" aria-labelledby="author-tab">
                <form action="#">
                    <div class="grid gap-4 lg:grid-cols-2">
                        <div class="bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
                            <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                                <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Yazılar</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Blog yazıları üzerindeki işlemler</p>
                            </div>
                            <div class="px-4">
                                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                                    <div class="flex items-center justify-between py-3">
                                        <span class="text-sm text-gray-900 dark:text-white">Yazıları görüntüle</span>
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="checkbox" checked class="sr-only peer" aria-label="Yazar - Yazıları görüntüle">
                                            <div class="relative w-11 h-6 bg-gray-200 rounded-full peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-0.5 after:start-0.5 after:bg-white after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                                            <span class="ms-3 inline-block w-9 text-sm font-medium text-gray-500 dark:text-gray-400 peer-checked:hidden">Hayır</span>
                                            <span class="hidden ms-3 w-9 text-sm font-medium text-blue-600 dark:text-blue-500 peer-checked:inline-block">Evet</span>
                                        </label>
                                    </div>
                                    <div class="flex items-center justify-between py-3">
                                        <span class="text-sm text-gray-900 dark:text-white">Yazı oluştur</span>
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="checkbox" checked class="sr-only peer" aria-label="Yazar - Yazı oluştur">
                                            <div class="relative w-11 h-6 bg-gray-200 rounded-full peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-0.5 after:start-0.5 after:bg-white after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                                            <span class="ms-3 inline-block w-9 text-sm font-medium text-gray-500 dark:text-gray-400 peer-checked:hidden">Hayır</span>
                                            <span class="hidden ms-3 w-9 text-sm font-medium text-blue-600 dark:text-blue-500 peer-checked:inline-block">Evet</span>
                                        </label>
                                    </div>
                                    <div class="flex items-center justify-between py-3">
                                        <span class="text-sm text-gray-900 dark:text-white">Yazı düzenle</span>
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="checkbox" checked class="sr-only peer" aria-label="Yazar - Yazı düzenle">
                                            <div class="relative w-11 h-6 bg-gray-200 rounded-full peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-0.5 after:start-0.5 after:bg-white after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                                            <span class="ms-3 inline-block w-9 text-sm font-medium text-gray-500 dark:text-gray-400 peer-checked:hidden">Hayır</span>
                                            <span class="hidden ms-3 w-9 text-sm font-medium text-blue-600 dark:text-blue-500 peer-checked:inline-block">Evet</span>
                                        </label>
                                    </div>
                                    <div class="flex items-center justify-between py-3">
                                        <span class="text-sm text-gray-900 dark:text-white">Yazı sil</span>
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="checkbox" class="sr-only peer" aria-label="Yazar - Yazı sil">
                                            <div class="relative w-11 h-6 bg-gray-200 rounded-full peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-0.5 after:start-0.5 after:bg-white after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                                            <span class="ms-3 inline-block w-9 text-sm font-medium text-gray-500 dark:text-gray-400 peer-checked:hidden">Hayır</span>
                                            <span class="hidden ms-3 w-9 text-sm font-medium text-blue-600 dark:text-blue-500 peer-checked:inline-block">Evet</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
                            <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                                <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Kategoriler</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Kategori listesi ve yönetimi</p>
                            </div>
                            <div class="px-4">
                                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                                    <div class="flex items-center justify-between py-3">
                                        <span class="text-sm text-gray-900 dark:text-white">Kategorileri görüntüle</span>
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="checkbox" checked class="sr-only peer" aria-label="Yazar - Kategorileri görüntüle">
                                            <div class="relative w-11 h-6 bg-gray-200 rounded-full peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-0.5 after:start-0.5 after:bg-white after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                                            <span class="ms-3 inline-block w-9 text-sm font-medium text-gray-500 dark:text-gray-400 peer-checked:hidden">Hayır</span>
                                            <span class="hidden ms-3 w-9 text-sm font-medium text-blue-600 dark:text-blue-500 peer-checked:inline-block">Evet</span>
                                        </label>
                                    </div>
                                    <div class="flex items-center justify-between py-3">
                                        <span class="text-sm text-gray-900 dark:text-white">Kategori yönet</span>
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="checkbox" class="sr-only peer" aria-label="Yazar - Kategori yönet">
                                            <div class="relative w-11 h-6 bg-gray-200 rounded-full peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-0.5 after:start-0.5 after:bg-white after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                                            <span class="ms-3 inline-block w-9 text-sm font-medium text-gray-500 dark:text-gray-400 peer-checked:hidden">Hayır</span>
                                            <span class="hidden ms-3 w-9 text-sm font-medium text-blue-600 dark:text-blue-500 peer-checked:inline-block">Evet</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
                            <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                                <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Kullanıcılar</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Kullanıcı hesapları üzerindeki işlemler</p>
                            </div>
                            <div class="px-4">
                                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                                    <div class="flex items-center justify-between py-3">
                                        <span class="text-sm text-gray-900 dark:text-white">Kullanıcıları görüntüle</span>
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="checkbox" class="sr-only peer" aria-label="Yazar - Kullanıcıları görüntüle">
                                            <div class="relative w-11 h-6 bg-gray-200 rounded-full peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-0.5 after:start-0.5 after:bg-white after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                                            <span class="ms-3 inline-block w-9 text-sm font-medium text-gray-500 dark:text-gray-400 peer-checked:hidden">Hayır</span>
                                            <span class="hidden ms-3 w-9 text-sm font-medium text-blue-600 dark:text-blue-500 peer-checked:inline-block">Evet</span>
                                        </label>
                                    </div>
                                    <div class="flex items-center justify-between py-3">
                                        <span class="text-sm text-gray-900 dark:text-white">Kullanıcı düzenle</span>
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="checkbox" class="sr-only peer" aria-label="Yazar - Kullanıcı düzenle">
                                            <div class="relative w-11 h-6 bg-gray-200 rounded-full peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-0.5 after:start-0.5 after:bg-white after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                                            <span class="ms-3 inline-block w-9 text-sm font-medium text-gray-500 dark:text-gray-400 peer-checked:hidden">Hayır</span>
                                            <span class="hidden ms-3 w-9 text-sm font-medium text-blue-600 dark:text-blue-500 peer-checked:inline-block">Evet</span>
                                        </label>
                                    </div>
                                    <div class="flex items-center justify-between py-3">
                                        <span class="text-sm text-gray-900 dark:text-white">Kullanıcı sil</span>
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="checkbox" class="sr-only peer" aria-label="Yazar - Kullanıcı sil">
                                            <div class="relative w-11 h-6 bg-gray-200 rounded-full peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-0.5 after:start-0.5 after:bg-white after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                                            <span class="ms-3 inline-block w-9 text-sm font-medium text-gray-500 dark:text-gray-400 peer-checked:hidden">Hayır</span>
                                            <span class="hidden ms-3 w-9 text-sm font-medium text-blue-600 dark:text-blue-500 peer-checked:inline-block">Evet</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
                            <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                                <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Roller</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Rol atama ve rol yönetimi</p>
                            </div>
                            <div class="px-4">
                                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                                    <div class="flex items-center justify-between py-3">
                                        <span class="text-sm text-gray-900 dark:text-white">Rol ata</span>
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="checkbox" class="sr-only peer" aria-label="Yazar - Rol ata">
                                            <div class="relative w-11 h-6 bg-gray-200 rounded-full peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-0.5 after:start-0.5 after:bg-white after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                                            <span class="ms-3 inline-block w-9 text-sm font-medium text-gray-500 dark:text-gray-400 peer-checked:hidden">Hayır</span>
                                            <span class="hidden ms-3 w-9 text-sm font-medium text-blue-600 dark:text-blue-500 peer-checked:inline-block">Evet</span>
                                        </label>
                                    </div>
                                    <div class="flex items-center justify-between py-3">
                                        <span class="text-sm text-gray-900 dark:text-white">Rol yönet</span>
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="checkbox" class="sr-only peer" aria-label="Yazar - Rol yönet">
                                            <div class="relative w-11 h-6 bg-gray-200 rounded-full peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-0.5 after:start-0.5 after:bg-white after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                                            <span class="ms-3 inline-block w-9 text-sm font-medium text-gray-500 dark:text-gray-400 peer-checked:hidden">Hayır</span>
                                            <span class="hidden ms-3 w-9 text-sm font-medium text-blue-600 dark:text-blue-500 peer-checked:inline-block">Evet</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
                            <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                                <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Yorumlar</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Yorum moderasyonu</p>
                            </div>
                            <div class="px-4">
                                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                                    <div class="flex items-center justify-between py-3">
                                        <span class="text-sm text-gray-900 dark:text-white">Yorum moderasyonu</span>
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="checkbox" class="sr-only peer" aria-label="Yazar - Yorum moderasyonu">
                                            <div class="relative w-11 h-6 bg-gray-200 rounded-full peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-0.5 after:start-0.5 after:bg-white after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                                            <span class="ms-3 inline-block w-9 text-sm font-medium text-gray-500 dark:text-gray-400 peer-checked:hidden">Hayır</span>
                                            <span class="hidden ms-3 w-9 text-sm font-medium text-blue-600 dark:text-blue-500 peer-checked:inline-block">Evet</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between gap-3 mt-4">
                        <p class="text-sm text-gray-500 dark:text-gray-400"><span class="font-medium text-gray-900 dark:text-white">Yazar</span> rolü için yapılan değişiklikler kaydedilene kadar uygulanmaz.</p>
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">İzinleri Kaydet</button>
                    </div>
                </form>
            </div>

            {{-- Üye izinleri --}}
            <div id="member-panel" class="hidden" role="tabpanel" aria-labelledby="member-tab">
                <form action="#">
                    <div class="grid gap-4 lg:grid-cols-2">
                        <div class="bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
                            <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                                <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Yazılar</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Blog yazıları üzerindeki işlemler</p>
                            </div>
                            <div class="px-4">
                                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                                    <div class="flex items-center justify-between py-3">
                                        <span class="text-sm text-gray-900 dark:text-white">Yazıları görüntüle</span>
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="checkbox" checked class="sr-only peer" aria-label="Üye - Yazıları görüntüle">
                                            <div class="relative w-11 h-6 bg-gray-200 rounded-full peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-0.5 after:start-0.5 after:bg-white after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                                            <span class="ms-3 inline-block w-9 text-sm font-medium text-gray-500 dark:text-gray-400 peer-checked:hidden">Hayır</span>
                                            <span class="hidden ms-3 w-9 text-sm font-medium text-blue-600 dark:text-blue-500 peer-checked:inline-block">Evet</span>
                                        </label>
                                    </div>
                                    <div class="flex items-center justify-between py-3">
                                        <span class="text-sm text-gray-900 dark:text-white">Yazı oluştur</span>
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="checkbox" class="sr-only peer" aria-label="Üye - Yazı oluştur">
                                            <div class="relative w-11 h-6 bg-gray-200 rounded-full peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-0.5 after:start-0.5 after:bg-white after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                                            <span class="ms-3 inline-block w-9 text-sm font-medium text-gray-500 dark:text-gray-400 peer-checked:hidden">Hayır</span>
                                            <span class="hidden ms-3 w-9 text-sm font-medium text-blue-600 dark:text-blue-500 peer-checked:inline-block">Evet</span>
                                        </label>
                                    </div>
                                    <div class="flex items-center justify-between py-3">
                                        <span class="text-sm text-gray-900 dark:text-white">Yazı düzenle</span>
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="checkbox" class="sr-only peer" aria-label="Üye - Yazı düzenle">
                                            <div class="relative w-11 h-6 bg-gray-200 rounded-full peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-0.5 after:start-0.5 after:bg-white after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                                            <span class="ms-3 inline-block w-9 text-sm font-medium text-gray-500 dark:text-gray-400 peer-checked:hidden">Hayır</span>
                                            <span class="hidden ms-3 w-9 text-sm font-medium text-blue-600 dark:text-blue-500 peer-checked:inline-block">Evet</span>
                                        </label>
                                    </div>
                                    <div class="flex items-center justify-between py-3">
                                        <span class="text-sm text-gray-900 dark:text-white">Yazı sil</span>
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="checkbox" class="sr-only peer" aria-label="Üye - Yazı sil">
                                            <div class="relative w-11 h-6 bg-gray-200 rounded-full peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-0.5 after:start-0.5 after:bg-white after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                                            <span class="ms-3 inline-block w-9 text-sm font-medium text-gray-500 dark:text-gray-400 peer-checked:hidden">Hayır</span>
                                            <span class="hidden ms-3 w-9 text-sm font-medium text-blue-600 dark:text-blue-500 peer-checked:inline-block">Evet</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
                            <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                                <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Kategoriler</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Kategori listesi ve yönetimi</p>
                            </div>
                            <div class="px-4">
                                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                                    <div class="flex items-center justify-between py-3">
                                        <span class="text-sm text-gray-900 dark:text-white">Kategorileri görüntüle</span>
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="checkbox" checked class="sr-only peer" aria-label="Üye - Kategorileri görüntüle">
                                            <div class="relative w-11 h-6 bg-gray-200 rounded-full peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-0.5 after:start-0.5 after:bg-white after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                                            <span class="ms-3 inline-block w-9 text-sm font-medium text-gray-500 dark:text-gray-400 peer-checked:hidden">Hayır</span>
                                            <span class="hidden ms-3 w-9 text-sm font-medium text-blue-600 dark:text-blue-500 peer-checked:inline-block">Evet</span>
                                        </label>
                                    </div>
                                    <div class="flex items-center justify-between py-3">
                                        <span class="text-sm text-gray-900 dark:text-white">Kategori yönet</span>
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="checkbox" class="sr-only peer" aria-label="Üye - Kategori yönet">
                                            <div class="relative w-11 h-6 bg-gray-200 rounded-full peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-0.5 after:start-0.5 after:bg-white after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                                            <span class="ms-3 inline-block w-9 text-sm font-medium text-gray-500 dark:text-gray-400 peer-checked:hidden">Hayır</span>
                                            <span class="hidden ms-3 w-9 text-sm font-medium text-blue-600 dark:text-blue-500 peer-checked:inline-block">Evet</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
                            <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                                <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Kullanıcılar</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Kullanıcı hesapları üzerindeki işlemler</p>
                            </div>
                            <div class="px-4">
                                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                                    <div class="flex items-center justify-between py-3">
                                        <span class="text-sm text-gray-900 dark:text-white">Kullanıcıları görüntüle</span>
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="checkbox" class="sr-only peer" aria-label="Üye - Kullanıcıları görüntüle">
                                            <div class="relative w-11 h-6 bg-gray-200 rounded-full peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-0.5 after:start-0.5 after:bg-white after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                                            <span class="ms-3 inline-block w-9 text-sm font-medium text-gray-500 dark:text-gray-400 peer-checked:hidden">Hayır</span>
                                            <span class="hidden ms-3 w-9 text-sm font-medium text-blue-600 dark:text-blue-500 peer-checked:inline-block">Evet</span>
                                        </label>
                                    </div>
                                    <div class="flex items-center justify-between py-3">
                                        <span class="text-sm text-gray-900 dark:text-white">Kullanıcı düzenle</span>
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="checkbox" class="sr-only peer" aria-label="Üye - Kullanıcı düzenle">
                                            <div class="relative w-11 h-6 bg-gray-200 rounded-full peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-0.5 after:start-0.5 after:bg-white after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                                            <span class="ms-3 inline-block w-9 text-sm font-medium text-gray-500 dark:text-gray-400 peer-checked:hidden">Hayır</span>
                                            <span class="hidden ms-3 w-9 text-sm font-medium text-blue-600 dark:text-blue-500 peer-checked:inline-block">Evet</span>
                                        </label>
                                    </div>
                                    <div class="flex items-center justify-between py-3">
                                        <span class="text-sm text-gray-900 dark:text-white">Kullanıcı sil</span>
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="checkbox" class="sr-only peer" aria-label="Üye - Kullanıcı sil">
                                            <div class="relative w-11 h-6 bg-gray-200 rounded-full peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-0.5 after:start-0.5 after:bg-white after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                                            <span class="ms-3 inline-block w-9 text-sm font-medium text-gray-500 dark:text-gray-400 peer-checked:hidden">Hayır</span>
                                            <span class="hidden ms-3 w-9 text-sm font-medium text-blue-600 dark:text-blue-500 peer-checked:inline-block">Evet</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
                            <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                                <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Roller</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Rol atama ve rol yönetimi</p>
                            </div>
                            <div class="px-4">
                                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                                    <div class="flex items-center justify-between py-3">
                                        <span class="text-sm text-gray-900 dark:text-white">Rol ata</span>
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="checkbox" class="sr-only peer" aria-label="Üye - Rol ata">
                                            <div class="relative w-11 h-6 bg-gray-200 rounded-full peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-0.5 after:start-0.5 after:bg-white after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                                            <span class="ms-3 inline-block w-9 text-sm font-medium text-gray-500 dark:text-gray-400 peer-checked:hidden">Hayır</span>
                                            <span class="hidden ms-3 w-9 text-sm font-medium text-blue-600 dark:text-blue-500 peer-checked:inline-block">Evet</span>
                                        </label>
                                    </div>
                                    <div class="flex items-center justify-between py-3">
                                        <span class="text-sm text-gray-900 dark:text-white">Rol yönet</span>
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="checkbox" class="sr-only peer" aria-label="Üye - Rol yönet">
                                            <div class="relative w-11 h-6 bg-gray-200 rounded-full peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-0.5 after:start-0.5 after:bg-white after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                                            <span class="ms-3 inline-block w-9 text-sm font-medium text-gray-500 dark:text-gray-400 peer-checked:hidden">Hayır</span>
                                            <span class="hidden ms-3 w-9 text-sm font-medium text-blue-600 dark:text-blue-500 peer-checked:inline-block">Evet</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
                            <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                                <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Yorumlar</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Yorum moderasyonu</p>
                            </div>
                            <div class="px-4">
                                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                                    <div class="flex items-center justify-between py-3">
                                        <span class="text-sm text-gray-900 dark:text-white">Yorum moderasyonu</span>
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="checkbox" class="sr-only peer" aria-label="Üye - Yorum moderasyonu">
                                            <div class="relative w-11 h-6 bg-gray-200 rounded-full peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-0.5 after:start-0.5 after:bg-white after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                                            <span class="ms-3 inline-block w-9 text-sm font-medium text-gray-500 dark:text-gray-400 peer-checked:hidden">Hayır</span>
                                            <span class="hidden ms-3 w-9 text-sm font-medium text-blue-600 dark:text-blue-500 peer-checked:inline-block">Evet</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between gap-3 mt-4">
                        <p class="text-sm text-gray-500 dark:text-gray-400"><span class="font-medium text-gray-900 dark:text-white">Üye</span> rolü için yapılan değişiklikler kaydedilene kadar uygulanmaz.</p>
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">İzinleri Kaydet</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>

    {{-- Yeni Rol Ekle --}}
    <div id="create-role-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200 dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Yeni Rol Ekle</h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="create-role-modal">
                        <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 14 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" /></svg>
                        <span class="sr-only">Kapat</span>
                    </button>
                </div>
                <form action="#" class="p-4 md:p-5">
                    <div class="grid gap-4 mb-4">
                        <div>
                            <label for="create-role-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rol adı</label>
                            <input type="text" id="create-role-name" value="" placeholder="Örn. Moderatör" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        </div>
                        <div>
                            <label for="create-role-description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Açıklama</label>
                            <textarea id="create-role-description" rows="3" placeholder="Bu rol ne yapabilir?" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                        </div>
                        <div>
                            <label for="create-role-color" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rozet rengi</label>
                            <select id="create-role-color" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option>Kırmızı</option>
                                <option>Mor</option>
                                <option selected>Mavi</option>
                                <option>Yeşil</option>
                                <option>Sarı</option>
                                <option>Gri</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Rolü Oluştur</button>
                </form>
            </div>
        </div>
    </div>

    {{-- Rolü Düzenle --}}
    <div id="edit-role-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200 dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Rolü Düzenle</h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="edit-role-modal">
                        <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 14 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" /></svg>
                        <span class="sr-only">Kapat</span>
                    </button>
                </div>
                <form action="#" class="p-4 md:p-5">
                    <div class="grid gap-4 mb-4">
                        <div>
                            <label for="edit-role-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rol adı</label>
                            <input type="text" id="edit-role-name" value="Editör" placeholder="Örn. Moderatör" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        </div>
                        <div>
                            <label for="edit-role-description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Açıklama</label>
                            <textarea id="edit-role-description" rows="3" placeholder="Bu rol ne yapabilir?" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">Tüm yazıları ve kategorileri yönetebilir.</textarea>
                        </div>
                        <div>
                            <label for="edit-role-color" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rozet rengi</label>
                            <select id="edit-role-color" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option>Kırmızı</option>
                                <option selected>Mor</option>
                                <option>Mavi</option>
                                <option>Yeşil</option>
                                <option>Sarı</option>
                                <option>Gri</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Değişiklikleri Kaydet</button>
                </form>
            </div>
        </div>
    </div>

    {{-- Silme onayı --}}
    <x-admin.delete-modal id="delete-role-modal" title="Rolü silmek istiyor musunuz?">
        rolü kalıcı olarak silinecek. Bu role sahip kullanıcılar rolsüz kalır.
    </x-admin.delete-modal>
@endsection
