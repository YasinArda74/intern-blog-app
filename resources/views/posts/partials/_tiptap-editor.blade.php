@php
    $tool = 'inline-flex h-8 min-w-8 items-center justify-center rounded-base px-2 text-sm text-body hover:bg-neutral-tertiary-medium hover:text-heading';
@endphp

<div id="toolbar" class="flex flex-wrap items-center gap-1 rounded-t-base border border-b-0 border-default-medium bg-neutral-secondary-soft p-2">
    <button type="button" data-action="bold" class="{{ $tool }} font-bold">B</button>
    <button type="button" data-action="italic" class="{{ $tool }} font-medium italic">I</button>
    <button type="button" data-action="strike" class="{{ $tool }} font-medium line-through">S</button>

    <span class="mx-1 hidden h-5 w-px bg-default-medium sm:block" aria-hidden="true"></span>

    <button type="button" data-action="h2" class="{{ $tool }} font-medium">H2</button>
    <button type="button" data-action="h3" class="{{ $tool }} font-medium">H3</button>

    <span class="mx-1 hidden h-5 w-px bg-default-medium sm:block" aria-hidden="true"></span>

    <button type="button" data-action="bulletList" class="{{ $tool }} font-medium">• Liste</button>
    <button type="button" data-action="orderedList" class="{{ $tool }} font-medium">1. Liste</button>
    <button type="button" data-action="blockquote" class="{{ $tool }} font-medium">Alıntı</button>

    <span class="mx-1 hidden h-5 w-px bg-default-medium sm:block" aria-hidden="true"></span>

    <button type="button" data-action="undo" class="{{ $tool }} font-medium" aria-label="Undo">↶</button>
    <button type="button" data-action="redo" class="{{ $tool }} font-medium" aria-label="Redo">↷</button>
</div>

<div id="editor"></div>

<input type="hidden" name="content" id="content" value="{{ old('content') }}">
