@php
    $field = 'block w-full rounded-lg border bg-white p-2.5 text-sm text-gray-900 focus:border-indigo-600 focus:ring-indigo-600 dark:bg-gray-900 dark:text-white dark:placeholder-gray-500';
    $ok = 'border-gray-300 dark:border-gray-700';
    $bad = 'border-red-500 bg-red-50 focus:border-red-500 focus:ring-red-500';
@endphp

<form method="POST" action="{{ $action }}" enctype="multipart/form-data" class="grid gap-8 lg:grid-cols-3">
    @csrf
    @if ($post->exists) @method('PUT') @endif

    <div class="space-y-6 lg:col-span-2">
        <div class="rounded-xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900">
            <label for="title" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Başlık</label>
            <input type="text" id="title" name="title" value="{{ old('title', $post->title) }}" required maxlength="160"
                placeholder="Dikkat çekici bir başlık yaz..."
                @error('title') aria-invalid="true" aria-describedby="title-error" @enderror
                class="block w-full border-0 bg-transparent p-0 text-2xl font-bold text-gray-900 placeholder-gray-400 focus:ring-0 dark:text-white dark:placeholder-gray-600">
            @error('title') <p id="title-error" class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p> @enderror

            <hr class="my-5 border-gray-200 dark:border-gray-800">

            <label for="body" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">İçerik</label>
            <textarea id="body" name="body" rows="18" required placeholder="Hikâyeni anlatmaya başla..."
                @error('body') aria-invalid="true" aria-describedby="body-error" @enderror
                class="{{ $field }} {{ $errors->has('body') ? $bad : $ok }} leading-relaxed">{{ old('body', $post->body) }}</textarea>
            <div class="mt-2 flex justify-between text-sm">
                @error('body')
                    <p id="body-error" class="text-red-600 dark:text-red-500">{{ $message }}</p>
                @else
                    <p class="text-gray-500 dark:text-gray-400">Paragrafları boş satırla ayırabilirsin.</p>
                @enderror
                <p class="text-gray-500 dark:text-gray-400"><span id="word-count">0</span> kelime</p>
            </div>
        </div>
    </div>

    <aside class="space-y-6">
        <div class="rounded-xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900">
            <h2 class="mb-4 font-semibold text-gray-900 dark:text-white">Yayınla</h2>
            <div class="flex flex-col gap-3">
                <button type="submit" name="action" value="publish"
                    class="w-full rounded-lg bg-indigo-700 px-5 py-3 text-sm font-semibold text-white hover:bg-indigo-800 focus:outline-none focus:ring-4 focus:ring-indigo-300 dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">
                    {{ $post->isPublished() ? 'Güncelle' : 'Yayınla' }}
                </button>
                <button type="submit" name="action" value="draft"
                    class="w-full rounded-lg border border-gray-300 bg-white px-5 py-3 text-sm font-medium text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:border-gray-700 dark:bg-gray-800 dark:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                    {{ $post->isPublished() ? 'Yayından kaldır' : 'Taslak olarak kaydet' }}
                </button>
            </div>
        </div>

        <div class="space-y-5 rounded-xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900">
            <div>
                <label for="category" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
                <select id="category" name="category" class="{{ $field }} {{ $errors->has('category') ? $bad : $ok }}">
                    <option value="">Kategori seç</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category }}" @selected(old('category', $post->category) === $category)>{{ $category }}</option>
                    @endforeach
                </select>
                @error('category') <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="excerpt" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Kısa özet <span class="font-normal text-gray-500">(isteğe bağlı)</span></label>
                <textarea id="excerpt" name="excerpt" rows="3" maxlength="300" placeholder="Kartlarda görünecek kısa açıklama"
                    class="{{ $field }} {{ $errors->has('excerpt') ? $bad : $ok }}">{{ old('excerpt', $post->excerpt) }}</textarea>
                @error('excerpt') <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p> @enderror
            </div>

            <div>
                <span class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Kapak görseli</span>
                <label for="cover_image" class="relative flex aspect-[16/9] w-full cursor-pointer flex-col items-center justify-center overflow-hidden rounded-lg border-2 border-dashed border-gray-300 bg-gray-50 hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                    <img id="cover-preview" src="{{ $post->coverUrl() }}" alt="Kapak önizlemesi" @class(['absolute inset-0 size-full object-cover', 'hidden' => ! $post->coverUrl()])>
                    <div id="cover-placeholder" @class(['flex flex-col items-center text-center', 'hidden' => $post->coverUrl()])>
                        <svg class="mb-2 size-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0 0 22.5 18.75V5.25A2.25 2.25 0 0 0 20.25 3H3.75A2.25 2.25 0 0 0 1.5 5.25v13.5A2.25 2.25 0 0 0 3.75 21Z" /></svg>
                        <p class="text-sm text-gray-600 dark:text-gray-300"><span class="font-semibold">Yüklemek için tıkla</span></p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG veya WEBP (en fazla 2MB)</p>
                    </div>
                    <input id="cover_image" name="cover_image" type="file" accept="image/png,image/jpeg,image/webp" class="sr-only">
                </label>
                @error('cover_image') <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p> @enderror
            </div>
        </div>
    </aside>
</form>

@push('scripts')
    <script>
        const body = document.getElementById('body');
        const wordCount = document.getElementById('word-count');
        const updateCount = () => { wordCount.textContent = (body.value.trim().match(/\S+/g) || []).length; };
        body.addEventListener('input', updateCount);
        updateCount();

        document.getElementById('cover_image').addEventListener('change', (event) => {
            const file = event.target.files[0];
            if (!file) return;
            const preview = document.getElementById('cover-preview');
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('hidden');
            document.getElementById('cover-placeholder').classList.add('hidden');
        });
    </script>
@endpush
