<div id="tiptap"
     data-upload-url="{{ route('posts.images') }}"
     data-placeholder="@lang('Start telling your story...')"
     data-count-label="@lang(':count characters')"
     data-upload-error="@lang('The image could not be uploaded.')"
     class="overflow-hidden rounded-base border border-default-medium bg-neutral-secondary-medium">
    <div id="toolbar" class="flex flex-wrap items-center gap-1 border-b border-default-medium bg-neutral-secondary-soft p-2">
        <x-editor-button action="undo" :label="__('Undo')">
            <i class="fa-solid fa-rotate-left text-xs" aria-hidden="true"></i>
        </x-editor-button>
        <x-editor-button action="redo" :label="__('Redo')">
            <i class="fa-solid fa-rotate-right text-xs" aria-hidden="true"></i>
        </x-editor-button>

        <span class="mx-1 hidden h-5 w-px bg-default-medium sm:block" aria-hidden="true"></span>

        <label for="editor-heading" class="sr-only ">@lang('Paragraph')</label>
        <select id="editor-heading"
                class="h-8 rounded-base border border-default-medium bg-neutral-secondary-medium pl-3 text-xs text-heading focus:border-brand focus:ring-brand">
            <option value="paragraph">@lang('Paragraph')</option>
            @foreach (range(1, 6) as $level)
                <option value="{{ $level }}">H{{ $level }}</option>
            @endforeach
        </select>

        <span class="mx-1 hidden h-5 w-px bg-default-medium sm:block" aria-hidden="true"></span>

        <x-editor-button action="bold" :label="__('Bold')">
            <i class="fa-solid fa-bold text-xs" aria-hidden="true"></i>
        </x-editor-button>
        <x-editor-button action="italic" :label="__('Italic')">
            <i class="fa-solid fa-italic text-xs" aria-hidden="true"></i>
        </x-editor-button>
        <x-editor-button action="underline" :label="__('Underline')">
            <i class="fa-solid fa-underline text-xs" aria-hidden="true"></i>
        </x-editor-button>
        <x-editor-button action="strike" :label="__('Strikethrough')">
            <i class="fa-solid fa-strikethrough text-xs" aria-hidden="true"></i>
        </x-editor-button>
        <x-editor-button action="code" :label="__('Inline code')">
            <i class="fa-solid fa-code text-xs" aria-hidden="true"></i>
        </x-editor-button>
        <x-editor-button action="highlight" :label="__('Highlight')">
            <i class="fa-solid fa-highlighter text-xs" aria-hidden="true"></i>
        </x-editor-button>
        <x-editor-button action="subscript" :label="__('Subscript')">
            <i class="fa-solid fa-subscript text-xs" aria-hidden="true"></i>
        </x-editor-button>
        <x-editor-button action="superscript" :label="__('Superscript')">
            <i class="fa-solid fa-superscript text-xs" aria-hidden="true"></i>
        </x-editor-button>

        <span class="mx-1 hidden h-5 w-px bg-default-medium sm:block" aria-hidden="true"></span>

        <x-editor-button action="alignLeft" :label="__('Align left')">
            <i class="fa-solid fa-align-left text-xs" aria-hidden="true"></i>
        </x-editor-button>
        <x-editor-button action="alignCenter" :label="__('Align center')">
            <i class="fa-solid fa-align-center text-xs" aria-hidden="true"></i>
        </x-editor-button>
        <x-editor-button action="alignRight" :label="__('Align right')">
            <i class="fa-solid fa-align-right text-xs" aria-hidden="true"></i>
        </x-editor-button>
        <x-editor-button action="alignJustify" :label="__('Justify')">
            <i class="fa-solid fa-align-justify text-xs" aria-hidden="true"></i>
        </x-editor-button>
        <x-editor-button action="imageFloatLeft" :label="__('Image left')">
            <i class="fa-solid fa-arrow-left text-xs" aria-hidden="true"></i>
        </x-editor-button>
        <x-editor-button action="imageFloatRight" :label="__('Image right')">
            <i class="fa-solid fa-arrow-right text-xs" aria-hidden="true"></i>
        </x-editor-button>
        <span class="mx-1 hidden h-5 w-px bg-default-medium sm:block" aria-hidden="true"></span>

        <x-editor-button action="bulletList" :label="__('Bullet list')">
            <i class="fa-solid fa-list-ul text-xs" aria-hidden="true"></i>
        </x-editor-button>
        <x-editor-button action="orderedList" :label="__('Ordered list')">
            <i class="fa-solid fa-list-ol text-xs" aria-hidden="true"></i>
        </x-editor-button>
        <x-editor-button action="taskList" :label="__('Task list')">
            <i class="fa-solid fa-list-check text-xs" aria-hidden="true"></i>
        </x-editor-button>
        <x-editor-button action="blockquote" :label="__('Quote')">
            <i class="fa-solid fa-quote-left text-xs" aria-hidden="true"></i>
        </x-editor-button>
        <x-editor-button action="codeBlock" :label="__('Code block')">
            <i class="fa-solid fa-file-code text-xs" aria-hidden="true"></i>
        </x-editor-button>
        <x-editor-button action="horizontalRule" :label="__('Horizontal rule')">
            <i class="fa-solid fa-minus text-xs" aria-hidden="true"></i>
        </x-editor-button>

        <span class="mx-1 hidden h-5 w-px bg-default-medium sm:block" aria-hidden="true"></span>

        <x-editor-button action="link" :label="__('Link')">
            <i class="fa-solid fa-link text-xs" aria-hidden="true"></i>
        </x-editor-button>
        <x-editor-button action="image" :label="__('Image')">
            <i class="fa-solid fa-image text-xs" aria-hidden="true"></i>
        </x-editor-button>

        <span class="mx-1 hidden h-5 w-px bg-default-medium sm:block" aria-hidden="true"></span>

        <x-editor-button action="insertTable" :label="__('Insert table')">
            <i class="fa-solid fa-table text-xs" aria-hidden="true"></i>
        </x-editor-button>
        <x-editor-button action="addRowAfter" :label="__('Add row')">
            <i class="fa-solid fa-plus text-xs" aria-hidden="true"></i>
        </x-editor-button>
        <x-editor-button action="addColumnAfter" :label="__('Add column')">
            <i class="fa-solid fa-table-columns text-xs" aria-hidden="true"></i>
        </x-editor-button>
        <x-editor-button action="mergeOrSplit" :label="__('Merge or split cells')">
            <i class="fa-solid fa-table-cells-large text-xs" aria-hidden="true"></i>
        </x-editor-button>
        <x-editor-button action="deleteTable" :label="__('Delete table')">
            <i class="fa-solid fa-trash text-xs" aria-hidden="true"></i>
        </x-editor-button>
    </div>

    <div id="editor"></div>

    <div class="flex items-center justify-between gap-3 border-t border-default-medium px-3 py-2 text-xs text-body">
        <p id="editor-status" class="text-fg-danger" role="status"></p>
        <p id="editor-count"></p>
    </div>

    <input type="hidden" name="content" id="content" value="{{ $post->content ?? '' }}">
    <input id="editor-image" type="file" accept="image/jpeg,image/png,image/webp,image/gif" class="sr-only">

    <dialog id="editor-link-dialog" class="w-[min(100%,24rem)] rounded-base border border-default bg-neutral-primary-soft p-5 text-heading shadow-xs backdrop:bg-black/40">
        <label for="editor-link-url" class="mb-2 block text-sm font-medium">@lang('Link address')</label>
        <input id="editor-link-url" type="url" placeholder="https://"
               class="block w-full rounded-base border border-default-medium bg-neutral-secondary-medium px-3.5 py-2.5 text-sm text-heading shadow-xs placeholder:text-body focus:border-brand focus:ring-brand">
        <div class="mt-4 flex flex-wrap justify-end gap-2">
            <button type="button" data-link="cancel"
                    class="inline-flex items-center justify-center rounded-base border border-default-medium bg-neutral-secondary-medium px-4 py-2.5 text-sm font-medium text-body hover:bg-neutral-tertiary-medium hover:text-heading">
                @lang('Give up')
            </button>
            <button type="button" data-link="remove"
                    class="inline-flex items-center justify-center rounded-base border border-default-medium bg-neutral-secondary-medium px-4 py-2.5 text-sm font-medium text-body hover:bg-neutral-tertiary-medium hover:text-heading">
                @lang('Remove link')
            </button>
            <button type="button" data-link="apply"
                    class="inline-flex items-center justify-center rounded-base border border-transparent bg-brand px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-strong">
                @lang('Save')
            </button>
        </div>
    </dialog>
</div>
