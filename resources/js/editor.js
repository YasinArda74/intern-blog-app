import { Editor } from '@tiptap/core'
import CharacterCount from '@tiptap/extension-character-count'
import CodeBlockLowlight from '@tiptap/extension-code-block-lowlight'
import FileHandler from '@tiptap/extension-file-handler'
import Highlight from '@tiptap/extension-highlight'
import Image from '@tiptap/extension-image'
import Placeholder from '@tiptap/extension-placeholder'
import Subscript from '@tiptap/extension-subscript'
import Superscript from '@tiptap/extension-superscript'
import { TableKit } from '@tiptap/extension-table'
import TaskItem from '@tiptap/extension-task-item'
import TaskList from '@tiptap/extension-task-list'
import TextAlign from '@tiptap/extension-text-align'
import Typography from '@tiptap/extension-typography'
import StarterKit from '@tiptap/starter-kit'
import { common, createLowlight } from 'lowlight'
import 'highlight.js/styles/github.css'

const FloatImage = Image.extend({
    addAttributes() {
        return {
            ...this.parent?.(),
            float: {
                default: 'left',
                parseHTML: (element) => element.getAttribute('data-float') ?? 'left',
                renderHTML: (attributes) => ({
                    'data-float': attributes.float,
                }),
            },
        }
    },
})

const root = document.querySelector('#tiptap')
const element = document.querySelector('#editor')
const input = document.querySelector('#content')
const toolbar = document.querySelector('#toolbar')
const lowlight = createLowlight(common)

const readContent = (value) => {
    if (! value) {
        return ''
    }

    try {
        return JSON.parse(value)
    } catch {
        return ''
    }
}

const uploadImage = async (file) => {
    const body = new FormData()
    body.append('image', file)

    const response = await fetch(root.dataset.uploadUrl, {
        method: 'POST',
        headers: {
            Accept: 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content ?? '',
        },
        body,
    })

    if (! response.ok) {
        throw new Error('upload failed')
    }

    const payload = await response.json()

    return payload.url
}

const insertImage = async (editor, file, position) => {
    const status = document.querySelector('#editor-status')

    try {
        const src = await uploadImage(file)
        const chain = editor.chain().focus()

        if (position === null) {
            chain.setImage({ src }).run()
        } else {
            chain.insertContentAt(position, { type: 'image', attrs: { src } }).run()
        }

        if (status) {
            status.textContent = ''
        }
    } catch {
        if (status) {
            status.textContent = root.dataset.uploadError ?? ''
        }
    }
}

