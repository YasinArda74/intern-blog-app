import { Editor } from '@tiptap/core'
import StarterKit from '@tiptap/starter-kit'

const element = document.querySelector('#editor')
const input = document.querySelector('#content')

if (element && input) {
    const editor = new Editor({
        element,
        extensions: [StarterKit],
        content: input.value ? JSON.parse(input.value) : '',
        editorProps: {
            attributes: {
                class: 'min-h-[200px] p-3 border rounded focus:outline-none',
            },
        },
        onUpdate({ editor }) {
            input.value = JSON.stringify(editor.getJSON())
        },
    })
}
