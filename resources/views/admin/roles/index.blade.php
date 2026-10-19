@extends('layouts.admin', ['active' => 'roles'])

@section('title', 'Roller')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Roller ve İzinler</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400">Rollerin yetkilerini inceleyin ve kullanıcılara rol atayın.</p>
    </div>

    {{-- Rol kartları --}}
    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4 mb-6">
        <div class="p-5 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <div class="flex items-center justify-between mb-3">
                <span class="text-sm font-medium px-2.5 py-0.5 rounded-sm bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300">Admin</span>
                <span class="text-sm text-gray-500 dark:text-gray-400">2 kullanıcı</span>
            </div>
            <p class="text-sm text-gray-500 dark:text-gray-400">Sitenin tüm bölümlerine tam erişim.</p>
        </div>

        <div class="p-5 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <div class="flex items-center justify-between mb-3">
                <span class="text-sm font-medium px-2.5 py-0.5 rounded-sm bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300">Editör</span>
                <span class="text-sm text-gray-500 dark:text-gray-400">5 kullanıcı</span>
            </div>
            <p class="text-sm text-gray-500 dark:text-gray-400">Tüm yazıları ve kategorileri yönetebilir.</p>
        </div>

        <div class="p-5 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <div class="flex items-center justify-between mb-3">
                <span class="text-sm font-medium px-2.5 py-0.5 rounded-sm bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">Yazar</span>
                <span class="text-sm text-gray-500 dark:text-gray-400">18 kullanıcı</span>
            </div>
            <p class="text-sm text-gray-500 dark:text-gray-400">Kendi yazılarını oluşturur ve düzenler.</p>
        </div>

        <div class="p-5 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <div class="flex items-center justify-between mb-3">
                <span class="text-sm font-medium px-2.5 py-0.5 rounded-sm bg-gray-100 text-gray-800 dark:bg-gray-600 dark:text-gray-300">Üye</span>
                <span class="text-sm text-gray-500 dark:text-gray-400">1.229 kullanıcı</span>
            </div>
            <p class="text-sm text-gray-500 dark:text-gray-400">Yorum yapabilir ve profilini yönetebilir.</p>
        </div>
    </div>

    <div class="grid gap-6 xl:grid-cols-3">
        {{-- İzin matrisi --}}
        <div class="xl:col-span-2 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">İzin Matrisi</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400">Hangi rolün hangi işlemi yapabileceğini belirleyin.</p>
            </div>
            <form action="#">
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">İzin</th>
                                <th scope="col" class="px-6 py-3 text-center">Admin</th>
                                <th scope="col" class="px-6 py-3 text-center">Editör</th>
                                <th scope="col" class="px-6 py-3 text-center">Yazar</th>
                                <th scope="col" class="px-6 py-3 text-center">Üye</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Yazı oluştur</th>
                                <td class="px-6 py-4 text-center"><input type="checkbox" checked aria-label="Admin - Yazı oluştur" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"></td>
                                <td class="px-6 py-4 text-center"><input type="checkbox" checked aria-label="Editör - Yazı oluştur" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"></td>
                                <td class="px-6 py-4 text-center"><input type="checkbox" checked aria-label="Yazar - Yazı oluştur" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"></td>
                                <td class="px-6 py-4 text-center"><input type="checkbox" aria-label="Üye - Yazı oluştur" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"></td>
                            </tr>

                            <tr class="bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Yazı düzenle (tümü)</th>
                                <td class="px-6 py-4 text-center"><input type="checkbox" checked aria-label="Admin - Yazı düzenle (tümü)" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"></td>
                                <td class="px-6 py-4 text-center"><input type="checkbox" checked aria-label="Editör - Yazı düzenle (tümü)" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"></td>
                                <td class="px-6 py-4 text-center"><input type="checkbox" aria-label="Yazar - Yazı düzenle (tümü)" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"></td>
                                <td class="px-6 py-4 text-center"><input type="checkbox" aria-label="Üye - Yazı düzenle (tümü)" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"></td>
                            </tr>

                            <tr class="bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Yazı sil</th>
                                <td class="px-6 py-4 text-center"><input type="checkbox" checked aria-label="Admin - Yazı sil" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"></td>
                                <td class="px-6 py-4 text-center"><input type="checkbox" checked aria-label="Editör - Yazı sil" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"></td>
                                <td class="px-6 py-4 text-center"><input type="checkbox" aria-label="Yazar - Yazı sil" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"></td>
                                <td class="px-6 py-4 text-center"><input type="checkbox" aria-label="Üye - Yazı sil" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"></td>
                            </tr>

                            <tr class="bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Kategori yönet</th>
                                <td class="px-6 py-4 text-center"><input type="checkbox" checked aria-label="Admin - Kategori yönet" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"></td>
                                <td class="px-6 py-4 text-center"><input type="checkbox" checked aria-label="Editör - Kategori yönet" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"></td>
                                <td class="px-6 py-4 text-center"><input type="checkbox" aria-label="Yazar - Kategori yönet" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"></td>
                                <td class="px-6 py-4 text-center"><input type="checkbox" aria-label="Üye - Kategori yönet" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"></td>
                            </tr>

                            <tr class="bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Yorum moderasyonu</th>
                                <td class="px-6 py-4 text-center"><input type="checkbox" checked aria-label="Admin - Yorum moderasyonu" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"></td>
                                <td class="px-6 py-4 text-center"><input type="checkbox" checked aria-label="Editör - Yorum moderasyonu" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"></td>
                                <td class="px-6 py-4 text-center"><input type="checkbox" aria-label="Yazar - Yorum moderasyonu" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"></td>
                                <td class="px-6 py-4 text-center"><input type="checkbox" aria-label="Üye - Yorum moderasyonu" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"></td>
                            </tr>

                            <tr class="bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Kullanıcı yönet</th>
                                <td class="px-6 py-4 text-center"><input type="checkbox" checked aria-label="Admin - Kullanıcı yönet" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"></td>
                                <td class="px-6 py-4 text-center"><input type="checkbox" aria-label="Editör - Kullanıcı yönet" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"></td>
                                <td class="px-6 py-4 text-center"><input type="checkbox" aria-label="Yazar - Kullanıcı yönet" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"></td>
                                <td class="px-6 py-4 text-center"><input type="checkbox" aria-label="Üye - Kullanıcı yönet" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"></td>
                            </tr>

                            <tr class="bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Rol ata</th>
                                <td class="px-6 py-4 text-center"><input type="checkbox" checked aria-label="Admin - Rol ata" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"></td>
                                <td class="px-6 py-4 text-center"><input type="checkbox" aria-label="Editör - Rol ata" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"></td>
                                <td class="px-6 py-4 text-center"><input type="checkbox" aria-label="Yazar - Rol ata" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"></td>
                                <td class="px-6 py-4 text-center"><input type="checkbox" aria-label="Üye - Rol ata" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="flex justify-end p-4">
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">İzinleri Kaydet</button>
                </div>
            </form>
        </div>

        {{-- Rol atama formu --}}
        <div class="self-start bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Kullanıcıya Rol Ata</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400">Bir kullanıcı seçip yeni rolünü belirleyin.</p>
            </div>
            <form action="#" class="p-4 space-y-4">
                <div>
                    <label for="assign-user" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kullanıcı</label>
                    <select id="assign-user" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <option selected disabled>Kullanıcı seçin</option>
                        <option>Zeynep Arslan (zeynep@ornek.com)</option>
                        <option>Ayşe Demir (ayse@ornek.com)</option>
                        <option>Mehmet Kaya (mehmet@ornek.com)</option>
                        <option>Can Yıldız (can@ornek.com)</option>
                        <option>Elif Şahin (elif@ornek.com)</option>
                        <option>Burak Öztürk (burak@ornek.com)</option>
                    </select>
                </div>
                <div>
                    <label for="assign-role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rol</label>
                    <select id="assign-role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <option selected disabled>Rol seçin</option>
                        <option>Admin</option>
                        <option>Editör</option>
                        <option>Yazar</option>
                        <option>Üye</option>
                    </select>
                </div>
                <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Rolü Ata</button>
            </form>
        </div>
    </div>
@endsection
