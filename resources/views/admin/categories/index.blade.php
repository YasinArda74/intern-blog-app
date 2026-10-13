<!doctype html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kategoriler</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet">
</head>
<body class="bg-slate-50 text-slate-900">
<div class="flex min-h-screen">@include('admin.partials.sidebar')
    <main class="min-w-0 flex-1 lg:ml-64">
        <header class="flex h-20 items-center justify-between border-b bg-white px-6 lg:px-10">
            <div><p class="text-xs text-slate-400">İçerik yönetimi</p>
                <h1 class="text-xl font-bold">Kategoriler</h1></div>
            <button data-modal-target="category-modal" data-modal-toggle="category-modal"
                    class="rounded-xl bg-slate-900 px-4 py-3 text-sm font-semibold text-white">+ Yeni kategori
            </button>
        </header>
        <div class="p-6 lg:p-10">
            <div
                class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">@foreach ([['Laravel','12 yazı','bg-orange-100 text-orange-700'],['Tasarım','8 yazı','bg-violet-100 text-violet-700'],['Pazarlama','6 yazı','bg-emerald-100 text-emerald-700'],['PHP','10 yazı','bg-sky-100 text-sky-700']] as $category)
                    <div class="rounded-2xl border bg-white p-5 shadow-sm">
                        <div class="flex items-start justify-between"><span
                                class="rounded-lg px-3 py-2 text-xs font-semibold {{ $category[2] }}">{{ $category[0] }}</span>
                            <button class="text-slate-400">•••</button>
                        </div>
                        <p class="mt-6 text-2xl font-bold">{{ $category[1] }}</p>
                        <p class="mt-1 text-xs text-slate-400">Bu kategoride yayınlanan içerik</p>
                        <button class="mt-5 text-xs font-semibold text-orange-600 hover:underline">Kategoriyi düzenle
                            →
                        </button>
                    </div>
                @endforeach</div>
        </div>
    </main>
</div>
<div id="category-modal" tabindex="-1"
     class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto p-4">
    <div class="relative w-full max-w-md">
        <div class="rounded-2xl bg-white p-6 shadow"><h3 class="text-lg font-bold">Yeni kategori oluştur</h3>
            <form class="mt-5"><label class="mb-2 block text-sm font-medium">Kategori adı</label><input
                    class="w-full rounded-lg border border-slate-300 p-3 text-sm" placeholder="Örn. Teknoloji"><label
                    class="mb-2 mt-4 block text-sm font-medium">Açıklama</label><textarea
                    class="w-full rounded-lg border border-slate-300 p-3 text-sm" rows="3"
                    placeholder="Kategori açıklaması"></textarea>
                <button type="button"
                        class="mt-5 w-full rounded-lg bg-slate-900 px-4 py-3 text-sm font-semibold text-white">
                    Kategoriyi kaydet
                </button>
            </form>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>
