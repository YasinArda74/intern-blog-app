@props(['category'])

@php
    $gradients = [
        'from-sky-200 via-blue-100 to-indigo-100 dark:from-sky-900 dark:via-blue-950 dark:to-indigo-950',
        'from-emerald-200 via-teal-100 to-cyan-100 dark:from-emerald-900 dark:via-teal-950 dark:to-cyan-950',
        'from-violet-200 via-purple-100 to-fuchsia-100 dark:from-violet-900 dark:via-purple-950 dark:to-fuchsia-950',
        'from-amber-200 via-orange-100 to-rose-100 dark:from-amber-900 dark:via-orange-950 dark:to-rose-950',
        'from-rose-200 via-pink-100 to-orange-100 dark:from-rose-900 dark:via-pink-950 dark:to-orange-950',
        'from-indigo-200 via-blue-100 to-sky-100 dark:from-indigo-900 dark:via-blue-950 dark:to-sky-950',
    ];
    $gradient = $gradients[hexdec(substr(hash('sha256', $category->slug), 0, 8)) % count($gradients)];
@endphp

<div {{ $attributes->merge(['class' => 'relative overflow-hidden bg-gradient-to-br '.$gradient]) }}>
    <div class="pointer-events-none absolute -end-8 -top-10 size-36 rounded-full border border-white/40" aria-hidden="true"></div>
    <div class="pointer-events-none absolute -bottom-12 -start-8 size-32 rounded-full border border-white/40" aria-hidden="true"></div>
    {{ $slot }}
</div>
