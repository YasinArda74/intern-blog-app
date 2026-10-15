import { Editor } from '@tiptap/core'
import StarterKit from '@tiptap/starter-kit'

const element = document.querySelector('#editor')
const input = document.querySelector('#content')
const toolbar = document.querySelector('#toolbar')


if (element && input) {
    const editor = new Editor({
        element,
        extensions: [StarterKit],
        content: input.value ? JSON.parse(input.value) : '',
        editorProps: {
            attributes: {
                class: 'prose max-w-none min-h-96 rounded-b-base border border-default-medium bg-neutral-secondary-medium px-4 py-3 text-heading focus:outline-none',
            },
        },
        onUpdate({ editor }) {
            input.value = JSON.stringify(editor.getJSON())
        },
    })

    if (toolbar) {
        // her butonun: ne yapacağı (run) ve aktif mi (active)
        const commands = {
            bold:        { run: () => editor.chain().focus().toggleBold().run(),        active: () => editor.isActive('bold') },
            italic:      { run: () => editor.chain().focus().toggleItalic().run(),      active: () => editor.isActive('italic') },
            strike:      { run: () => editor.chain().focus().toggleStrike().run(),      active: () => editor.isActive('strike') },
            h2:          { run: () => editor.chain().focus().toggleHeading({ level: 2 }).run(), active: () => editor.isActive('heading', { level: 2 }) },
            h3:          { run: () => editor.chain().focus().toggleHeading({ level: 3 }).run(), active: () => editor.isActive('heading', { level: 3 }) },
            bulletList:  { run: () => editor.chain().focus().toggleBulletList().run(),  active: () => editor.isActive('bulletList') },
            orderedList: { run: () => editor.chain().focus().toggleOrderedList().run(), active: () => editor.isActive('orderedList') },
            blockquote:  { run: () => editor.chain().focus().toggleBlockquote().run(),  active: () => editor.isActive('blockquote') },
            undo:        { run: () => editor.chain().focus().undo().run() },
            redo:        { run: () => editor.chain().focus().redo().run() },
        }

        const buttons = toolbar.querySelectorAll('[data-action]')

        buttons.forEach((button) => {
            button.addEventListener('click', () => {
                commands[button.dataset.action]?.run()
            })
        })

        // imleç/içerik değişince aktif butonları işaretle
        const refresh = () => {
            buttons.forEach((button) => {
                const command = commands[button.dataset.action]
                button.classList.toggle('is-active', command?.active ? command.active() : false)
            })
        }

        editor.on('transaction', refresh)
        refresh()
    }
}
