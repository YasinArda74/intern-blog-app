@extends('layouts.admin', ['active' => 'categories'])

@section('title', 'Kategoriler')

@section('content')
    <div class="flex flex-col gap-4 mb-6 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Kategoriler</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Blog yazılarınız için kategorileri yönetin.</p>
        </div>
        <button type="button" data-modal-target="create-category-modal" data-modal-toggle="create-category-modal" class="inline-flex items-center justify-center gap-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            <x-admin.icon name="plus" class="w-4 h-4" />
            Yeni Kategori
        </button>
    </div>

    <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
        <div class="p-4">
            <label for="category-search" class="sr-only">Kategori ara</label>
            <div class="relative w-full sm:max-w-xs">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none text-gray-500 dark:text-gray-400">
                    <x-admin.icon name="search" class="w-4 h-4" />
                </div>
                <input type="text" id="category-search" placeholder="Kategori ara..." class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
            </div>
        </div>

        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Kategori Adı</th>
                        <th scope="col" class="px-6 py-3">Slug</th>
                        <th scope="col" class="px-6 py-3">Yazı Sayısı</th>
                        <th scope="col" class="px-6 py-3">Oluşturulma</th>
                        <th scope="col" class="px-6 py-3 text-right">İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b border-gray-200 hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Teknoloji</th>
                        <td class="px-6 py-4"><code class="text-xs">teknoloji</code></td>
                        <td class="px-6 py-4">
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-sm dark:bg-blue-900 dark:text-blue-300">42</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">12 Oca 2026</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end gap-2">
                                <button type="button" data-modal-target="edit-category-modal" data-modal-toggle="edit-category-modal" class="p-2 text-blue-600 rounded-lg hover:bg-blue-50 dark:text-blue-500 dark:hover:bg-gray-700" aria-label="Teknoloji kategorisini düzenle">
                                    <x-admin.icon name="pencil" class="w-5 h-5" />
                                </button>
                                <button type="button" data-modal-target="delete-category-modal" data-modal-toggle="delete-category-modal" data-delete-name="Teknoloji" class="p-2 text-red-600 rounded-lg hover:bg-red-50 dark:text-red-500 dark:hover:bg-gray-700" aria-label="Teknoloji kategorisini sil">
                                    <x-admin.icon name="trash" class="w-5 h-5" />
                                </button>
                            </div>
                        </td>
                    </tr>

                    <tr class="bg-white border-b border-gray-200 hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Yazılım</th>
                        <td class="px-6 py-4"><code class="text-xs">yazilim</code></td>
                        <td class="px-6 py-4">
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-sm dark:bg-blue-900 dark:text-blue-300">35</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">12 Oca 2026</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end gap-2">
                                <button type="button" data-modal-target="edit-category-modal" data-modal-toggle="edit-category-modal" class="p-2 text-blue-600 rounded-lg hover:bg-blue-50 dark:text-blue-500 dark:hover:bg-gray-700" aria-label="Yazılım kategorisini düzenle">
                                    <x-admin.icon name="pencil" class="w-5 h-5" />
                                </button>
                                <button type="button" data-modal-target="delete-category-modal" data-modal-toggle="delete-category-modal" data-delete-name="Yazılım" class="p-2 text-red-600 rounded-lg hover:bg-red-50 dark:text-red-500 dark:hover:bg-gray-700" aria-label="Yazılım kategorisini sil">
                                    <x-admin.icon name="trash" class="w-5 h-5" />
                                </button>
                            </div>
                        </td>
                    </tr>

                    <tr class="bg-white border-b border-gray-200 hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Seyahat</th>
                        <td class="px-6 py-4"><code class="text-xs">seyahat</code></td>
                        <td class="px-6 py-4">
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-sm dark:bg-blue-900 dark:text-blue-300">18</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">03 Şub 2026</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end gap-2">
                                <button type="button" data-modal-target="edit-category-modal" data-modal-toggle="edit-category-modal" class="p-2 text-blue-600 rounded-lg hover:bg-blue-50 dark:text-blue-500 dark:hover:bg-gray-700" aria-label="Seyahat kategorisini düzenle">
                                    <x-admin.icon name="pencil" class="w-5 h-5" />
                                </button>
                                <button type="button" data-modal-target="delete-category-modal" data-modal-toggle="delete-category-modal" data-delete-name="Seyahat" class="p-2 text-red-600 rounded-lg hover:bg-red-50 dark:text-red-500 dark:hover:bg-gray-700" aria-label="Seyahat kategorisini sil">
                                    <x-admin.icon name="trash" class="w-5 h-5" />
                                </button>
                            </div>
                        </td>
                    </tr>

                    <tr class="bg-white border-b border-gray-200 hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Yaşam</th>
                        <td class="px-6 py-4"><code class="text-xs">yasam</code></td>
                        <td class="px-6 py-4">
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-sm dark:bg-blue-900 dark:text-blue-300">14</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">21 Mar 2026</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end gap-2">
                                <button type="button" data-modal-target="edit-category-modal" data-modal-toggle="edit-category-modal" class="p-2 text-blue-600 rounded-lg hover:bg-blue-50 dark:text-blue-500 dark:hover:bg-gray-700" aria-label="Yaşam kategorisini düzenle">
                                    <x-admin.icon name="pencil" class="w-5 h-5" />
                                </button>
                                <button type="button" data-modal-target="delete-category-modal" data-modal-toggle="delete-category-modal" data-delete-name="Yaşam" class="p-2 text-red-600 rounded-lg hover:bg-red-50 dark:text-red-500 dark:hover:bg-gray-700" aria-label="Yaşam kategorisini sil">
                                    <x-admin.icon name="trash" class="w-5 h-5" />
                                </button>
                            </div>
                        </td>
                    </tr>

                    <tr class="bg-white border-b border-gray-200 hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Kitap</th>
                        <td class="px-6 py-4"><code class="text-xs">kitap</code></td>
                        <td class="px-6 py-4">
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-sm dark:bg-blue-900 dark:text-blue-300">9</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">08 Nis 2026</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end gap-2">
                                <button type="button" data-modal-target="edit-category-modal" data-modal-toggle="edit-category-modal" class="p-2 text-blue-600 rounded-lg hover:bg-blue-50 dark:text-blue-500 dark:hover:bg-gray-700" aria-label="Kitap kategorisini düzenle">
                                    <x-admin.icon name="pencil" class="w-5 h-5" />
                                </button>
                                <button type="button" data-modal-target="delete-category-modal" data-modal-toggle="delete-category-modal" data-delete-name="Kitap" class="p-2 text-red-600 rounded-lg hover:bg-red-50 dark:text-red-500 dark:hover:bg-gray-700" aria-label="Kitap kategorisini sil">
                                    <x-admin.icon name="trash" class="w-5 h-5" />
                                </button>
                            </div>
                        </td>
                    </tr>

                    <tr class="bg-white border-b border-gray-200 hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Sinema</th>
                        <td class="px-6 py-4"><code class="text-xs">sinema</code></td>
                        <td class="px-6 py-4">
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-sm dark:bg-blue-900 dark:text-blue-300">6</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">30 May 2026</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end gap-2">
                                <button type="button" data-modal-target="edit-category-modal" data-modal-toggle="edit-category-modal" class="p-2 text-blue-600 rounded-lg hover:bg-blue-50 dark:text-blue-500 dark:hover:bg-gray-700" aria-label="Sinema kategorisini düzenle">
                                    <x-admin.icon name="pencil" class="w-5 h-5" />
                                </button>
                                <button type="button" data-modal-target="delete-category-modal" data-modal-toggle="delete-category-modal" data-delete-name="Sinema" class="p-2 text-red-600 rounded-lg hover:bg-red-50 dark:text-red-500 dark:hover:bg-gray-700" aria-label="Sinema kategorisini sil">
                                    <x-admin.icon name="trash" class="w-5 h-5" />
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <x-admin.pagination :from="1" :to="6" :total="12" />
    </div>

    {{-- Yeni kategori modalı --}}
    <div id="create-category-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Yeni Kategori Ekle</h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="create-category-modal">
                        <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 14 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" /></svg>
                        <span class="sr-only">Kapat</span>
                    </button>
                </div>
                <form action="#" class="p-4 md:p-5">
                    <div class="grid gap-4 mb-4">
                        <div>
                            <label for="create-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori Adı</label>
                            <input type="text" id="create-name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Örn. Teknoloji" required>
                        </div>
                        <div>
                            <label for="create-slug" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Slug</label>
                            <input type="text" id="create-slug" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="teknoloji">
                        </div>
                        <div>
                            <label for="create-description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Açıklama</label>
                            <textarea id="create-description" rows="3" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Kısa bir açıklama yazın"></textarea>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Kategori Ekle</button>
                        <button type="button" data-modal-hide="create-category-modal" class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Vazgeç</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Kategori düzenleme modalı --}}
    <div id="edit-category-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Kategoriyi Düzenle</h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="edit-category-modal">
                        <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 14 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" /></svg>
                        <span class="sr-only">Kapat</span>
                    </button>
                </div>
                <form action="#" class="p-4 md:p-5">
                    <div class="grid gap-4 mb-4">
                        <div>
                            <label for="edit-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori Adı</label>
                            <input type="text" id="edit-name" value="Teknoloji" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                        </div>
                        <div>
                            <label for="edit-slug" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Slug</label>
                            <input type="text" id="edit-slug" value="teknoloji" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                        </div>
                        <div>
                            <label for="edit-description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Açıklama</label>
                            <textarea id="edit-description" rows="3" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">Teknoloji dünyasından haberler ve incelemeler.</textarea>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Değişiklikleri Kaydet</button>
                        <button type="button" data-modal-hide="edit-category-modal" class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Vazgeç</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <x-admin.delete-modal id="delete-category-modal" title="Kategoriyi sil">
        kategorisini silmek istediğinize emin misiniz? Bu işlem geri alınamaz.
    </x-admin.delete-modal>
@endsection
