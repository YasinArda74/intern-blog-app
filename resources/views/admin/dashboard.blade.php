<!doctype html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yönetim Paneli</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet"/>
</head>
<body class="bg-slate-50 text-slate-900">
<div class="flex min-h-screen">
    @include('admin.partials.sidebar')
    <main class="min-w-0 flex-1 lg:ml-64">
        <header class="flex h-20 items-center justify-between border-b bg-white px-6 lg:px-10">
            <div><p class="text-xs text-slate-400">Pazartesi, 12 Ekim 2026</p>
                <h1 class="text-xl font-bold">Genel Bakış</h1></div>
            <div class="flex items-center gap-4">
                <button class="relative rounded-lg p-2 text-slate-500 hover:bg-slate-100" aria-label="Bildirimler">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 17h5l-1.4-1.4A2 2 0 0118 14.2V11a6 6 0 10-12 0v3.2a2 2 0 01-.6 1.4L4 17h5m6 0a3 3 0 01-6 0"/>
                    </svg>
                    <span class="absolute right-1 top-1 h-2 w-2 rounded-full bg-orange-500"></span></button>
                <div
                    class="flex h-9 w-9 items-center justify-center rounded-full bg-orange-500 text-xs font-bold text-white">
                    AK
                </div>
            </div>
        </header>
        <div class="p-6 lg:p-10">
            <div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
                <div><p class="font-medium text-orange-600">Hoş geldin, Ahmet</p>
                    <h2 class="mt-1 text-3xl font-bold tracking-tight">Bugün neler oluyor?</h2>
                    <p class="mt-2 text-sm text-slate-500">Blog performansının kısa özeti burada.</p></div>
                <a href="#"
                   class="rounded-xl bg-slate-900 px-4 py-3 text-sm font-semibold text-white hover:bg-slate-700">+ Yeni
                    yazı oluştur</a></div>
            <div
                class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">@foreach ([['Toplam yazı','24','+12.5%'],['Görüntülenme','18.429','+18.2%'],['Aktif okuyucu','3.842','+8.4%'],['Bekleyen yorum','8','Yanıt bekliyor']] as $stat)
                    <div class="rounded-2xl border bg-white p-5 shadow-sm"><p
                            class="text-sm text-slate-500">{{ $stat[0] }}</p>
                        <p class="mt-4 text-3xl font-bold">{{ $stat[1] }}</p>
                        <p class="mt-2 text-xs text-emerald-600">{{ $stat[2] }}</p></div>
                @endforeach</div>
            <div class="mt-6 grid gap-6 xl:grid-cols-[1.4fr_1fr]">
                <section class="rounded-2xl border bg-white p-6 shadow-sm"><h3 class="font-bold">Görüntülenme
                        istatistikleri</h3>
                    <p class="mt-1 text-xs text-slate-400">Son 30 gündeki toplam görüntülenme</p>
                    <div
                        class="mt-8 flex h-48 items-end gap-2">@foreach ([35,48,42,62,57,73,55,68,78,64,84,72,88,76,93,80,67,86,78,96] as $height)
                            <div class="flex-1 rounded-t bg-orange-200 hover:bg-orange-500"
                                 style="height: {{ $height }}%"></div>
                        @endforeach</div>
                </section>
                <section class="rounded-2xl border bg-white p-6 shadow-sm"><h3 class="font-bold">En çok okunanlar</h3>
                    <p class="mt-1 text-xs text-slate-400">Bu ayın popüler
                        yazıları</p>@foreach (['Laravel ile modern web uygulamaları','Tailwind CSS ile hızlı arayüz','Blogunuz için SEO kontrol listesi'] as $index => $post)
                        <div class="mt-5 flex items-center gap-3"><span
                                class="rounded-lg bg-slate-100 px-2 py-1 text-xs font-bold">0{{ $index + 1 }}</span><span
                                class="truncate text-sm font-medium">{{ $post }}</span></div>
                    @endforeach</section>
            </div>
        </div>
    </main>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>
