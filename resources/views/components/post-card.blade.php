@props(['post', 'image' => null])

@php
    $imageFile = filled($image) ? public_path(ltrim($image, '/')) : null;
    $hasImage = $imageFile && is_file($imageFile);
@endphp

<article class="group flex flex-col">
    @if ($hasImage)
        <div class="aspect-[16/9] overflow-hidden bg-neutral-secondary-medium">
            <img src="{{ $image }}" alt="{{ $post->title }}" class="size-full object-cover transition duration-300 group-hover:scale-105">
        </div>
    @else
        <div class="relative flex aspect-[16/9] items-end overflow-hidden bg-brand p-5">
            <div class="absolute -end-8 -top-10 size-36 rounded-full bg-white/10" aria-hidden="true"></div>
            <div class="absolute -bottom-12 -start-8 size-32 rounded-full bg-white/10" aria-hidden="true"></div>
            <span class="relative rounded-base bg-white/15 px-2.5 py-1 text-xs font-medium text-white">{{ $post->category->name }}</span>
        </div>
    @endif

    <div class="flex flex-1 flex-col gap-3 p-5">
        @if ($hasImage)
            <span class="w-fit rounded-base bg-brand-soft px-2.5 py-0.5 text-xs font-medium text-fg-brand-strong">{{ $post->category->name }}</span>
        @endif

        <h3 class="text-lg font-semibold leading-snug text-heading">
            <span class="transition group-hover:text-fg-brand">{{ $post->title }}</span>
        </h3>

        <p class="line-clamp-2 text-sm leading-relaxed text-body">
            {{ Str::limit($post->excerpt, 100) }}
        </p>
    </div>
</article>