if (element && input && root) {
    const editor = new Editor({
        element,
        extensions: [
            StarterKit.configure({
                codeBlock: false,
                link: {
                    openOnClick: false,
                    enableClickSelection: true,
                },
            }),
            CodeBlockLowlight.configure({
                lowlight,
            }),
            FloatImage.configure({
                inline: true,
                resize: {
                    enabled: true,
                    directions: ['top-left', 'top-right', 'bottom-left', 'bottom-right'],
                    minWidth: 80,
                    minHeight: 80,
                    alwaysPreserveAspectRatio: true,
                },
            }),
            FileHandler.configure({
                allowedMimeTypes: ['image/jpeg', 'image/png', 'image/gif', 'image/webp'],
                onDrop: (currentEditor, files, pos) => {
                    files.forEach((file) => {
                        insertImage(currentEditor, file, pos)
                    })
                },
                onPaste: (currentEditor, files) => {
                    files.forEach((file) => {
                        insertImage(currentEditor, file, null)
                    })
                },
            }),
            TextAlign.configure({
                types: ['heading', 'paragraph'],
            }),
            Placeholder.configure({
                placeholder: root.dataset.placeholder ?? '',
            }),
            Highlight,
            TaskList,
            TaskItem.configure({
                nested: true,
            }),
            Subscript,
            Superscript,
            Typography,
            CharacterCount,
            TableKit.configure({
                table: {
                    resizable: true,
                },
            }),
        ],
        content: readContent(input.value),
        editorProps: {
            attributes: {
                class: 'tiptap prose max-w-none min-h-96 px-4 py-3 text-heading focus:outline-none',
            },
        },
        onUpdate({ editor }) {
            input.value = JSON.stringify(editor.getJSON())
        },
    })

    const imageInput = document.querySelector('#editor-image')
    const heading = document.querySelector('#editor-heading')
    const linkDialog = document.querySelector('#editor-link-dialog')
    const linkInput = document.querySelector('#editor-link-url')
    const count = document.querySelector('#editor-count')

    const refreshCount = () => {
        if (! count) {
            return
        }

        const label = root.dataset.countLabel ?? ':count'
        count.textContent = label.replace(':count', String(editor.storage.characterCount.characters()))
    }

    if (imageInput) {
        imageInput.addEventListener('change', () => {
            const file = imageInput.files?.[0]

            if (file) {
                insertImage(editor, file, null)
            }

            imageInput.value = ''
        })
    }

    if (heading) {
        heading.addEventListener('change', () => {
            const value = heading.value

            if (value === 'paragraph') {
                editor.chain().focus().setParagraph().run()

                return
            }

            editor.chain().focus().toggleHeading({ level: Number(value) }).run()
        })
    }

    if (linkDialog && linkInput) {
        linkDialog.querySelectorAll('[data-link]').forEach((button) => {
            button.addEventListener('click', () => {
                const action = button.dataset.link

                if (action === 'apply') {
                    const href = linkInput.value.trim()

                    if (href === '') {
                        editor.chain().focus().unsetLink().run()
                    } else {
                        editor.chain().focus().extendMarkRange('link').setLink({ href }).run()
                    }
                }

                if (action === 'remove') {
                    editor.chain().focus().unsetLink().run()
                }

                linkDialog.close()
            })
        })
    }

    if (toolbar) {
        const commands = {
            bold: { run: () => editor.chain().focus().toggleBold().run(), active: () => editor.isActive('bold') },
            italic: { run: () => editor.chain().focus().toggleItalic().run(), active: () => editor.isActive('italic') },
            underline: { run: () => editor.chain().focus().toggleUnderline().run(), active: () => editor.isActive('underline') },
            strike: { run: () => editor.chain().focus().toggleStrike().run(), active: () => editor.isActive('strike') },
            code: { run: () => editor.chain().focus().toggleCode().run(), active: () => editor.isActive('code') },
            highlight: { run: () => editor.chain().focus().toggleHighlight().run(), active: () => editor.isActive('highlight') },
            subscript: { run: () => editor.chain().focus().toggleSubscript().run(), active: () => editor.isActive('subscript') },
            superscript: { run: () => editor.chain().focus().toggleSuperscript().run(), active: () => editor.isActive('superscript') },
            alignLeft: { run: () => editor.chain().focus().setTextAlign('left').run(), active: () => editor.isActive({ textAlign: 'left' }) },
            alignCenter: { run: () => editor.chain().focus().setTextAlign('center').run(), active: () => editor.isActive({ textAlign: 'center' }) },
            alignRight: { run: () => editor.chain().focus().setTextAlign('right').run(), active: () => editor.isActive({ textAlign: 'right' }) },
            alignJustify: { run: () => editor.chain().focus().setTextAlign('justify').run(), active: () => editor.isActive({ textAlign: 'justify' }) },
            imageFloatLeft: {
                run: () => editor.chain().focus().updateAttributes('image', { float: 'left' }).setTextAlign('left').run(),
            },
            imageFloatRight: {
                run: () => editor.chain().focus().updateAttributes('image', { float: 'right' }).setTextAlign('left').run(),
            },
            bulletList: { run: () => editor.chain().focus().toggleBulletList().run(), active: () => editor.isActive('bulletList') },
            orderedList: { run: () => editor.chain().focus().toggleOrderedList().run(), active: () => editor.isActive('orderedList') },
            taskList: { run: () => editor.chain().focus().toggleTaskList().run(), active: () => editor.isActive('taskList') },
            blockquote: { run: () => editor.chain().focus().toggleBlockquote().run(), active: () => editor.isActive('blockquote') },
            codeBlock: { run: () => editor.chain().focus().toggleCodeBlock().run(), active: () => editor.isActive('codeBlock') },
            horizontalRule: { run: () => editor.chain().focus().setHorizontalRule().run() },
            link: {
                run: () => {
                    if (! linkDialog || ! linkInput) {
                        return
                    }

                    linkInput.value = editor.getAttributes('link').href ?? ''
                    linkDialog.showModal()
                    linkInput.focus()
                },
                active: () => editor.isActive('link'),
            },
            image: { run: () => imageInput?.click() },
            insertTable: { run: () => editor.chain().focus().insertTable({ rows: 3, cols: 3, withHeaderRow: true }).run() },
            addRowAfter: { run: () => editor.chain().focus().addRowAfter().run(), can: () => editor.can().addRowAfter() },
            addColumnAfter: { run: () => editor.chain().focus().addColumnAfter().run(), can: () => editor.can().addColumnAfter() },
            mergeOrSplit: { run: () => editor.chain().focus().mergeOrSplit().run(), can: () => editor.can().mergeOrSplit() },
            deleteTable: { run: () => editor.chain().focus().deleteTable().run(), can: () => editor.can().deleteTable() },
            undo: { run: () => editor.chain().focus().undo().run(), can: () => editor.can().undo() },
            redo: { run: () => editor.chain().focus().redo().run(), can: () => editor.can().redo() },
        }

        const buttons = toolbar.querySelectorAll('[data-action]')

        buttons.forEach((button) => {
            button.addEventListener('click', () => {
                commands[button.dataset.action]?.run()
            })
        })

        const refresh = () => {
            buttons.forEach((button) => {
                const command = commands[button.dataset.action]

                button.classList.toggle('is-active', command?.active ? command.active() : false)
                button.disabled = command?.can ? ! command.can() : false
            })

            if (heading) {
                const level = [1, 2, 3, 4, 5, 6].find((item) => editor.isActive('heading', { level: item }))
                heading.value = level ? String(level) : 'paragraph'
            }

            refreshCount()
        }

        editor.on('transaction', refresh)
        refresh()
    } else {
        refreshCount()
    }
}
