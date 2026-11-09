@extends('layouts.admin', ['active' => 'posts'])

@section('title', 'Yazılar')

@section('content')
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Yazılar</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Blogdaki tüm yazıları buradan görüntüleyebilirsiniz.</p>
        </div>

        <a href="{{ route('posts.create') }}"
           class="inline-flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800">
            <i class="fa-solid fa-plus" aria-hidden="true"></i>
            Yeni yazı
        </a>
    </div>

    <section class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800"
             aria-label="Tüm yazılar">
        <div class="flex flex-col gap-1 border-b border-gray-200 px-5 py-4 dark:border-gray-700 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-base font-semibold text-gray-900 dark:text-white">Tüm yazılar</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">Toplam {{ $posts->total() }} yazı</p>
        </div>

        <div class="relative overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-600 dark:text-gray-300">
                <thead class="bg-gray-50 text-xs uppercase text-gray-600 dark:bg-gray-700 dark:text-gray-300">
                    <tr>
                        <th scope="col" class="px-5 py-3">Yazı</th>
                        <th scope="col" class="px-5 py-3">Kategori</th>
                        <th scope="col" class="px-5 py-3">Yazar</th>
                        <th scope="col" class="px-5 py-3">Durum</th>
                        <th scope="col" class="px-5 py-3">Tarih</th>
                        <th scope="col" class="px-5 py-3 text-right">Görüntülenme</th>
                        <th scope="col" class="px-5 py-3"><span class="sr-only">İşlem</span></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($posts as $post)
                        <tr class="transition hover:bg-gray-50 dark:hover:bg-gray-700/50">
                            <th scope="row" class="min-w-64 px-5 py-4 font-medium text-gray-900 dark:text-white">
                                <a href="{{ route('posts.show', ['user' => $post->user->username, 'postSlug' => $post->slug]) }}"
                                   class="line-clamp-2 hover:text-blue-600 dark:hover:text-blue-400">
                                    {{ $post->title }}
                                </a>
                            </th>
                            <td class="whitespace-nowrap px-5 py-4">{{ $post->category->name }}</td>
                            <td class="whitespace-nowrap px-5 py-4">{{ '@'.$post->user->username }}</td>
                            <td class="whitespace-nowrap px-5 py-4">
                                <span @class([
                                    'inline-flex items-center rounded-full px-2.5 py-1 text-xs font-medium',
                                    'bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-300' => trim($post->status) === 'published',
                                    'bg-amber-100 text-amber-800 dark:bg-amber-900/40 dark:text-amber-300' => trim($post->status) === 'scheduled',
                                    'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300' => in_array(trim($post->status), ['draft', 'archived'], true),
                                ])>
                                    {{ match (trim($post->status)) {
                                        'published' => 'Yayında',
                                        'draft' => 'Taslak',
                                        'scheduled' => 'Planlandı',
                                        'archived' => 'Arşivlendi',
                                        default => ucfirst(trim($post->status)),
                                    } }}
                                </span>
                            </td>
                            <td class="whitespace-nowrap px-5 py-4">
                                {{ \Illuminate\Support\Carbon::parse($post->published_at ?? $post->created_at)->format('d.m.Y') }}
                            </td>
                            <td class="whitespace-nowrap px-5 py-4 text-right">{{ number_format($post->views_count) }}</td>
                            <td class="whitespace-nowrap px-5 py-4 text-right">
                                <a href="{{ route('posts.show', ['user' => $post->user->username, 'postSlug' => $post->slug]) }}"
                                   class="inline-flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-medium text-blue-700 hover:bg-blue-50 focus:outline-none focus:ring-4 focus:ring-blue-200 dark:text-blue-400 dark:hover:bg-gray-700 dark:focus:ring-blue-800">
                                    Görüntüle
                                    <i class="fa-solid fa-arrow-up-right-from-square text-xs" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-5 py-14 text-center">
                                <div class="mx-auto flex max-w-sm flex-col items-center gap-3">
                                    <span class="flex size-12 items-center justify-center rounded-full bg-blue-50 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400">
                                        <x-admin.icon name="document" class="size-6" />
                                    </span>
                                    <div>
                                        <h3 class="font-semibold text-gray-900 dark:text-white">Henüz yazı yok</h3>
                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Yeni bir yazı oluşturarak başlayabilirsiniz.</p>
                                    </div>
                                    <a href="{{ route('posts.create') }}"
                                       class="mt-1 text-sm font-medium text-blue-600 hover:underline dark:text-blue-400">
                                        İlk yazını oluştur
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($posts->hasPages())
            <div class="border-t border-gray-200 px-5 py-4 dark:border-gray-700">
                {{ $posts->links() }}
            </div>
        @endif
    </section>
@endsection
