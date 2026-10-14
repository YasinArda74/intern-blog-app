<div id="toolbar" class="flex flex-wrap gap-1 border border-b-0 rounded-t p-2">
    <button type="button" data-action="bold" class="px-2 py-1 rounded font-bold">B</button>
    <button type="button" data-action="italic" class="px-2 py-1 rounded italic">I</button>
    <button type="button" data-action="strike" class="px-2 py-1 rounded line-through">S</button>
    <button type="button" data-action="h2" class="px-2 py-1 rounded">H2</button>
    <button type="button" data-action="h3" class="px-2 py-1 rounded">H3</button>
    <button type="button" data-action="bulletList" class="px-2 py-1 rounded">• Liste</button>
    <button type="button" data-action="orderedList" class="px-2 py-1 rounded">1. Liste</button>
    <button type="button" data-action="blockquote" class="px-2 py-1 rounded">Alıntı</button>
    <button type="button" data-action="undo" class="px-2 py-1 rounded">↶</button>
    <button type="button" data-action="redo" class="px-2 py-1 rounded">↷</button>
</div>

<div id="editor"></div>

<input type="hidden" name="content" id="content" value="{{old('content')}}">
