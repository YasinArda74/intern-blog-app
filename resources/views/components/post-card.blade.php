@props(['post', 'image' => null])

@php
    $imageFile = filled($image) ? public_path(ltrim($image, '/')) : null;
    $hasImage = $imageFile && is_file($imageFile);
@endphp

<article class="group flex flex-col">
    @if ($hasImage)
        <div class="aspect-[16/9] overflow-hidden bg-neutral-secondary-medium">
            <img src="{{ $image }}" alt="{{ $post->title }}" loading="lazy"
                 class="size-full object-cover transition duration-500 group-hover:scale-105">
        </div>
    @else
        <x-category-gradient :category="$post->category" class="flex aspect-[16/9] items-end p-5">
            <span class="relative size-10 rounded-full bg-white/40 dark:bg-white/10" aria-hidden="true"></span>
        </x-category-gradient>
    @endif

    <div class="flex flex-1 flex-col gap-3 p-5">
        <x-category-badge :category="$post->category" />

        <h3 class="text-lg font-semibold leading-snug tracking-tight text-heading">
            <span class="transition group-hover:text-fg-brand">{{ $post->title }}</span>
        </h3>

        <p class="line-clamp-2 text-sm leading-relaxed text-body">
            {{ Str::limit($post->excerpt, 100) }}
        </p>

        <div class="mt-auto flex items-center gap-2 border-t border-default pt-3 text-xs text-body">
            <time datetime="{{ $post->created_at->toAtomString() }}">{{ $post->created_at->translatedFormat('d F Y') }}</time>
            <span aria-hidden="true">·</span>
            <span>{{ trans(':count min read', ['count' => $post->readingTimeMinutes()]) }}</span>
        </div>
    </div>
</article>
