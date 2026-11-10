@props(['initials' => 'AY', 'size' => 'md'])

@php
    $sizes = [
        'sm' => 'size-9 text-sm',
        'md' => 'size-10 text-sm',
        'lg' => 'size-14 text-lg',
        'xl' => 'size-28 text-3xl ring-4 ring-white dark:ring-gray-900',
    ];
    $colors = [
        'bg-indigo-100 text-indigo-700 dark:bg-indigo-900/60 dark:text-indigo-300',
        'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/60 dark:text-emerald-300',
        'bg-amber-100 text-amber-700 dark:bg-amber-900/60 dark:text-amber-300',
        'bg-rose-100 text-rose-700 dark:bg-rose-900/60 dark:text-rose-300',
        'bg-sky-100 text-sky-700 dark:bg-sky-900/60 dark:text-sky-300',
        'bg-violet-100 text-violet-700 dark:bg-violet-900/60 dark:text-violet-300',
    ];
    $color = $colors[hexdec(substr(hash('sha256', mb_strtolower($initials)), 0, 8)) % count($colors)];
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex shrink-0 items-center justify-center rounded-full font-semibold '.$color.' '.($sizes[$size] ?? $sizes['md'])]) }} aria-hidden="true">
    {{ $initials }}
</span>
