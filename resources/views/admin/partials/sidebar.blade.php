<aside class="fixed inset-y-0 left-0 z-40 hidden w-64 flex-col border-r border-slate-200 bg-white lg:flex">
    <div class="flex h-20 items-center gap-3 border-b px-6">
        <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-slate-900 text-lg font-bold text-white">K
        </div>
        <div><p class="font-bold">Kare Blog</p>
            <p class="text-[11px] text-slate-400">Yönetim paneli</p></div>
    </div>
    <nav class="flex flex-1 flex-col gap-1 p-4 text-sm"><p
            class="mb-2 px-3 text-[10px] font-bold uppercase tracking-widest text-slate-400">Menü</p>
        <a href="{{ url('/admin') }}" class="rounded-xl bg-slate-900 px-3 py-3 font-medium text-white">Genel Bakış</a>
        <a href="#" class="rounded-xl px-3 py-3 font-medium text-slate-500 hover:bg-slate-50">Yazılar <span
                class="float-right rounded bg-slate-100 px-2 text-xs">24</span></a>
        <a href="{{ route('admin.getCategories') }}"
           class="rounded-xl px-3 py-3 font-medium text-slate-500 hover:bg-slate-50">Kategoriler</a>
        <a href="#" class="rounded-xl px-3 py-3 font-medium text-slate-500 hover:bg-slate-50">Etiketler</a>
        <a href="#" class="rounded-xl px-3 py-3 font-medium text-slate-500 hover:bg-slate-50">Yorumlar <span
                class="float-right rounded bg-slate-100 px-2 text-xs">8</span></a>


        <p class="mb-2 mt-8 px-3 text-[10px] font-bold uppercase tracking-widest text-slate-400">Kullanıcı yönetimi</p>

        <a href="{{ route('admin.getRoles') }}"
           class="rounded-xl px-3 py-3 font-medium text-slate-500 hover:bg-slate-50">Kullanıcı rolleri</a>
        <a href="#" class="rounded-xl px-3 py-3 font-medium text-slate-500 hover:bg-slate-50">Kullanıcılar</a>
    </nav>
    <div class="m-4 rounded-2xl bg-slate-50 p-4">
        <div class="flex items-center gap-3">
            <div
                class="flex h-9 w-9 items-center justify-center rounded-full bg-orange-500 text-xs font-bold text-white">
                AK
            </div>
            <div><p class="text-xs font-semibold">Ahmet Kaya</p>
                <p class="text-[11px] text-slate-400">Yönetici</p></div>
        </div>
    </div>
</aside>
